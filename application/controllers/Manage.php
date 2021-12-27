<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

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

	public function __construct()
	{
		parent::__construct();
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		if (!$this->Model_manage->logged()){
			if ($_POST) {
				if ($this->Model_manage->check_username($_POST['username'])->num_rows() > 0) {
					$user = $this->Model_manage->check_password($_POST['username'],$_POST['password']);
					if ($user->num_rows() > 0) {
						$user = $user->first_row('array');
						$this->session->set_userdata('logged', 1);
						$this->session->set_userdata($user);
						redirect(current_url(), 'refresh');
					}else{
						$this->session->set_flashdata('message', 'Parol xato kiritildi');
						redirect(current_url(), 'refresh');
					}
				}else{
					$this->session->set_flashdata('message', 'Login xato kiritildi');
					redirect(current_url(), 'refresh');
				}
			}else{
				$this->load->view('manage/login');
			}
		}
		//die(print_r($this->session->userdata()));
    }

    public function index()
    {
    	if ($this->Model_manage->logged() == true){
    		$this->load->view('manage/header');
			$this->load->view('manage/index');
			$this->load->view('manage/footer');
		}
    }

    public function contacts($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('contacts')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'view':
					if ($id == '') {$id=0;}
					$contact = $this->db->get_where('contacts', array('contact_id' => $id));
					if ($contact->num_rows() > 0) {
						$contact = $contact->row_array();
						$this->load->view('manage/contacts/view', array('contact' => $contact));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'read':
					if ($id == '') {$id=0;}
					$contact = $this->db->get_where('contacts', array('contact_id' => $id));
					if ($contact->num_rows() > 0) {
						$contact = $contact->row_array();
						if($contact['status']==1){
							$this->db->update('contacts', array('status' => 0), array('contact_id' => $id));
						}else{
							$this->db->update('contacts', array('status' => 1), array('contact_id' => $id));
						}
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						echo 'error';
					}
				break;

				case 'delete':
					if ($id == '') {$id=0;}
					$contact = $this->db->get_where('contacts', array('contact_id' => $id));
					if ($contact->num_rows() > 0) {
						$this->db->delete('contacts', array('contact_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni o\'chirishda xatolik');
						echo 'error';
					}
				break;
				
				default:
					$this->load->view('manage/header');
					$this->load->view('manage/contacts/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function stats($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('stats')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
    	switch ($action) {
    		case 'view':
				if ($id == '') {$id=0;}
				$visitor = $this->db->get_where('visitors', array('visitor_id' => $id));
				if ($visitor->num_rows() > 0) {
					$visitor = $visitor->row_array();
					$this->load->view('manage/stats/view', array('item' => $visitor));
				}else{
					$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
					echo 'error';
				}
			break;

    		case 'map':
    			$this->load->view('manage/header');
				$this->load->view('manage/stats/map');
				$this->load->view('manage/footer');
    		break;
    		
    		default:
    			$this->load->view('manage/header');
				$this->load->view('manage/stats/list');
				$this->load->view('manage/footer');
			break;
    	}
    	}
    }

    public function news($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('news')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				
				case 'view':
					if ($id == '') {$id=0;}
					$news = $this->db->get_where('news', array('news_id' => $id));
					if ($news->num_rows() > 0) {
						$news = $news->row_array();
						$this->load->view('manage/news/view', array('item' => $news));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'add':
					$this->load->view('manage/header');
					$this->load->view('manage/news/add');
					$this->load->view('manage/footer');
				break;
				
				case 'edit':
					if ($id == '') {$id=0;}
					$news = $this->db->get_where('news', array('news_id' => $id));
					if ($news->num_rows() > 0) {
						$news = $news->row_array();
						$this->load->view('manage/header');
						$this->load->view('manage/news/edit', array('news' => $news));
						$this->load->view('manage/footer');
					}else{
						$this->session->set_flashdata('message', 'Xabar topilmadi');
            			redirect(base_url('manage/news/list'));
					}
				break;

				case 'delete':
					if ($id == '') {$id=0;}
					$news = $this->db->get_where('news', array('news_id' => $id));
					if ($news->num_rows() > 0) {
						$news = $news->row_array();
						$news['photo'] = str_replace("{base_url}", './', $news['photo']);
						@unlink($news['photo']);
						$this->db->delete('news', array('news_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni o\'chirishda xatolik');
						echo 'error';
					}
				break;

				case 'insert':
					if (count($this->input->post()) > 0) {
						if (count($_FILES) > 0) {
							$filename = $_FILES['photo']['name'];
            				$file_basename = substr($filename, 0, strripos($filename, '.'));
            				$file_ext = substr($filename, strripos($filename, '.'));
            				$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            				$target_dir = './uploads/news/';
            				if (move_uploaded_file($_FILES['photo']["tmp_name"], $target_dir.$newfilename)) {
              					$data = array(
                					'slug' => slugify($this->input->post('title')),
                					'title' => $this->input->post('title'),
                					'language' => $this->input->post('language'),
                					'content' => '<div class="ql-editor">'.$this->input->post('content').'</div>',
                					'tags' => create_metatags($this->input->post('content'), 5),
                					'date' => time(),
                					'photo' => '{base_url}uploads/news/'.$newfilename,
                					'category_id' => $this->input->post('category'),
                					'comment' => 1,
                					'meta_title' => $this->input->post('title'),
                					'meta_keyword' => create_metatags($this->input->post('content'), 20),
                					'meta_description' => shorttext($this->input->post('content')),
              					);
              					$this->db->insert('news', $data);
              					image_handler($target_dir.$newfilename,$target_dir.$newfilename,720,460,90,'./public/images/watermark.png');
              					$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              					redirect($this->agent->referrer());
            				}else{
            					$this->session->set_flashdata('message', 'Rasmni yuklashda xatolik!');
            					redirect($this->agent->referrer());
            				}
						}else{
							$this->session->set_flashdata('message', 'Rasmni yuklashda xatolik!');
            				redirect($this->agent->referrer());
						}
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect($this->agent->referrer());
					}
				break;

				case 'update':
					if ($id == '') {$id=0;}
					$news = $this->db->get_where('news', array('news_id' => $id));
					if ($news->num_rows() > 0) {
						$news = $news->row_array();
						if (count($this->input->post()) > 0) {
							$data = array(
                				'slug' => slugify($this->input->post('title')),
                				'title' => $this->input->post('title'),
                				'language' => $this->input->post('language'),
                				'content' => '<div class="ql-editor">'.$this->input->post('content').'</div>',
                				'tags' => create_metatags($this->input->post('content'), 5),
                				'category_id' => $this->input->post('category'),
                				'meta_title' => $this->input->post('title'),
                				'meta_keyword' => create_metatags($this->input->post('content'), 20),
                				'meta_description' => shorttext($this->input->post('content')),
              				);
              				if (count($_FILES) > 0) {
              					$filename = $_FILES['photo']['name'];
            					$file_basename = substr($filename, 0, strripos($filename, '.'));
            					$file_ext = substr($filename, strripos($filename, '.'));
            					$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            					$target_dir = './uploads/news/';
            					if (move_uploaded_file($_FILES['photo']["tmp_name"], $target_dir.$newfilename)) {
            						$news['photo'] = str_replace("{base_url}", './', $news['photo']);
									@unlink($news['photo']);

            						$data['photo'] = '{base_url}uploads/news/'.$newfilename;

            						image_handler($target_dir.$newfilename,$target_dir.$newfilename,720,460,90,'./public/images/watermark.png');
            					}
              				}

              				$this->db->update('news', $data, array('news_id' => $id));

              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
            				redirect($this->agent->referrer());

						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect($this->agent->referrer());
						}
					}else{
						$this->session->set_flashdata('message', 'Xabar topilmadi');
            			redirect(base_url('manage/news/list'));
					}
				break;
				
				default:
					$this->load->view('manage/header');
					$this->load->view('manage/news/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function partners($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('partners')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'add':
					$this->load->view('manage/header');
					$this->load->view('manage/partners/add');
					$this->load->view('manage/footer');
				break;
				case 'edit':
					if ($id == '') {$id=0;}
					$partner = $this->db->get_where('partners', array('partner_id' => $id));
					if ($partner->num_rows() > 0) {
						$partner = $partner->row_array();
						$this->load->view('manage/partners/edit', array('partner' => $partner));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'insert':
					if (count($this->input->post()) > 0) {
						if (count($_FILES) > 0) {
							$filename = $_FILES['photo']['name'];
            				$file_basename = substr($filename, 0, strripos($filename, '.'));
            				$file_ext = substr($filename, strripos($filename, '.'));
            				$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            				$target_dir = './uploads/parners/';
            				if (move_uploaded_file($_FILES['photo']["tmp_name"], $target_dir.$newfilename)) {
              					$data = array(
                					'name' => $this->input->post('name'),
                					'url' => $this->input->post('url'),
                					'image' => '/uploads/parners/'.$newfilename
              					);
              					$this->db->insert('partners', $data);
              					image_handler($target_dir.$newfilename,$target_dir.$newfilename,320,150,90);
              					$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              					redirect(base_url('manage/partners/list'));
            				}else{
            					$this->session->set_flashdata('message', 'Rasmni yuklashda xatolik!');
            					redirect(base_url('manage/partners/add'));
            				}
						}else{
							$this->session->set_flashdata('message', 'Rasmni yuklashda xatolik!');
            				redirect(base_url('manage/partners/add'));
						}
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect(base_url('manage/partners/add'));
					}
				break;

				case 'update':
					if ($id == '') {$id=0;}
					$partner = $this->db->get_where('partners', array('partner_id' => $id));
					if ($partner->num_rows() > 0) {
						$partner = $partner->row_array();
						if (count($this->input->post()) > 0) {
							$data = array(
                				'name' => $this->input->post('name'),
                				'url' => $this->input->post('url'),
              				);
              				if (count($_FILES) > 0) {
              					$filename = $_FILES['photo']['name'];
            					$file_basename = substr($filename, 0, strripos($filename, '.'));
            					$file_ext = substr($filename, strripos($filename, '.'));
            					$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            					$target_dir = './uploads/parners/';
            					if (move_uploaded_file($_FILES['photo']["tmp_name"], $target_dir.$newfilename)) {
            						@unlink('.'.$partner['image']);

            						$data['image'] = '/uploads/parners/'.$newfilename;

            						image_handler($target_dir.$newfilename,$target_dir.$newfilename,320,150,90);
            					}
              				}

              				$this->db->update('partners', $data, array('partner_id' => $id));

              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
            				redirect(base_url('manage/partners/list'));

						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect(base_url('manage/partners/list'));
						}
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
            			redirect(base_url('manage/partners/list'));
					}
				break;

				case 'delete':
					if ($id == '') {$id=0;}
					$partner = $this->db->get_where('partners', array('partner_id' => $id));
					if ($partner->num_rows() > 0) {
						$partner = $partner->row_array();
						@unlink('.'.$partner['image']);
						$this->db->delete('partners', array('partner_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot o\'chirishda xatolik');
						echo 'error';
					}
				break;
				
				default:
					$this->load->view('manage/header');
					$this->load->view('manage/partners/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function pricing($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('pricing')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'view':
					if ($id == '') {$id=0;}
					$price = $this->db->get_where('pricing', array('price_id' => $id));
					if ($price->num_rows() > 0) {
						$price = $price->row_array();
						$this->load->view('manage/pricing/view', array('price' => $price));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;
				case 'featured':
					if ($id == '') {$id=0;}
					$price = $this->db->get_where('pricing', array('price_id' => $id));
					if ($price->num_rows() > 0) {
						$price = $price->row_array();
						if($price['featured']=='featured'){
							$this->db->update('pricing', array('featured' => ''), array('price_id' => $id));
						}else{
							$this->db->update('pricing', array('featured' => 'featured'), array('price_id' => $id));
						}
						$this->session->set_flashdata('message', 'Ma\'lumotni muvaffaqiyatli yangilandi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						echo 'error';
					}
				break;
				case 'add':
					$this->load->view('manage/header');
					$this->load->view('manage/pricing/add');
					$this->load->view('manage/footer');
				break;
				case 'edit':
					if ($id == '') {$id=0;}
					$price = $this->db->get_where('pricing', array('price_id' => $id));
					if ($price->num_rows() > 0) {
						$price = $price->row_array();
						$this->load->view('manage/header');
						$this->load->view('manage/pricing/edit', array('price' => $price));
						$this->load->view('manage/footer');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
            			redirect(base_url('manage/pricing/list'));
					}
				break;

				case 'insert':
					if (count($this->input->post()) > 0) {
						$content = $this->input->post('content');
						foreach ($content as $key => $value) {
							$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
						}
						$data = array(
							'price' => $this->input->post('price'),
                			'featured' => $this->input->post('featured'),
                			'name' => json_encode($this->input->post('name')),
                			'subtitle' => json_encode($this->input->post('subtitle')),
                			'content' => json_encode($content),
              			);
              			$this->db->insert('pricing', $data);
              			$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              			redirect(base_url('manage/pricing/list'));
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect(base_url('manage/pricing/add'));
					}
				break;

				case 'update':
					if ($id == '') {$id=0;}
					$price = $this->db->get_where('pricing', array('price_id' => $id));
					if ($price->num_rows() > 0) {
						$price = $price->row_array();
						if (count($this->input->post()) > 0) {
							$content = $this->input->post('content');
							foreach ($content as $key => $value) {
								$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
							}
							$data = array(
								'price' => $this->input->post('price'),
                				'featured' => $this->input->post('featured'),
                				'name' => json_encode($this->input->post('name')),
                				'subtitle' => json_encode($this->input->post('subtitle')),
                				'content' => json_encode($content),
              				);
              				$this->db->update('pricing', $data, array('price_id' => $id));
              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              				redirect(base_url('manage/pricing/list'));
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect(base_url('manage/pricing/add'));
						}
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
            			redirect(base_url('manage/pricing/list'));
					}
				break;

				case 'delete':
					if ($id == '') {$id=0;}
					$price = $this->db->get_where('pricing', array('price_id' => $id));
					if ($price->num_rows() > 0) {
						$price = $price->row_array();
						$this->db->delete('pricing', array('price_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot o\'chirishda xatolik');
						echo 'error';
					}
				break;
				
				default:
					$this->load->view('manage/header');
					$this->load->view('manage/pricing/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function sections($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('sections')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'news':
					$this->load->view('manage/header');
					$this->load->view('manage/sections/news');
					$this->load->view('manage/footer');
				break;

				case 'posts':
					$this->load->view('manage/header');
					$this->load->view('manage/sections/posts');
					$this->load->view('manage/footer');
				break;

				case 'filters':
					$this->load->view('manage/header');
					$this->load->view('manage/sections/filters');
					$this->load->view('manage/footer');
				break;

				case 'posts_add':
					$this->load->view('manage/header');
					$this->load->view('manage/sections/posts_add');
					$this->load->view('manage/footer');
				break;

				case 'filters_add':
					$this->load->view('manage/header');
					$this->load->view('manage/sections/filters_add');
					$this->load->view('manage/footer');
				break;

				case 'news_view':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('news_category', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$this->load->view('manage/sections/news_view', array('item' => $category));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'posts_view':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$this->load->view('manage/sections/post_view', array('item' => $category));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'filters_view':
					if ($id == '') {$id=0;}
					$filter = $this->db->get_where('filters', array('filter_id' => $id));
					if ($filter->num_rows() > 0) {
						$filter = $filter->row_array();
						$this->load->view('manage/sections/filter_view', array('item' => $filter));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'filters_sort':
					if ($id == '') {$id=0;}
					$filter = $this->db->get_where('filters', array('filter_id' => $id));
					if (count($this->input->post()) > 0) {
						if ($filter->num_rows() > 0) {
							$this->db->update('filters', $this->input->post(), array('filter_id' => $id));
              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              				redirect(base_url('manage/sections/filters'));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							redirect(base_url('manage/sections/filters'));
						}
					}else{
						if ($filter->num_rows() > 0) {
							$filter = $filter->row_array();
							$this->load->view('manage/sections/filter_sort', array('item' => $filter));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							echo 'error';
						}
					}
					
				break;

				case 'news_edit':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('news_category', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$this->load->view('manage/sections/news_edit', array('item' => $category));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'posts_edit':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$this->load->view('manage/header');
						$this->load->view('manage/sections/posts_edit', array('item' => $category));
						$this->load->view('manage/footer');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						redirect(base_url('manage/sections/posts'));
					}
				break;

				case 'filters_edit':
					if ($id == '') {$id=0;}
					$filter = $this->db->get_where('filters', array('filter_id' => $id));
					if ($filter->num_rows() > 0) {
						$filter = $filter->row_array();
						$this->load->view('manage/header');
						$this->load->view('manage/sections/filters_edit', array('item' => $filter));
						$this->load->view('manage/footer');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						redirect(base_url('manage/sections/filters'));
					}
				break;

				case 'news_insert':
					if (count($this->input->post()) > 0) {
						$this->db->insert('news_category', $this->input->post());
              			$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              			redirect(base_url('manage/sections/news'));
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect(base_url('manage/sections/news'));
					}
				break;

				case 'posts_insert':
					if (count($this->input->post()) > 0) {
						$data = array(
							'parent_id' => $this->input->post('parent_id'),
                			'slug' => $this->input->post('slug'),
                			'icon' => $this->input->post('icon'),
                			'status' => $this->input->post('status'),
                			'name' => json_encode($this->input->post('name')),
                			'title' => json_encode($this->input->post('title')),
                			'keywords' => json_encode($this->input->post('keywords')),
                			'description' => json_encode($this->input->post('description')),
              			);
              			$this->db->insert('categories', $data);
              			$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              			redirect(base_url('manage/sections/posts'));
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect(base_url('manage/sections/posts_add'));
					}
				break;

				case 'filters_insert':
					if (count($this->input->post()) > 0) {
						$content = $this->input->post('content');
						if ($content != '') {
							foreach ($content as $key => $value) {
								$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
							}
							foreach ($content as $key => $value) {
								if (array_key_exists($key, $content)) {
									foreach ($content[$key] as $item_key => $item_value) {
										$content[$key][$item_key] = explode('|', $content[$key][$item_key]);
										$content[$key][$item_key]['label'] = $content[$key][$item_key][0];
										$content[$key][$item_key]['value'] = $content[$key][$item_key][1];
										unset($content[$key][$item_key][0]); unset($content[$key][$item_key][1]);
									}
								}
							}
						}

						$options = $this->input->post('options');
						if ($options != '') {
							foreach ($options as $key => $value) {
								if ($value != '' && $value != 'null') {
									$options[$key] = $key.'|'.$value;  
								}else{
									unset($options[$key]);
								}
							}
							$options = implode(PHP_EOL, $options);
						}else{
							$options = '';
						}

						$data = array(
							'category_id' => $this->input->post('category_id'),
                			'sort' => $this->input->post('sort'),
                			'action' => $this->input->post('action'),
                			'type' => $this->input->post('type'),
                			'filter_name' => json_encode($this->input->post('filter_name')),
                			'options' => $options,
                			'content' => json_encode($content),
              			);
              			$this->db->insert('filters', $data);
              			$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              			redirect(base_url('manage/sections/filters'));
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            			redirect(base_url('manage/sections/filters'));
					}
				break;

				case 'news_update':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('news_category', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						if (count($this->input->post()) > 0) {
							$this->db->update('news_category', $this->input->post(), array('category_id' => $id));
              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              				redirect(base_url('manage/sections/news'));
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect(base_url('manage/sections/news'));
						}
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						redirect(base_url('manage/sections/news'));
					}
				break;

				case 'posts_update':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						if (count($this->input->post()) > 0) {
							$data = array(
								'parent_id' => $this->input->post('parent_id'),
                				'slug' => $this->input->post('slug'),
                				'icon' => $this->input->post('icon'),
                				'status' => $this->input->post('status'),
                				'name' => json_encode($this->input->post('name')),
                				'title' => json_encode($this->input->post('title')),
                				'keywords' => json_encode($this->input->post('keywords')),
                				'description' => json_encode($this->input->post('description')),
              				);
              				$this->db->update('categories', $data, array('category_id' => $id));
              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              				redirect(base_url('manage/sections/posts'));
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect(base_url('manage/sections/posts'));
						}
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						redirect(base_url('manage/sections/posts'));
					}
				break;

				case 'filters_update':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();

						if (count($this->input->post()) > 0) {
							$content = $this->input->post('content');
							if ($content != '') {
								foreach ($content as $key => $value) {
									$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
								}
								foreach ($content as $key => $value) {
									if (array_key_exists($key, $content)) {
										foreach ($content[$key] as $item_key => $item_value) {
											$content[$key][$item_key] = explode('|', $content[$key][$item_key]);
											$content[$key][$item_key]['label'] = $content[$key][$item_key][0];
											$content[$key][$item_key]['value'] = $content[$key][$item_key][1];
											unset($content[$key][$item_key][0]); unset($content[$key][$item_key][1]);
										}
									}
								}
							}

							$options = $this->input->post('options');
							if ($options != '') {
								foreach ($options as $key => $value) {
									if ($value != '' && $value != 'null') {
										$options[$key] = $key.'|'.$value;  
									}else{
										unset($options[$key]);
									}
								}
								$options = implode(PHP_EOL, $options);
							}else{
								$options = '';
							}

							$data = array(
								'category_id' => $this->input->post('category_id'),
                				'sort' => $this->input->post('sort'),
                				'action' => $this->input->post('action'),
                				'type' => $this->input->post('type'),
                				'filter_name' => json_encode($this->input->post('filter_name')),
                				'options' => $options,
                				'content' => json_encode($content),
              				);
              				$this->db->update('filters', $data, array('filter_id' => $id));
              				$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
              				redirect(base_url('manage/sections/filters'));
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'dirilmadi!');
            				redirect(base_url('manage/sections/filters'));
						}
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						redirect(base_url('manage/sections/filters'));
					}
				break;

				case 'news_delete':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('news_category', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$this->db->delete('news_category', array('category_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot o\'chirishda xatolik');
						echo 'error';
					}
				break;
				
				case 'posts_delete':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						
						$subcategories = $this->db->get_where('categories', array('parent_id' => $id));
						if ($subcategories->num_rows() > 0) {
							foreach ($subcategories->result_array() as $subcategory) {
								$subcategory_posts = $this->db->get_where('posts', array('category_id' => $subcategory['category_id']));
								if ($subcategory_->num_rows() > 0) {
									foreach ($subcategory_->result_array() as $subcategory_post) {
										$subcategory_post_images = $this->db->get_where('post_images', array('post_id' => $subcategory_post['post_id']));
										if ($subcategory_post_images->num_rows() > 0) {
											foreach ($subcategory_post_images->result_array() as $subcategory_post_image) {
												if (file_exists('./uploads/ads/'.$subcategory_post_image['filename'])) {
													@unlink('./uploads/ads/'.$subcategory_post_image['filename']);
												}
												$this->db->delete('post_images', array('image_id' => $subcategory_post_image['image_id']));
											}
										}
										$this->db->delete('posts', array('post_id' => $subcategory_post['post_id']));
									}
								}
								$this->db->delete('categories', array('category_id' => $subcategory['category_id']));
							}
						}
						$posts = $this->db->get_where('posts', array('category_id' => $id));
						if ($posts->num_rows() > 0) {
							foreach ($posts->result_array() as $post) {
								$post_images = $this->db->get_where('post_images', array('post_id' => $post['post_id']));
								if ($post_images->num_rows() > 0) {
									foreach ($post_images->result_array() as $post_image) {
										if (file_exists('./uploads/ads/'.$post_image['filename'])) {
											@unlink('./uploads/ads/'.$post_image['filename']);
										}
										$this->db->delete('post_images', array('image_id' => $post_image['image_id']));
									}
								}
								$this->db->delete('posts', array('post_id' => $post['post_id']));
							}
						}
						$this->db->delete('filters', array('category_id' => $id));
						$this->db->delete('categories', array('category_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni o\'chirishda xatolik');
						echo 'error';
					}
				break;

				case 'filters_delete':
					if ($id == '') {$id=0;}
					$filter = $this->db->get_where('filters', array('filter_id' => $id));
					if ($filter->num_rows() > 0) {
						$filter = $filter->row_array();
						$this->db->delete('filters', array('filter_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot o\'chirishda xatolik');
						echo 'error';
					}
				break;

				case 'posts_status':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						if($category['status']==1){
							$this->db->update('categories', array('status' => '0'), array('category_id' => $id));
							$this->db->update('categories', array('status' => '0'), array('parent_id' => $id));
						}else{
							$this->db->update('categories', array('status' => '1'), array('category_id' => $id));
							$this->db->update('categories', array('status' => '1'), array('parent_id' => $id));
						}
						$this->session->set_flashdata('message', 'Ma\'lumotni muvaffaqiyatli yangilandi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						echo 'error';
					}
				break;

				default:
					redirect(base_url('manage'));
				break;
			}
		}
    }

     public function settings($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('settings')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'telegram':
					if ($id=='bot_settings') {
						$array = array();
						if (array_key_exists('channels', $_POST)) {
							for ($i=0; $i < count($_POST['channels']['name']); $i++) { 
								$array[$i] = array('name' => $_POST['channels']['name'][$i], 'username' => $_POST['channels']['username'][$i]);
							}
							$_POST['channels'] = $array;
						}
						$this->db->update('settings', array('value' => json_encode($_POST)), array('key' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						redirect(base_url('manage/settings/telegram'));
					}

					if ($id=='telegram_template') {
						if (count($this->input->post()) > 0) {
							@file_put_contents('./public/data/telegram_template.txt', $this->input->post('telegram_template'));
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						}
						redirect(base_url('manage/settings/telegram'));
					}

					$this->load->view('manage/header');
					$this->load->view('manage/settings/telegram');
					$this->load->view('manage/footer');
				break;

				case 'language':

					if ($id == 'save') {
						if (count($this->input->post()) > 0) {
							$language_id = $this->input->post('language_id');
							$language_data = $this->input->post('language_data');
							@file_put_contents('./application/language/lng_files/'.$language_id.'.lng', $language_data);
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
							redirect(base_url('manage/settings/language/'.$language_id));
						}else{
							redirect(base_url('manage/settings/language/'));
						}
					}else if ($id == 'create') {
						if (count($this->input->post()) > 0) {
							$language_name = $this->input->post('language_name');
							$language_key = $this->input->post('language_key');
							if (file_exists('./application/language/lng_files/'.$language_key.'.lng')) {
								$this->session->set_flashdata('message', 'Kechirasiz ushbu til paketi mavjud');
							}else{
								$source = './application/language/lng_files_backup/template.lng';
								$dest = './application/language/lng_files/'.$language_key.'.lng';
								if (copy($source, $dest)) {
									$language_data = @file_get_contents($dest);
   									if ($language_data === FALSE) {
      								}
      								$language_data = str_replace('{language_name}', $language_name, $language_data);
      								@file_put_contents($dest, $language_data);
									$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
								}
								
							}
						}
						redirect(base_url('manage/settings/language'));
					}else if ($id == 'backup') {
						$language_id = $this->uri->segment(5);
						if ($language_id != '') {
							if (file_exists('./application/language/lng_files_backup/'.$language_id.'.lng')) {
								$source = './application/language/lng_files_backup/'.$language_id.'.lng';
								$dest = './application/language/lng_files/'.$language_id.'.lng';
								if (copy($source, $dest)) {
									$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
									redirect(base_url('manage/settings/language/'.$language_id));
								}else{
									$this->session->set_flashdata('message', 'Harakatni bajarishda xatolik yuz berdi!');
									redirect(base_url('manage/settings/language/'.$language_id));
								}
							}else{
								$source = './application/language/lng_files_backup/template.lng';
								$dest = './application/language/lng_files/'.$language_id.'.lng';
								if (copy($source, $dest)) {
									$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
									redirect(base_url('manage/settings/language/'.$language_id));
								}else{
									$this->session->set_flashdata('message', 'Ushbu til paketi uchun boshlang\'ich sozlamalar mavjud emas!');
									redirect(base_url('manage/settings/language/'.$language_id));
								}
							}
						}else{
							$this->session->set_flashdata('message', 'Til paketi topilmadi');
							redirect(base_url('manage/settings/language/'));
						}
					}else if ($id == 'backup_swal') {
						$language_id = $this->uri->segment(5);
						if ($language_id != '') {
							if (file_exists('./application/language/lng_files_backup/'.$language_id.'.lng')) {
								$source = './application/language/lng_files_backup/'.$language_id.'.lng';
								$dest = './application/language/lng_files/'.$language_id.'.lng';
								if (copy($source, $dest)) {
									$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
									echo 'refresh';
								}else{
									$this->session->set_flashdata('message', 'Harakatni bajarishda xatolik yuz berdi!');
									echo 'refresh';
								}
							}else{
								$source = './application/language/lng_files_backup/template.lng';
								$dest = './application/language/lng_files/'.$language_id.'.lng';
								if (copy($source, $dest)) {
									$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
									echo 'refresh';
								}else{
									$this->session->set_flashdata('message', 'Ushbu til paketi uchun boshlang\'ich sozlamalar mavjud emas!');
									echo 'refresh';
								}
							}
						}else{
							$this->session->set_flashdata('message', 'Til paketi topilmadi');
							echo 'refresh';
						}
					}else if ($id == 'delete') {
						$language_id = $this->uri->segment(5);
						if ($language_id != '') {
							@unlink('./application/language/lng_files/'.$language_id.'.lng');
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
							echo 'refresh';
						}else{
							$this->session->set_flashdata('message', 'Til paketi topilmadi');
							echo 'refresh';
						}
					}else if($id == ''){
						$language_id = setting_item('default_language');
					}else{
						$language_id = $id;
					}
					if ($id == 'save' || $id == 'backup' || $id == 'backup_swal' || $id == 'delete' || $id == 'create') {
					}else{
						$this->load->view('manage/header');
						$this->load->view('manage/settings/language', array('language_id' => $language_id));
						$this->load->view('manage/footer');
					}
				break;

				case 'templates':
					$this->load->view('manage/header');
					$this->load->view('manage/settings/templates');
					$this->load->view('manage/footer');
				break;

				case 'global':
					$this->load->view('manage/header');
					$this->load->view('manage/settings/global');
					$this->load->view('manage/footer');
				break;

				case 'global_site':
					if (count($this->input->post()) > 0) {
						foreach ($this->input->post() as $key => $value) {
							$this->db->update('settings', array('value' => $value), array('key' => $key));
						}
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						redirect(base_url('manage/settings/global'));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni saqlashda xatolik!');
						redirect(base_url('manage/settings/global'));
					}
				break;

				case 'global_contact':
					if (count($this->input->post()) > 0) {
						foreach ($this->input->post() as $key => $value) {
							if ($key == 'social_links') {
								$value = json_encode($value);
							}
							$this->db->update('settings', array('value' => $value), array('key' => $key));
						}
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						redirect(base_url('manage/settings/global'));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni saqlashda xatolik!');
						redirect(base_url('manage/settings/global'));
					}
				break;

				case 'pages':
					$this->load->view('manage/header');
					$this->load->view('manage/settings/pages');
					$this->load->view('manage/footer');
				break;

				case 'pages_rules':
					if (count($this->input->post()) > 0) {
						$rules = $this->input->post('rules');
						foreach ($rules as $key => $value) {
							$rules[$key] =  array_values(array_filter(explode(PHP_EOL, $rules[$key])));
						}
						$this->db->update('settings', array('value' => json_encode($rules)), array('key' => 'rules'));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik!');
					}
					redirect(base_url('manage/settings/pages?tab=rules'));
				break;

				case 'pages_faq':
					if (count($this->input->post()) > 0) {
						$content = $this->input->post('faq');
						if ($content != '') {
							foreach ($content as $key => $value) {
								$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
							}
							foreach ($content as $key => $value) {
								if (array_key_exists($key, $content)) {
									foreach ($content[$key] as $item_key => $item_value) {
										$content[$key][$item_key] = explode('|', $content[$key][$item_key]);
										$content[$key][$item_key]['question'] = $content[$key][$item_key][0];
										$content[$key][$item_key]['content'] = $content[$key][$item_key][1];
										unset($content[$key][$item_key][0]); unset($content[$key][$item_key][1]);
									}
								}
							}
						}
						$this->db->update('settings', array('value' => json_encode($content)), array('key' => 'faq'));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik!');
					}
					redirect(base_url('manage/settings/pages?tab=faq'));
				break;

				case 'pages_about':
					if (count($this->input->post()) > 0) {
						$content = $this->input->post('about_site_archive');
						if ($content != '') {
							foreach ($content as $key => $value) {
								$content[$key] =  array_values(array_filter(explode(PHP_EOL, $content[$key])));
							}
							foreach ($content as $key => $value) {
							    print_r($content);
								if (array_key_exists($key, $content)) {
									foreach ($content[$key] as $item_key => $item_value) {
									    if($item_value!=''){
									        die(print_r($item_key));
									        $content[$key][$item_key] = explode('|', $content[$key][$item_key]);
										    $content[$key][$item_key]['title'] = $content[$key][$item_key][0];
									    	$content[$key][$item_key]['content'] = $content[$key][$item_key][1];
										    unset($content[$key][$item_key][0]); unset($content[$key][$item_key][1]);
									    }
										
									}
								}
							}
						}
						$_POST['about_site_archive'] = $content;

						foreach ($this->input->post() as $key => $value) {
							$value = json_encode($value);
							//$this->db->update('settings', array('value' => $value), array('key' => $key));
						}
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik!');
					}
					redirect(base_url('manage/settings/pages?tab=about'));
				break;

				case 'pages_how_it_work':
					if (count($this->input->post()) > 0) {
						$this->db->update('settings', array('value' => json_encode($this->input->post('how_it_work'))), array('key' => 'how_it_work'));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik!');
					}
					redirect(base_url('manage/settings/pages?tab=how_it_work'));
				break;

				default:
					redirect(base_url('manage'));
				break;
			}
		}
    }

    public function users($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('users')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'view':
					if ($id == '') {$id=0;}
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$user = $user->row_array();
						$this->load->view('manage/users/view', array('item' => $user));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'profile':
					$id = $this->session->userdata('user_id');
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$user = $user->row_array();
						$this->load->view('manage/users/profile', array('item' => $user));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'edit':
					if ($id == '') {$id=0;}
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$user = $user->row_array();
						$this->load->view('manage/users/edit', array('item' => $user));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'insert':
					if (count($this->input->post()) > 0) {
						$data = array(
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password')),
							'fullname' => $this->input->post('fullname'),
							'role' => 'Manager',
							'permissions' => json_encode($this->input->post('permissions')),
							'status' => $this->input->post('status'),
						);
						$this->db->insert('users', $data);
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');
					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'ldirilmadi');
					}
					redirect(base_url('manage/users/list'));
				break;

				case 'update':
					if ($id == '') {$id=0;}
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$user = $user->row_array();
						if (count($this->input->post()) > 0) {
							$data = array(
								'fullname' => $this->input->post('fullname'),
								'permissions' => json_encode($this->input->post('permissions')),
								'status' => $this->input->post('status'),
							);
							if ($this->input->post('password')) {
								$data['password'] = md5($this->input->post('password'));
							}
							$this->db->update('users', $data, array('user_id' => $id));
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'ldirilmadi');
						}
						redirect(base_url('manage/users/list'));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						redirect(base_url('manage/users/list'));
					}
				break;

				case 'status':
					if ($id == '') {$id=0;}
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$user = $user->row_array();
						if($user['status']==1){
							$this->db->update('users', array('status' => 0), array('user_id' => $id));
						}else{
							$this->db->update('users', array('status' => 1), array('user_id' => $id));
						}
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						echo 'error';
					}
				break;

				case 'delete':
					if ($id == '') {$id=0;}
					$user = $this->db->get_where('users', array('user_id' => $id));
					if ($user->num_rows() > 0) {
						$this->db->delete('users', array('user_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni o\'chirishda xatolik');
						echo 'error';
					}
				break;
				
				default:
					$this->load->view('manage/header');
					$this->load->view('manage/users/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function ads($action='', $id='')
    {
    	if (!$this->Model_manage->check_permissions('ads')) {
    		$this->session->set_flashdata('message', 'Ruxsat etilmagan bo\'lim!');
    		redirect(base_url('manage'));
    		exit;
    	}
    	if ($this->Model_manage->logged() == true){
			switch ($action) {
				case 'view':
					if ($id == '') {$id=0;}
					$post = $this->db->get_where('posts', array('post_id' => $id));
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						$this->load->view('manage/ads/view', array('post' => $post));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'images':
					if ($id == '') {$id=0;}
					$post = $this->db->get_where('posts', array('post_id' => $id));
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						$this->load->view('manage/ads/images', array('item' => $post));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
						echo 'error';
					}
				break;

				case 'position':
					if ($id == '') {$id=0;}
					if (count($this->input->post()) > 0) {
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$data = array(
								'position' => $this->input->post('position'),
								'position_period' => $this->input->post('position_period_date').' '.$this->input->post('position_period_time'),
							);
							$this->db->update('posts', $data, array('post_id' => $id));
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
							redirect(base_url('manage/ads/list'));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
							redirect(base_url('manage/ads/list'));
						}
					}else{
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->load->view('manage/ads/position', array('item' => $post));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							echo 'error';
						}
					}
				break;

				case 'status':
					if ($id == '') {$id=0;}
					if (count($this->input->post()) > 0) {
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->db->update('posts', $this->input->post(), array('post_id' => $id));
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
							redirect(base_url('manage/ads/list'));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
							redirect(base_url('manage/ads/list'));
						}
					}else{
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->load->view('manage/ads/status', array('item' => $post));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							echo 'error';
						}
					}
				break;

				case 'pricing':
					if ($id == '') {$id=0;}
					if (count($this->input->post()) > 0) {
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->db->update('posts', $this->input->post(), array('post_id' => $id));
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
							redirect(base_url('manage/ads/list'));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
							redirect(base_url('manage/ads/list'));
						}
					}else{
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->load->view('manage/ads/pricing', array('item' => $post));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							echo 'error';
						}
					}
				break;

				case 'telegram':
					if ($id == '') {$id=0;}
					if (count($this->input->post()) > 0) {
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							if ($post['status'] == 2) {
								$image = $this->Model_core->getPostImages($post['post_id'], 1);
								if (is_array($image)) {
        							$image = $image[0];
        						}

        						$category = $this->Model_core->categories($post['category_id']);
        						if ($category->num_rows() > 0) {
        							$category = $category->row_array();
            						$category_name = json_decode($category['name'], true);
            						$category = $category_name[setting_item('default_language')];
        						}else{
        							$category = "";
        						}
        
        						$price_options = json_decode($post['price_options'], true);
       							if ($price_options['currency'] == 'sum') {$price_options['currency'] = get_phrase('currency_sum');}else if ($price_options['currency'] == 'usd') {$price_options['currency'] = get_phrase('currency_usd');}
        
        						if ($price_options['covenant'] == '0') {$price_options['covenant'] = "";}else if ($price_options['covenant'] == '1') {$price_options['covenant'] = '('.get_phrase('covenant').')';}

        						$uniqueKey = uniqueKey();

        						$filters = json_decode($post['filter'], true);
        						$data_filters = array();
        						if (is_array($filters)) {
        							foreach ($filters as $key => $value) {
            							$id = str_replace("filter_", "", $key);
                						$filter = $this->db->get_where('filters', array('filter_id' => $id));
                						if ($filter->num_rows() > 0) {
                							$filter = $filter->row_array();
                    						$filter_name = json_decode($filter['filter_name'], true);
                    						$filter_content = json_decode($filter['content'], true);
                    						if (is_array($filter_name)) {
                    							if ($filter['type'] == 'select') {
                        							if (is_array($filter_content)) {
                        								$data_filters[] = array('name' => $filter_name[setting_item('default_language')], 'value' => $value);
                           							}
                        						}
                        						if ($filter['type'] == 'input') {
                        							$data_filters[] = array('name' => $filter_name[setting_item('default_language')], 'value' => $value);
                        						}
                   							}
                						}
									}
        						}

        						$data = array(
									'tags' => create_metatags($post['title'], 3, '#'),
									'title' => $post['title'],
									'price' => number_format($post['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'],
									'onwer_name' => $post['contact_name'],
									'onwer_phone' => $post['phone'],
									'onwer_email' => $post['email'],
									'address' => $post['address'],
									'id' => $post['post_id'].'/'.$uniqueKey,
									'date' => str_to_time($post['created_at']),
									'category' => '<a href="'.base_url().'ads?list=grid&amp;sort=default&amp;limit=12&amp;from=0&amp;category='.$post['category_id'].'">'.$category.'</a>',
									'url' => base_url().$post['post_id'].'/'.$uniqueKey,
									'image' => $image,
									'site_host' => ucwords(base_host()),
									'site_url' => base_url(),
									'filters' => $data_filters
								);

        						if ($this->input->post('pinned')=='1') {
        							$pinned = true;
        						}else{
        							$pinned = false;
        						}

								sendAdToTelegram($this->input->post('channels'), $data, $pinned);

								$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yuborildi');
								redirect(base_url('manage/ads/list'));
							}else{
								$this->session->set_flashdata('message', 'E\'lon holati aktivlashtirilmagan');
								redirect(base_url('manage/ads/list'));	
							}
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumotni yuborishda xatolik');
							redirect(base_url('manage/ads/list'));
						}
					}else{
						$post = $this->db->get_where('posts', array('post_id' => $id));
						if ($post->num_rows() > 0) {
							$post = $post->row_array();
							$this->load->view('manage/ads/telegram', array('item' => $post));
						}else{
							$this->session->set_flashdata('message', 'Ma\'lumot topilmadi');
							echo 'error';
						}
					}
				break;

				case 'insert':
					if (count($this->input->post()) > 0) {
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
							'title' => $this->input->post('title'),
							'content' => $this->input->post('content'),
							'price' => $this->input->post('price'),
							'price_options' => json_encode(array('currency' => $this->input->post('currency'), 'covenant' => $this->input->post('covenant'))),
							'contact_name' => $this->input->post('onwer_name'),
							'email' => $this->input->post('onwer_email'),
							'phone' => $this->input->post('onwer_phone'),
							'address' => $this->input->post('onwer_address'),
							'pricing_id' => $this->input->post('pricing_id'),
							'position' => $this->input->post('position'),
							'position_period' => $this->input->post('position_period_date').' '.$this->input->post('position_period_time'),
							'filter' => $filters,
							'created_at' => date('Y-m-d H:i:s'),
          					'updated_at' => date('Y-m-d H:i:s'),
          					'deleted_at' => date('Y-m-d H:i:s'),
							'status' => $this->input->post('status'),
							'visits' => 0,
							'template' => 'default',
							'category_id' => $this->input->post('category'),
							'user_id' => 1,
						);

						$this->db->insert('posts', $data);
        				$insert_id = $this->db->insert_id();

        				if (count($_FILES['images']['name']) > 0) {
          					$this->load->library( 'image_lib' );
          					foreach ($_FILES['images']['name'] as $key => $value) {
            					$filename = $value;
            					$file_basename = substr($filename, 0, strripos($filename, '.'));
            					$file_ext = substr($filename, strripos($filename, '.'));
           						$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            					$target_dir = './uploads/ads/';
            					if (move_uploaded_file($_FILES['images']["tmp_name"][$key], $target_dir.$newfilename)) {
              						$image_data = array(
                						'post_id' => $insert_id,
                						'name' => $value,
                						'size' => $_FILES['images']["size"][$key],
                						'filename' => $newfilename,
                						'status' => 1
              						);
              						$this->db->insert('post_images', $image_data);
             						image_handler($target_dir.$newfilename,$target_dir.$newfilename,800,600,90,'./public/images/watermark.png');
            					}
          					}
        				}

						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli kiritildi');

					}else{
						$this->session->set_flashdata('message', 'Kerakli maydonlar to\'ldirilmadi');
					}
					redirect(base_url('manage/ads/list'));
				break;

				case 'update':
					if ($id == '') {$id=0;}
					$post = $this->db->get_where('posts', array('post_id' => $id));
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						if (count($this->input->post()) > 0) {
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
								'title' => $this->input->post('title'),
								'content' => $this->input->post('content'),
								'price' => $this->input->post('price'),
								'price_options' => json_encode(array('currency' => $this->input->post('currency'), 'covenant' => $this->input->post('covenant'))),
								'contact_name' => $this->input->post('onwer_name'),
								'email' => $this->input->post('onwer_email'),
								'phone' => $this->input->post('onwer_phone'),
								'address' => $this->input->post('onwer_address'),
								'pricing_id' => $this->input->post('pricing_id'),
								'position' => $this->input->post('position'),
								'position_period' => $this->input->post('position_period_date').' '.$this->input->post('position_period_time'),
								'filter' => $filters,
								'updated_at' => date('Y-m-d H:i:s'),
          						'status' => $this->input->post('status'),
								'category_id' => $this->input->post('category'),
							);

							$this->db->update('posts', $data, array('post_id' => $id));

        					if (count($_FILES['images']['name']) > 0) {
          						$this->load->library( 'image_lib' );
          						foreach ($_FILES['images']['name'] as $key => $value) {
            						$filename = $value;
            						$file_basename = substr($filename, 0, strripos($filename, '.'));
            						$file_ext = substr($filename, strripos($filename, '.'));
           							$newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            						$target_dir = './uploads/ads/';
            						if (move_uploaded_file($_FILES['images']["tmp_name"][$key], $target_dir.$newfilename)) {
              							$image_data = array(
                							'post_id' => $id,
                							'name' => $value,
                							'size' => $_FILES['images']["size"][$key],
                							'filename' => $newfilename,
                							'status' => 1
              							);
              							$this->db->insert('post_images', $image_data);
             							image_handler($target_dir.$newfilename,$target_dir.$newfilename,800,600,90,'./public/images/watermark.png');
            						}
          						}
        					}
        					
							$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli yangilandi');
						}else{
							$this->session->set_flashdata('message', 'Kerakli maydonlar to\'ldirilmadi');
						}
						redirect(base_url('manage/ads/list'));
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						redirect(base_url('manage/ads/list'));
					}
				break;

				
				case 'delete':
					if ($id == '') {$id=0;}
					$post = $this->db->get_where('posts', array('post_id' => $id));
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						$images = $this->db->get_where('post_images', array('post_id' => $id));
						if ($images->num_rows() > 0) {
							foreach ($images->result_array() as $image) {
								if (file_exists('./uploads/ads/'.$image['filename'])) {
									@unlink('./uploads/ads/'.$image['filename']);
								}
								$this->db->delete('post_images', array('image_id' => $image['image_id']));
							}
						}
						$this->db->delete('posts', array('post_id' => $id));
						$this->session->set_flashdata('message', 'Ma\'lumot muvaffaqiyatli o\'chirildi');
						echo 'refresh';
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni o\'chirishda xatolik');
						echo 'error';
					}
				break;

				case 'delete_image':
					if ($this->input->get('image') != '') {
						$image = $this->db->get_where('post_images', array('filename' => $this->input->get('image')));
						if ($image->num_rows() > 0) {
							$image = $image->row_array();
							if (file_exists('./uploads/ads/'.$image['filename'])) {
								@unlink('./uploads/ads/'.$image['filename']);
							}
							$this->db->delete('post_images', array('image_id' => $image['image_id']));
							echo "success";
						}else{
							echo "error";
						}
					}else{
						echo "error";
					}
				break;

				case 'add':
					$this->load->view('manage/header');
					$this->load->view('manage/ads/add');
					$this->load->view('manage/footer');
				break;

				case 'edit':
					if ($id == '') {$id=0;}
					$post = $this->db->get_where('posts', array('post_id' => $id));
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						$this->load->view('manage/header');
						$this->load->view('manage/ads/edit', array('item' => $post));
						$this->load->view('manage/footer');
					}else{
						$this->session->set_flashdata('message', 'Ma\'lumotni yangilashda xatolik');
						redirect(base_url('manage/ads/list'));
					}
				break;

				case 'filters':
					if ($id == '') {$id=0;}
					$category = $this->db->get_where('categories', array('category_id' => $id));
					if ($category->num_rows() > 0) {
						$category = $category->row_array();
						$data = array();
						if ($this->input->get('post') != '') {
							$post = $this->db->get_where('posts', array('post_id' => $this->input->get('post')));
							if ($post->num_rows() > 0) {
								$post = $post->row_array();
								$filter = json_decode($post['filter'], true);
								if (is_array($filter)) {
									foreach ($filter as $key => $value) {
										$key = str_replace('filter_', '', $key);
										$data['filter'][$key] = $value;
									}
								}
							}
						}
						$this->load->view('manage/ads/filters', array('category_id' => $id, 'data' => $data));
					}
				break;

				default:
					$this->load->view('manage/header');
					$this->load->view('manage/ads/list');
					$this->load->view('manage/footer');
				break;
			}
		}
    }

    public function logout()
    {
    	if ($this->Model_manage->logged() == true){
    		$user = $this->Model_manage->user($this->session->userdata('user_id'));
    		if ($user->num_rows() > 0) {
    			$user = $user->first_row('array');
    			foreach ($user as $key => $value) {
    				$this->session->unset_userdata($key);
    			}
    			$this->session->set_userdata('logged', 0);
    			redirect($this->agent->referrer());
    		}else{
    			redirect($this->agent->referrer());
    		}
    	}
    	
    }
}
