<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() 
	{
        parent::__construct();
        //header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

	function _remap($param1, $param2) {
        $this->index($param1, $param2);
    }

	public function index($api_key, $action)
	{
		$api_key = "f4lCnG6yWlCbvWRgfsYRFYzjKChuYEwaXz59oVkKvYUeJaCeI52iIkFTXgnNl1p3";
		if (isset($api_key) && isset($action)) {
			if ($api_key != 'index' && $this->check_apikey($api_key)!=false) {
				if (count($action) > 0) {
					switch ($action[0]) {

						case 'settings':
							$data = $this->input->get();
							echo $this->settings($data);
						break;

						case 'pages':
							$data = $this->input->get();
							echo $this->pages($data);
						break;

						case 'language':
							$data = $this->input->get();
							echo $this->language($data);
						break;

						case 'pricing':
							$data = $this->input->get();
							echo $this->pricing($data);
						break;

						case 'partners':
							$data = $this->input->get();
							echo $this->partners($data);
						break;

						case 'filters':
							$data = $this->input->get();
							echo $this->filters($data);
						break;

						case 'categories':
							$data = $this->input->get();
							echo $this->categories($data);
						break;

						case 'posts':
							$data = $this->input->get();
							echo $this->posts($data);
						break;

						case 'news':
							$data = $this->input->get();
							echo $this->news($data);
						break;

						case 'contact':
							$data = $this->input->get();
							echo $this->contact($data);
						break;

						case 'postad':
							echo $this->postad($_POST, $_FILES);
						break;

						case 'image':
							$info = getimagesize($this->input->get('file'));
  							$imgtype = image_type_to_mime_type($info[2]);
  							if ($imgtype == "image/png") {
  								header("Content-type: image/png");
  								readfile($this->input->get('file'));
  							}else{
  								header("Content-type: image/jpeg");
								$data = $this->input->get();
								echo $this->image_handler($data);
  							}
						break;
						
						default:
							$return = array('status' => 'error', 'message' => 'Bunday harakat mavjud emas!');
							echo json_encode($return);
						break;
					}
				}else{
					$return = array('status' => 'error', 'message' => 'Kerakli harakat tanlanmadi!');
					echo json_encode($return);
				}
			} else{
				$return = array('status' => 'error', 'message' => 'Api kalit xato!');
				echo json_encode($return);
			}
			
		}else{
			$return = array('status' => 'error', 'message' => 'Api kalit yoki harakat xato kiritilgan!');
			echo json_encode($return);
		}
	}

	private function check_apikey($key='')
	{
		if ( $key != '' ) {
			if (setting_item('app_token') == $key) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	private function settings($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$settings = array(
						'status' => 'success',
						'data' => array(
							'site_title' => setting_item('site_title'),
							'site_description' => setting_item('site_description'),
							'default_language' => setting_item('default_language'),
							'contact_address' => setting_item('contact_address'),
							'contact_number' => setting_item('contact_number'),
							'contact_email' => setting_item('contact_email'),
							'contact_telegram' => setting_item('contact_telegram'),
							'social_links' => json_decode(setting_item('social_links'), true),
							'base_url' => base_url(),
							'base_host' => base_host()
						)
					);
					return json_encode($settings);
				break;

				case 'item':
					if (array_key_exists('key', $data) && setting_item($data['key']) != "") {
						if ($data['key']=='social_links') {
							$res = json_decode(setting_item($data['key']), true);
						}else{
							$res = setting_item($data['key']);
						}
						$item = array(
							'status' => 'success',
							'data' => $res
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function pages($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$pages = array(
						'status' => 'success',
						'data' => array(
							'rules' => json_decode(setting_item('rules'), true),
							'faq' => json_decode(setting_item('faq'), true),
							'about_site' => json_decode(setting_item('about_site'), true),
							'about_site_archive' => json_decode(setting_item('about_site_archive'), true),
							'advertisement' => json_decode(setting_item('advertisement'), true),
							'how_it_work' => json_decode(setting_item('how_it_work'), true),
						)
					);
					return json_encode($pages);
				break;

				case 'about':
					if (array_key_exists('language', $data)) {
						$newArray = array();
						$site = json_decode(setting_item('about_site'), true);
						$newArray['site'] = array(
							'image' => 'public/images/project_at_work.png',
							'text' => $site[$this->input->get('language')]
						);
						$advertisement = json_decode(setting_item('advertisement'), true);
						$newArray['advertisement'] = array(
							'image' => 'public/images/project_at_adversitement.png',
							'text' => $advertisement[$this->input->get('language')]
						);
						$archive = json_decode(setting_item('about_site_archive'), true);
						foreach ($archive[$this->input->get('language')] as $item) {
							$newArray['archive'][] = array(
								'title' => $item['title'],
								'text' => $item['content'],
							); 
						}
						$partners = $this->db->order_by('partner_id', 'asc')->get('partners');
						if ($partners->num_rows() > 0) {
							foreach ($partners->result_array() as $item) {
								$newArray['partners'][] = array(
									'id' => $item['partner_id'],
									'name' => $item['name'],
									'url' => $item['url'],
									'image' => str_replace('/uploads', 'uploads', $item['image']),
								); 
							}
						}else{
							$newArray['partners'] = array();
						}
						$pricing = $this->db->order_by('price', 'asc')->get('pricing');
						if ($pricing->num_rows() > 0) {
							foreach ($pricing->result_array() as $item) {
								$name = json_decode($item['name'], true);
								$subtitle = json_decode($item['subtitle'], true);
								$content = json_decode($item['content'], true);
								$newArray['pricing'][] = array(
									'id' => $item['price_id'],
									'price' => $item['price'],
									'featured' => $item['featured'],
									'name' => $name[$this->input->get('language')],
									'subtitle' => $subtitle[$this->input->get('language')],
									'content' => $content[$this->input->get('language')],
								); 
							}
						}else{
							$newArray['pricing'] = array();
						}
						$newArray['stats'] = array(
							'allads' => $this->db->count_all_results('posts'),
							'activeads' => $this->db->where('status', 2)->count_all_results('posts'),
							'allusers' => gettelegramUsers(),
							'dailyusers' => gettelegramUsers('daily'),
						);
						$newArray['contact'] = array(
							'address' => setting_item('contact_address'),
							'number' => setting_item('contact_number'),
							'telegram' => setting_item('contact_telegram'),
							'email' => setting_item('contact_email'),
						);
						$newArray['socials'] = json_decode(setting_item('social_links'), true);
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'rules':
					if (array_key_exists('language', $data)) {
						$newArray = array();
						$rules = json_decode(setting_item('rules'), true);
						$newArray = $rules[$this->input->get('language')];
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'pricing':
					if (array_key_exists('language', $data)) {
						$newArray = array();
						$pricing = $this->db->order_by('price', 'asc')->get('pricing');
						if ($pricing->num_rows() > 0) {
							foreach ($pricing->result_array() as $item) {
								$name = json_decode($item['name'], true);
								$subtitle = json_decode($item['subtitle'], true);
								$content = json_decode($item['content'], true);
								$newArray[] = array(
									'id' => $item['price_id'],
									'price' => $item['price'],
									'featured' => $item['featured'],
									'name' => $name[$this->input->get('language')],
									'subtitle' => $subtitle[$this->input->get('language')],
									'content' => $content[$this->input->get('language')],
								); 
							}
						}
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('key', $data) && setting_item($data['key']) != "") {
						$item = array(
							'status' => 'success',
							'data' => json_decode(setting_item($data['key']), true)
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function language($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':

					$languages = $this->config->item('languages_list');
					$newArray = array();
					foreach ($languages as $key => $value) {
						$newArray[$key] = language_parser('_allitems', $key);
					}

					$language = array(
						'status' => 'success',
						'data' => $newArray
					);
					return json_encode($language);
				break;

				case 'name':
					if (array_key_exists('key', $data)) {
						
						$languages = $this->config->item('languages_list');
		
						if (array_key_exists($data['key'], $languages)) {
							$item = array(
								'status' => 'success',
								'data' => $languages[$data['key']]
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('key', $data) && get_phrase($data['key']) != "") {
						$item = array(
							'status' => 'success',
							'data' => language_parser($data['key'], $data['language'])
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function pricing($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$query = $this->db->order_by('price_id', 'asc')->get('pricing');
					if ($query->num_rows() > 0) {
						$query = $query->result_array();
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['price_id']] = $row;
							$newArray[$row['price_id']]['name'] = json_decode($newArray[$row['price_id']]['name'], true);
							$newArray[$row['price_id']]['subtitle'] = json_decode($newArray[$row['price_id']]['subtitle'], true);
							$newArray[$row['price_id']]['content'] = json_decode($newArray[$row['price_id']]['content'], true);
						}
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('pricing', array('price_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$query['name'] = json_decode($query['name'], true);
							$query['subtitle'] = json_decode($query['subtitle'], true);
							$query['content'] = json_decode($query['content'], true);
							$item = array(
								'status' => 'success',
								'data' => $query
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function partners($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$query = $this->db->order_by('partner_id', 'asc')->get('partners');
					if ($query->num_rows() > 0) {
						$query = $query->result_array();
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['partner_id']] = $row;
						}
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('partners', array('partner_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$item = array(
								'status' => 'success',
								'data' => $query
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function contact($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			$return = $this->input->get();
			$return['date'] = time();
			$return['status'] = 0;
			unset($return['_']);
			$this->db->insert('contacts', $return);
			$item = array(
				'status' => 'success',
				'data' => $return
			);
			return json_encode($item);
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function filters($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$query = $this->db->order_by('category_id', 'asc')->get('categories');
					if ($query->num_rows() > 0) {
						$query = $query->result_array();
						$newArray = array();
						foreach ($query as $row) {
							$subquery = $this->db->order_by('category_id', 'asc')->get_where('filters', array('category_id' => $row['category_id']));
							if ($subquery->num_rows() > 0) {
								$subquery = $subquery->result_array();
								$newSubArray = array();
								foreach ($subquery as $subrow) {
									$newSubArray[$subrow['filter_id']] = $subrow;
									$newSubArray[$subrow['filter_id']]['filter_name'] = json_decode($newSubArray[$subrow['filter_id']]['filter_name'], true);
									$newSubArray[$subrow['filter_id']]['content'] = json_decode($newSubArray[$subrow['filter_id']]['content'], true);
								}
								$newArray[$row['category_id']] = $newSubArray;
							}else{
								$newArray[$row['category_id']] = array();
							}
						}
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('filters', array('filter_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$query['filter_name'] = json_decode($query['filter_name'], true);
							$query['content'] = json_decode($query['content'], true);
							$item = array(
								'status' => 'success',
								'data' => $query
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'cat':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('filters', array('category_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->result_array();
							$newArray = array();
							foreach ($query as $row) {
								$newArray[$row['filter_id']] = $row;
								$newArray[$row['filter_id']]['filter_name'] = json_decode($newArray[$row['filter_id']]['filter_name'], true);
								$newArray[$row['filter_id']]['content'] = json_decode($newArray[$row['filter_id']]['content'], true);
							}
							$item = array(
								'status' => 'success',
								'data' => $newArray
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function categories($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$query = $this->db->order_by('category_id', 'asc')->where('parent_id', '0')->get('categories');
					if ($query->num_rows() > 0) {
						$query = $query->result_array();
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['category_id']] = $row;
							$newArray[$row['category_id']]['name'] = json_decode($newArray[$row['category_id']]['name'], true);
							$newArray[$row['category_id']]['title'] = json_decode($newArray[$row['category_id']]['title'], true);
							$newArray[$row['category_id']]['keywords'] = json_decode($newArray[$row['category_id']]['keywords'], true);
							$newArray[$row['category_id']]['description'] = json_decode($newArray[$row['category_id']]['description'], true);
							$subquery = $this->db->order_by('category_id', 'asc')->get_where('categories', array('parent_id' => $row['category_id']));
							if ($subquery->num_rows() > 0) {
								$subquery = $subquery->result_array();
								$newSubArray = array();
								foreach ($subquery as $subrow) {
									$newSubArray[$subrow['category_id']] = $subrow;
									$newSubArray[$subrow['category_id']]['name'] = json_decode($newSubArray[$subrow['category_id']]['name'], true);
									$newSubArray[$subrow['category_id']]['title'] = json_decode($newSubArray[$subrow['category_id']]['title'], true);
									$newSubArray[$subrow['category_id']]['keywords'] = json_decode($newSubArray[$subrow['category_id']]['keywords'], true);
									$newSubArray[$subrow['category_id']]['description'] = json_decode($newSubArray[$subrow['category_id']]['description'], true);
								}
								$newArray[$row['category_id']]['subcategories'] = $newSubArray;
							}else{
								$newArray[$row['category_id']]['subcategories'] = array();
							}
						}
						$item = array(
							'status' => 'success',
							'data' => $newArray
						);
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('categories', array('category_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$query['name'] = json_decode($query['name'], true);
							$query['title'] = json_decode($query['title'], true);
							$query['keywords'] = json_decode($query['keywords'], true);
							$query['description'] = json_decode($query['description'], true);
							$item = array(
								'status' => 'success',
								'data' => $query
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				case 'parent':
					if (array_key_exists('id', $data)) {
						$query = $this->db->order_by('category_id', 'asc')->get_where('categories', array('parent_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->result_array();
							$newArray = array();
							foreach ($query as $row) {
								$newArray[$row['category_id']] = $row;
								$newArray[$row['category_id']]['name'] = json_decode($newArray[$row['category_id']]['name'], true);
								$newArray[$row['category_id']]['title'] = json_decode($newArray[$row['category_id']]['title'], true);
								$newArray[$row['category_id']]['keywords'] = json_decode($newArray[$row['category_id']]['keywords'], true);
								$newArray[$row['category_id']]['description'] = json_decode($newArray[$row['category_id']]['description'], true);
							}
							$item = array(
								'status' => 'success',
								'data' => $newArray
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function news($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {

				case 'categories':
					if (array_key_exists('language', $data)) {
						$query = $this->db->order_by('category_name')->get_where('news_category', array('language' => $data['language']));
						if ($query->num_rows() > 0) {
							$newArray = array();
							$query = $query->result_array();
							foreach ($query as $category) {
								$newArray[] = array(
									'id' => $category['category_id'],
									'language' => $category['language'],
									'name' => $category['category_name'], 
								);
							}
							$item = array(
								'status' => 'success',
								'data' => array_reverse($newArray)
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;
				
				case 'list':
					$query  = $this->get_news($this->input->get());
					if ($query->num_rows() > 0) {
						$query = array_reverse($query->result_array());
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['news_id']]['id'] = $row['news_id'];
							$newArray[$row['news_id']]['slug'] = $row['slug'];
							$newArray[$row['news_id']]['title'] = $row['title'];
							$newArray[$row['news_id']]['language'] = $row['language'];
							$newArray[$row['news_id']]['date'] = date("m-d | H:i", $row['date']);
							$newArray[$row['news_id']]['category_id'] = $row['category_id'];
							$news_category = $this->db->get_where('news_category', array('category_id' => $row['category_id']));
							if ($news_category->num_rows() > 0) {
								$news_category = $news_category->row_array();
								$newArray[$row['news_id']]['category'] = $news_category['category_name'];
							}else{
								$newArray[$row['news_id']]['category'] = '';
							}
							$row['photo'] = str_replace('{base_url}', '', $row['photo']);
							if (file_exists('./'.$row['photo'])) {
                        		$newArray[$row['news_id']]['image'] = $row['photo'];
                    		}else{
                    			$newArray[$row['news_id']]['image'] = 'public/images/noimage.jpg';
                    		}
						}
						$item = array(
							'status' => 'success',
							'data' => array_reverse($newArray)
						);//die(print_r($newArray));
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;
				
				case 'item':
					if (array_key_exists('id', $data)) {
						$newArray = array();
						$query = $this->db->get_where('news', array('news_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$newArray['id'] = $query['news_id'];
							$newArray['slug'] = $query['slug'];
							$newArray['title'] = $query['title'];
							$newArray['content'] = $query['content'];
							$newArray['language'] = $query['language'];
							$newArray['date'] = date("m-d | H:i", $query['date']);
							$newArray['category_id'] = $query['category_id'];
							$news_category = $this->db->get_where('news_category', array('category_id' => $query['category_id']));
							if ($news_category->num_rows() > 0) {
								$news_category = $news_category->row_array();
								$newArray['category'] = $news_category['category_name'];
							}else{
								$newArray['category'] = '';
							}
							$query['photo'] = str_replace('{base_url}', '', $query['photo']);
							if (file_exists('./'.$query['photo'])) {
                        		$newArray['image'] = $query['photo'];
                    		}else{
                    			$newArray['image'] = 'public/images/noimage.jpg';
                    		}
							$item = array(
								'status' => 'success',
								'data' => $newArray
							);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;

				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function posts($data='')
	{
		
		if ( $data != '' && is_array($data) && count($data) > 0) {
			switch ($data['action']) {
				case 'list':
					$query  = $this->get_posts($this->input->get());
					if ($query->num_rows() > 0) {
						$query = array_reverse($query->result_array());
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['post_id']] = $row;
							if ($row['position_period'] <= date("Y-m-d H:i:s")) {
								$newArray[$row['post_id']]['position'] = 'default';
							}
							$newArray[$row['post_id']]['price'] = number_format($newArray[$row['post_id']]['price'], 0, '.', ',');
							$newArray[$row['post_id']]['price_options'] = json_decode($newArray[$row['post_id']]['price_options'], true);
							$newArray[$row['post_id']]['filter'] = json_decode($newArray[$row['post_id']]['filter'], true);
							$newArray[$row['post_id']]['created_at'] = date("m-d | H:i", strtotime($newArray[$row['post_id']]['created_at']));
							$newArray[$row['post_id']]['uniquekey'] = uniqueKey();
							$post_images = $this->db->get_where('post_images', array('post_id' => $row['post_id']));
							$post_category = $this->db->get_where('categories', array('category_id' => $row['category_id']));
							if ($post_category->num_rows() > 0) {
								$post_category = $post_category->row_array();
								$post_category_name = json_decode($post_category['name'], true);
								$newArray[$row['post_id']]['category'] = $post_category_name[$this->input->get('language')];
							}else{
								$newArray[$row['post_id']]['category'] = '';
							}
							if ($post_images->num_rows() > 0) {
								$post_images = $post_images->row_array();
                				if (file_exists('./uploads/ads/'.$post_images['filename'])) {
                        			$newArray[$row['post_id']]['image'] = 'uploads/ads/'.$post_images['filename'];
                    			}else{
                    				$newArray[$row['post_id']]['image'] = 'public/images/noimage.jpg';
                    			}
							}else{
								$newArray[$row['post_id']]['image'] = 'public/images/noimage.jpg';
							}
						}
						$item = array(
							'status' => 'success',
							'data' => array_reverse($newArray)
						);//die(print_r($newArray));
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'bookmarks':
					if (count($this->input->get('bookmarks')) == 0) {
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
					$this->db->where_in('status', array('2', '3'));
					$this->db->where_in('post_id', $this->input->get('bookmarks'));
					$query  = $this->db->get('posts');
					if ($query->num_rows() > 0) {
						$query = array_reverse($query->result_array());
						$newArray = array();
						foreach ($query as $row) {
							$newArray[$row['post_id']] = $row;
							if ($row['position_period'] <= date("Y-m-d H:i:s")) {
								$newArray[$row['post_id']]['position'] = 'default';
							}
							$newArray[$row['post_id']]['price'] = number_format($newArray[$row['post_id']]['price'], 0, '.', ',');
							$newArray[$row['post_id']]['price_options'] = json_decode($newArray[$row['post_id']]['price_options'], true);
							$newArray[$row['post_id']]['filter'] = json_decode($newArray[$row['post_id']]['filter'], true);
							$newArray[$row['post_id']]['created_at'] = date("m-d | H:i", strtotime($newArray[$row['post_id']]['created_at']));
							$post_images = $this->db->get_where('post_images', array('post_id' => $row['post_id']));
							$post_category = $this->db->get_where('categories', array('category_id' => $row['category_id']));
							if ($post_category->num_rows() > 0) {
								$post_category = $post_category->row_array();
								$post_category_name = json_decode($post_category['name'], true);
								$newArray[$row['post_id']]['category'] = $post_category_name[$this->input->get('language')];
							}else{
								$newArray[$row['post_id']]['category'] = '';
							}
							if ($post_images->num_rows() > 0) {
								$post_images = $post_images->row_array();
                				if (file_exists('./uploads/ads/'.$post_images['filename'])) {
                        			$newArray[$row['post_id']]['image'] = 'uploads/ads/'.$post_images['filename'];
                    			}else{
                    				$newArray[$row['post_id']]['image'] = 'public/images/noimage.jpg';
                    			}
							}else{
								$newArray[$row['post_id']]['image'] = 'public/images/noimage.jpg';
							}
						}
						$item = array(
							'status' => 'success',
							'data' => array_reverse($newArray)
						);//die(print_r($newArray));
						return json_encode($item);
					}else{
						$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
						return json_encode($return);
					}
				break;

				case 'item':
					if (array_key_exists('id', $data)) {
						$query = $this->db->get_where('posts', array('post_id' => $data['id']));
						if ($query->num_rows() > 0) {
							$query = $query->row_array();
							$query['price'] = number_format($query['price'], 0, '.', ' ');
							$query['price_options'] = json_decode($query['price_options'], true);
							$post_category = $this->db->get_where('categories', array('category_id' => $query['category_id']));
							$post_images = $this->db->get_where('post_images', array('post_id' => $query['post_id']));
							if ($post_category->num_rows() > 0) {
								$post_category = $post_category->row_array();
								$post_category_name = json_decode($post_category['name'], true);
								$query['category'] = $post_category_name[$this->input->get('language')];
							}else{
								$query['category'] = '';
							}
							if ($post_images->num_rows() > 0) {
								$post_images = $post_images->result_array();
                				foreach ($post_images as $post_image) {
                					if (file_exists('./uploads/ads/'.$post_image['filename'])) {
                        				$query['image'][] = 'uploads/ads/'.$post_image['filename'];
                    				}
                				}
							}else{
								$query['image'][] = 'public/images/noimage.jpg';
							}
							$filters = json_decode($query['filter'], true);
							$temp_filters = array();
                            if (is_array($filters)) {
                            	foreach ($filters as $key => $value) {
                                	$id = str_replace("filter_", "", $key);
                                    $filter = $this->db->get_where('filters', array('filter_id' => $id));
                                    if ($filter->num_rows() > 0) {
                                    	$filter = $filter->row_array();
                                        $filter_name = json_decode($filter['filter_name'], true);
                                        $filter_content = json_decode($filter['content'], true);
                                        if (is_array($filter_name)) {
                                        	$temp_filters[] = array(
                                        		'name' => $filter_name[$this->input->get('language')],
                                        		'value' => $value
                                        	);
                                        }
                                    }
                                }
                            }
                            $query['filter'] = $temp_filters;
                            $query['uniquekey'] = uniqueKey();
                            $this->Model_core->updateViews($data['id']);
							$item = array(
								'status' => 'success',
								'data' => $query
							);//print_r($query);
							return json_encode($item);
						}else{
							$return = array('status' => 'error', 'message' => 'So\'rovingizga binoan hech qanday ma\'lumot topilmadi!');
							return json_encode($return);
						}
					}else{
						$return = array('status' => 'error', 'message' => 'Xato kalit kiritilgan!');
						return json_encode($return);
					}
				break;
				
				default:
					$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
					return json_encode($return);
				break;
			}
		}else{
			$return = array('status' => 'error', 'message' => 'Kerakli harakat turi tanlanmadi!');
			return json_encode($return);
		}
	}

	private function get_posts($data='')
    {
        
        if (array_key_exists('position', $data)) {$position = $data['position'];}else{$position = 'default';}
        if (array_key_exists('status', $data)) {$status = $data['status'];}else{$status = 2;}
        if (array_key_exists('allcount', $data)) {$allcount = $data['allcount'];}else{$allcount = false;}
        if (array_key_exists('list', $data)) {$list = $data['list'];}else{$list = 'list';}
        if (array_key_exists('sort', $data)) {$sort = $data['sort'];}else{$sort = 'default';}
        if (array_key_exists('category', $data)) {$category = $data['category'];}else{$category = '0';}
        if (array_key_exists('query', $data)) {$query = $data['query'];}else{$query = '';}
        if (array_key_exists('min', $data)) {$min = $data['min'];}else{$min = '0';}
        if (array_key_exists('max', $data)) {$max = $data['max'];}else{$max = '0';}
        if (array_key_exists('limit', $data)) {$limit = $data['limit'];}else{$limit = 8;}
        if (array_key_exists('from', $data)) {$from = $data['from'];}else{$from = 0;}

        if($from != 0){$from = ($from-1) * $limit;}

        if (array_key_exists('filter', $data)) {
            $filters = $data['filter'];
        }else{
            $filters ='';
        }
        if ($category != 0) {
            $this->db->where('category_id', $category);
        }

        if ($query != '') {
            $this->db->like('title', $query);
            //$this->db->or_like('content', $query);
           // $this->db->or_like('address', $query);
        }

        if ($min != 0) {
            $this->db->where('price >=', $min);
        }

        if ($max != 0){
            $this->db->where('price <=', $max);
        }
        
        if ($position == 'default') {
            $this->db->where_in('position', array('default', 'main', 'featured'));
        }else if($position == 'main'){
            $this->db->where('position_period >=', date("Y-m-d H:i:s"));
            $this->db->where_in('position', array('main'));
        }else if($position == 'featured'){
            $this->db->where('position_period >=', date("Y-m-d H:i:s"));
            $this->db->where_in('position', array('main', 'featured'));
        }


        if ($filters != '') {
            foreach ($filters as $key => $value) {
                $filter_content = ' `"filter_'.$key.'":"[^"]*[[:<:]]'.$value.'[[:>:]]`';
                $this->db->where('filter REGEXP ', '\'"filter_'.$key.'":"[[:<:]]'.$value.'[[:>:]]"\'', FALSE);
            }
        }
        
        if ($status==2) {
            $this->db->where_in('status', array('2', '3'));
        }else{
            $this->db->where('status', $status);
        }
        if ($sort == 'default') {
            $this->db->order_by('created_at', 'DESC');
        }else if ($sort == 'cheap') {
            $this->db->order_by('price', 'ASC');
        }else if ($sort == 'expensive') {
            $this->db->order_by('price', 'DESC');
        }else if ($sort == 'new') {
            $this->db->order_by('created_at', 'DESC');
        }else if ($sort == 'old') {
            $this->db->order_by('created_at', 'ASC');
        }else if ($sort == 'name_az') {
            $this->db->order_by('title', 'ASC');
        }else if ($sort == 'name_za') {
            $this->db->order_by('title', 'DESC');
        }else if ($sort == 'rand') {
            $this->db->order_by('rand()');
        }

        if ($allcount == false) {
            if ($position='default') {
                $this->db->limit($limit, $from);
            }else if ($position='featured') {
                $this->db->limit(12, 0);
            }else if ($position='main') {
                $this->db->limit(9, 0);
            }
        }

        return $this->db->get('posts');
    }

    private function getPostImages($post_id='', $limit=3)
    {
        $images = array();
        if ($post_id != '') {
            $post_images = $this->db->limit($limit)->get_where('post_images', array('post_id' => $post_id));
            if ($post_images->num_rows() > 0) {
                $post_images = $post_images->result_array();
                foreach ($post_images as $image) {
                    if (file_exists('./uploads/ads/'.$image['filename'])) {
                        $images[] = base_url().'uploads/ads/'.$image['filename'];
                    }
                }
                if (count($images) == 0) {
                    return base_url().'public/images/noimage.jpg';
                }else{
                    return $images;
                }
            }else{
                return base_url().'public/images/noimage.jpg';
            }
        }else{
            return base_url().'public/images/noimage.jpg';
        }
    }

    private function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
    	$sort_col = array();
    	foreach ($arr as $key=> $row) {
        	$sort_col[$key] = $row[$col];
    	}
		array_multisort($sort_col, $dir, $arr);
	}

	private function get_news($data='')
    {
        
        if (array_key_exists('category', $data)) {$category = $data['category'];}else{$category = '0';}
        if (array_key_exists('limit', $data)) {$limit = $data['limit'];}else{$limit = 8;}
        if (array_key_exists('from', $data)) {$from = $data['from'];}else{$from = 0;}
        if (array_key_exists('language', $data)) {$language = $data['language'];}else{$language = getDefaultLang();}

        if($from != 0){$from = ($from-1) * $limit;}

        if ($category != 0) {
            $this->db->where('category_id', $category);
        }
        $this->db->where('language', $language);
        $this->db->order_by('date', 'DESC');

        $this->db->limit($limit, $from);

        return $this->db->get('news');
    }

    private function image_handler($data) {
    	if (array_key_exists('file', $data)) {
    		$source_image = base_url().$data['file'];
    		if(@getimagesize($source_image)){
				$source_image = base_url().$data['file'];
			}else{
    			$source_image = base_url()."public/images/noimage.jpg";
			}
    	}else{
    		$source_image = base_url()."public/images/noimage.jpg";
    	}
    	if (array_key_exists('quality', $data)) {
    		$quality = $data['quality'];
    	}else{
    		$quality = 80;
    	}
    	if (array_key_exists('width', $data)) {
    		$tn_w = $data['width'];
    	}else{
    		$tn_w = 750;
    	}
    	if (array_key_exists('height', $data)) {
    		$tn_h = $data['height'];
    	}else{
    		$tn_h = 420;
    	}
    	if (array_key_exists('wmsource', $data)) {
    		$wmsource = $data['wmsource'];
    	}else{
    		$wmsource = false;
    	}
  		$info = getimagesize($source_image);
  		$imgtype = image_type_to_mime_type($info[2]);

  		switch ($imgtype) {
  			case 'image/jpeg':
  				$source = imagecreatefromjpeg($source_image);
  			break;
  			case 'image/gif':
  				$source = imagecreatefromgif($source_image);
  			break;
  			case 'image/png':
  				$source = imagecreatefrompng($source_image);
  			break;
  			default:
  				die('Invalid image type.');
  		}

  		$src_w = imagesx($source);
  		$src_h = imagesy($source);
  		$src_ratio = $src_w/$src_h;

  		if ($tn_w/$tn_h > $src_ratio) {
  			$new_h = $tn_w/$src_ratio;
  			$new_w = $tn_w;
 		} else {
  			$new_w = $tn_h*$src_ratio;
  			$new_h = $tn_h;
  		}
  		$x_mid = $new_w/2;
  		$y_mid = $new_h/2;

  		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
  		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
  		$final = imagecreatetruecolor($tn_w, $tn_h);
  		imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);

  		if($wmsource) {
  			$info = getimagesize($wmsource);
  			$imgtype = image_type_to_mime_type($info[2]);
  			switch ($imgtype) {
  				case 'image/jpeg':
    				$watermark = imagecreatefromjpeg($wmsource);
    			break;
  				case 'image/gif':
    				$watermark = imagecreatefromgif($wmsource);
    			break;
  				case 'image/png':
    				$watermark = imagecreatefrompng($wmsource);
    			break;
  				default:
    				die('Invalid watermark type.');
  			}

  			$wm_w = imagesx($watermark);
  			$wm_h = imagesy($watermark);

  			$wm_x = $tn_w - $wm_w;
  			$wm_y = $tn_h - $wm_h;

  			imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
  		}

  		$result = Imagejpeg($newpic,NULL,$quality);
  		imagedestroy($result);
  		return $result;
	}

	public function postad($data, $files)
  {
    if ($data && $files) {
      $title = $data['title'];
      $category = $data['category'];
      if ($category == null) {$category = 0;}
      $price = $data['price'];
      if ($price == null) {$price = 0;}
      $currency = $data['currency'];
      if ($currency == null) {$currency = 0;}
      $covenant = $data['covenant'];
      if ($covenant == null) {$covenant = 0;}
      $content = $data['content'];
      $onwer_name = $data['onwer_name'];
      $onwer_phone = $data['onwer_phone'];
      $onwer_email = $data['onwer_email'];
      $onwer_address = $data['onwer_address'];
      $service_type = $data['service_type'];
      if ($service_type == null) {$service_type = 0;}
      if (strlen($title) < 5 || $category == '0' || strlen($content) < 8 || strlen($onwer_name) < 3 || strlen($onwer_phone) < 3 || strlen($onwer_address) < 3 || $service_type == '0') {
        $return = array('status' => 'error', 'message' => 'Kerakli maydonlar to\'ldirilmagan!');
		echo json_encode($return);
      }else{
      	$filters = "";
        if (array_key_exists('filter', $data)) {
          $filters = array();
          if (count($data['filter']) > 0) {
            foreach ($data['filter'] as $key => $value) {
              if ($key != '' && $value !='') {
                $filters['filter_'.$key] = $value;
              }
            }
            $filters = json_encode($filters);
          }else{
            $filters = "";
          }
          
        }
        
        $data_array = array(
          'title' => $title,
          'content' => $content,
          'price' => $price,
          'price_options' => json_encode(array('currency' => $currency, 'covenant' => $covenant)),
          'contact_name' => $onwer_name,
          'email' => $onwer_email,
          'phone' => $onwer_phone,
          'address' => $onwer_address,
          'pricing_id' => $service_type,
          'filter' => $filters,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
          'deleted_at' => date('Y-m-d H:i:s'),
          'status' => 1,
          'visits' => 0,
          'template' => 'default',
          'position' => 'default',
          'position_period' => date('Y-m-d H:i:s'),
          'category_id' => $category,
          'user_id' => 1
        );

        $this->db->insert('posts', $data_array);
        $insert_id = $this->db->insert_id();

        if (count($files['files']['name']) > 0) {
          $this->load->library( 'image_lib' );
          foreach ($files['files']['name'] as $key => $value) {
            $filename = $value;
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            $target_dir = './uploads/ads/';
            if (move_uploaded_file($files['files']["tmp_name"][$key], $target_dir.$newfilename)) {
              $image_data = array(
                'post_id' => $insert_id,
                'name' => $value,
                'size' => $files['files']["size"][$key],
                'filename' => $newfilename,
                'status' => 1
              );
              $this->db->insert('post_images', $image_data);
              image_handler($target_dir.$newfilename,$target_dir.$newfilename,800,600,90,'./public/images/watermark.png');
            }
          }
        }

        $return = array('status' => 'success', 'data' => $data_array);
		echo json_encode($return);

      }
    }else{
      	$return = array('status' => 'error', 'message' => 'Kerakli maydonlar to\'ldirilmagan!');
		echo json_encode($return);
    }
  }

}
