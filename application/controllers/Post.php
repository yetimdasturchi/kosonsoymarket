<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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
	public function index()
	{
		redirect(base_url());
	}

	public function contact()
	{
		
		if ($_POST) {
			$_POST['date'] = time();
			$_POST['status'] = 0;
			$this->db->insert('contacts', $_POST);
			$message = array('status' => 'success', 'message' => get_phrase('contact_succes_message'));
			echo json_encode($message);
		}else{
			$message = array('status' => 'error', 'message' => get_phrase('fields_not_filled'));
			echo json_encode($message);
		}
	}

	public function loadnews($rowno=0)
	{
		$rowperpage = 6;
 
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
  		if ($_POST['category_id']) {
  			$category_id = $_POST['category_id'];
  		}else{
  			$category_id = 0;
  		}
  		if ( $category_id != 0) {
  			$this->db->where('category_id', $category_id);
        }
  		$this->db->where('language', getDefaultLang());
  		$this->db->limit($rowperpage, $rowno);
        $news_record = $this->db->get('news');

		$allcount = $this->Model_core->getNewsRecordCount($category_id);


  		$result = '';

  		foreach ($news_record->result_array() as $row) {
  			$result .= $this->load->view('news/col_md_6', array('data' => $row), TRUE);
  		}
  		
  		$result = str_replace('{base_url}', base_url(), $result);

      $config['base_url'] = base_url().'p/news';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $allcount;
      $config['per_page'] = $rowperpage;
 
      $config['full_tag_open']    = '<ul class="pagination pagination-lg">';
      $config['full_tag_close']   = '</ul>';
      $config['num_tag_open']     = '<li>';
      $config['num_tag_close']    = '</li>';
      $config['cur_tag_open']     = '<li class="active"><a>';
      $config['cur_tag_close']    = '</a></li>';
      $config['next_tag_open']    = '<li>';
      $config['next_tag_close']  = '</li>';
      $config['prev_tag_open']    = '<li>';
      $config['prev_tag_close']  = '</li>';
      $config ['prev_link'] = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
    	$config ['next_link'] = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
      $config['first_link'] = false; 
    	$config['last_link']  = false;
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $result;
 
        echo json_encode($data);
	}

  public function get_filter($category_id='')
  {
    if ($category_id != '') {
      if (!isset($_POST)) {
        //$_POST = array();
      }
      $this->load->view('ads/filter', array('category_id' => $category_id, $_POST));
    }else{
      echo "";
    }
  }

  public function getads()
  {
    $data = $this->Model_core->posts($_POST, 2, 'default');
    
    $featured = '';
    $default = '';
    
    if ($data->num_rows() > 0) {
      $data = $data->result_array();
      foreach ($data as $row) {
        if (isset($_POST['list'])) {
          if ($_POST['list'] == 'list') {
            $list = 'single_list';
          }else if ($_POST['list'] == 'grid') {
            $list = 'single_grid';
          }else{
            $list = 'single_list';
          }
        }
        $default .= $this->load->view('ads/'.$list, array('data' => $row), true);
      }
      echo json_encode(array('default' => $default, 'featured' => $this->getfeaturedads()));
    }else{
      echo "empty";
    }
  }

  public function getfeaturedads()
  {
    $_POST['sort'] = "rand"; $_POST['limit'] = 12; $_POST['from'] = 0;
    $data = $this->Model_core->posts($_POST, 2, 'featured');
    if ($data->num_rows() > 0) {
      $data = $data->result_array();
      return $this->load->view('ads/featured', array('data' => $data), true);
    }else{
      return "empty";
    }
  }

  public function postpagination()
  {
    echo $this->Model_core->postPagination($_POST, 2, 'default');
  }

  public function postad()
  {
    if ($_POST && $_FILES) {
      $title = $_POST['title'];
      $category = $_POST['category'];
      $price = $_POST['price'];
      $currency = $_POST['currency'];
      $covenant = $_POST['covenant'];
      $content = $_POST['content'];
      $onwer_name = $_POST['onwer_name'];
      $onwer_phone = $_POST['onwer_phone'];
      $onwer_email = $_POST['onwer_email'];
      $onwer_address = $_POST['onwer_address'];
      $service_type = $_POST['service_type'];
      if (strlen($title) < 8 || $category == '0' || $price == '0' ||  strlen($content) < 8 || strlen($onwer_name) < 3 || strlen($onwer_phone) < 3 || strlen($onwer_address) < 3 || $service_type == '0') {
        echo json_encode(array('status' => 'error', 'message' => get_phrase('fields_not_filled')));
      }else{
        $filters = "";
        if (array_key_exists('filter', $_POST)) {
          $filters = array();
          if (count($_POST['filter']) > 0) {
            foreach ($_POST['filter'] as $key => $value) {
              if ($key != '' && $value !='') {
                $filters['filter_'.$key] = $value;
              }
            }
            $filters = json_encode($filters);
          }else{
            $filters = "";
          }
          
        }
        
        $data = array(
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

        $this->db->insert('posts', $data);
        $insert_id = $this->db->insert_id();

        if (count($_FILES['files']['name']) > 0) {
          $this->load->library( 'image_lib' );
          foreach ($_FILES['files']['name'] as $key => $value) {
            $filename = $value;
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            $target_dir = './uploads/ads/';
            if (move_uploaded_file($_FILES['files']["tmp_name"][$key], $target_dir.$newfilename)) {
              $image_data = array(
                'post_id' => $insert_id,
                'name' => $value,
                'size' => $_FILES['files']["size"][$key],
                'filename' => $newfilename,
                'status' => 1
              );
              $this->db->insert('post_images', $image_data);
              image_handler($target_dir.$newfilename,$target_dir.$newfilename,800,600,90,'./public/images/watermark.png');
            }
          }
        }

        echo json_encode(array('status' => 'success', 'message' => 'ok'));

      }
    }else{
      echo json_encode(array('status' => 'error', 'message' => get_phrase('fields_not_filled')));
    }
  }
}
