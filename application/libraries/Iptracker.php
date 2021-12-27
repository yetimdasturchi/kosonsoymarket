<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*********************************************************************
 * Description: Tracks the number of website visits everyday. 
 * Version: 1.0.0
 * Date Created: January 09, 2015
 * Author: Glenn Tan Gevero
 * Website: http://app-arsenal.com
 * File: IP Tracker Library File
**********************************************************************/
ini_set('display_errors', 'On');
error_reporting(E_ALL);
class Iptracker{
		
	private $sys = null;
	
	public function __construct(){
		$this->sys	=& get_instance();
        $this->sys->load->library('user_agent');
        $this->sys->load->library('SxGeo');
	}
	
	private static function get_ip_address(){		
		$ip = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');		
		return $ip;
	}
	
	private function get_page_visit(){
		return current_url();
	}
    
    private function get_user_agent(){        
        if ($this->sys->agent->is_browser()){
            $agent = $this->sys->agent->browser().' '.$this->sys->agent->version();
        }
        elseif ($this->sys->agent->is_robot()){
            $agent = $this->sys->agent->robot();
        }
        elseif ($this->sys->agent->is_mobile()){
            $agent = $this->sys->agent->mobile();
        }
        else{
            $agent = 'Unidentified';
        }

        return $agent;
    }
	
	public function get_country()
	{
		$SxGeo = new SxGeo('SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);
		if ($SxGeo->getCityFull(self::get_ip_address())) {
			return $SxGeo->getCityFull(self::get_ip_address());
		}else{
			return '';
		}
	}

	public function get_location()
	{
		if ($this->sys->session->has_userdata('location')){
			$location = json_decode($this->sys->session->userdata('location'), true);  
		    if (is_array($location)) {
		    	if (array_key_exists('status', $location)) {
		    		if ($location['status'] != 'fail ') {
		    			return $location;
		    		}
		    	}else{
		    		return '';  
		    	}
		    }else{
		    	return '';  
		    }
        }else{
         	$url = 'http://ip-api.com/json/'.self::get_ip_address();
  			$ch = curl_init();
  			curl_setopt($ch, CURLOPT_URL, $url);
  			curl_setopt($ch, CURLOPT_HEADER, false);
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  			$result = curl_exec($ch);
  			curl_close($ch);
  			if ($result != '') {
  				$this->sys->session->set_userdata('location', $result);
  				$location = json_decode($result, true);  
		    	if (is_array($location)) {
		    		if (array_key_exists('status', $location)) {
		    			if ($location['status'] != 'fail ') {
		    				return $location;
		    			}
		    		}else{
		    			return '';  
		    		}
		    	}else{
		    		return '';  
		    	}
  			}else{
  				return '';  
  			}
        }
	}

	public function user_factory($action='', $key='')
	{
		include_once dirname(__FILE__) . '/useragent.class.php';
		$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);
		switch ($action) {

			case 'platform':
				return $useragent->platform[$key];
			break;

			case 'device':
				return $useragent->device[$key];
			break;

			case 'os':
				return $useragent->os[$key];
			break;

			case 'browser':
				return $useragent->browser[$key];
			break;
			
			default:
				return false;
			break;
		}
	}

	public function save_site_visit(){
		$ip 	= self::get_ip_address();
		$country = self::get_country();
		$location = self::get_location();
		$ua_string = $this->sys->agent->agent_string();
		$page	= self::get_page_visit();
		$referrer = $this->sys->agent->referrer();
		$platform = $this->sys->agent->platform();
		$segs =  array('home', 'pages', 'api', 'lite');
		$seg =  $this->sys->router->fetch_class();
		
        //Uncomment the IF Statement if you do not want your own admin pages to be tracked. Change the value of the needle ('admin) to the segments (URI) found in your admin pages.
		if(in_array($seg, $segs)){	
		    if($seg=='api' || $seg=='lite'){
		        $platform_type  = "application";
		        $page = str_replace(base_url().'api/'.setting_item('app_token'), '', $page);
		        $browser_name = "Android App";
		    }else{
		        $platform_type  = self::user_factory('platform', 'type');
		        $browser_name = self::user_factory('browser', 'name');
		    }
			$data = array(
				'ip' => $ip,
				'country_code' => $location['countryCode'],
				'country_name' => $location['country'],
				'region_name' => $location['regionName'],
				'country' => json_encode($country),
				'location' => json_encode($location),
                'ua_string' => $ua_string,
                'platform_type' => $platform_type,
                'platform' => $platform,
                'device_image' => self::user_factory('device', 'image'),
                'device' => self::user_factory('device', 'title'),
                'device_brand' => self::user_factory('device', 'brand'),
                'device_model' => self::user_factory('device', 'model'),
                'os_image' => self::user_factory('os', 'image'),
                'os' => self::user_factory('os', 'title'),
                'os_name' => self::user_factory('os', 'name'),
                'os_version' => self::user_factory('os', 'version'),
                'browser_image' => self::user_factory('browser', 'image'),
                'browser' => self::user_factory('browser', 'title'),
                'browser_name' => $browser_name,
                'browser_version' => self::user_factory('browser', 'version'),
                'page' => $page,
                'referrer' => $referrer,
                'date' => time()

			);
            if($this->sys->uri->segment(3) != 'image'){
                $this->sys->db->insert('visitors', $data);	
            }
					
		}
	}
}

$tracker = new Iptracker();
$tracker->save_site_visit();
