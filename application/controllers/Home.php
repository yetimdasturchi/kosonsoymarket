<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$header = array(
			'title' => setting_item('site_title'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));

		$this->load->view('header', array('header' => $header, 'transparent_header' => 'transparent-header'));
		$this->load->view('home', array('categories' => $categories));
		$this->load->view('footer');
	}

	public function language($value='')
	{
		if ($value != '') {
			$languages = $this->config->item('languages_list');
			if (array_key_exists($value, $languages)) {
				getDefaultLang($value);
				redirect($this->agent->referrer());
			}else{
				redirect($this->agent->referrer());
			}
		}else{
			redirect($this->agent->referrer());
		}
	}

	public function ads($value='')
	{
		$header = array(
			'title' => setting_item('site_title'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$this->load->view('header', array('header' => $header));
		$this->load->view('ads/list');
		$this->load->view('footer');
	}

	public function ads_view($id='')
	{
		if ($id != '') {
			if ($this->Model_manage->logged() == true){
				$ad = $this->db->get_where('posts', array('post_id' => $id)); 
			}else{
				$this->db->where('post_id', $id);
				$this->db->where_in('status', array('2', '3'));
				$ad = $this->db->get('posts'); 
			}
			if ($ad->num_rows() > 0) {
				$ad = $ad->row_array();
				$this->Model_core->updateViews($id);
				$image = $this->db->get_where('post_images', array('post_id' => $id)); 
				if ($image->num_rows() > 0) {
					$image = $image->row_array();
					if (file_exists('./uploads/ads/'.$image['filename'])) {
						$og_image = base_url().'uploads/ads/'.$image['filename'];
					}else{
						$og_image = setting_item('style_path').'images/og_image.png';
					}
				}else{
					$og_image = setting_item('style_path').'images/og_image.png';
				}
				$header = array(
					'title' => $ad['title'],
					'description' => shorttext($ad['content']),
					'keywords' => setting_item('site_keywords'),
					'og_image' => $og_image,
				);
				$this->load->view('header', array('header' => $header));
				$this->load->view('ads/view', array('ad' => $ad));
				$this->load->view('footer');
			}else{
				show_404();
			}
		}else{
			show_404();
		}
		
	}

	public function ads_view_short($id='', $hash='')
	{
		if ($id != '' && $hash != '') {
			redirect(base_url("ads/view/{$id}/{$hash}"));
		}else{
			show_404();
		}
	}

	public function post_ad()
	{
		$header = array(
			'title' => ucwords(base_host()).' - '.get_phrase('post_ad'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$this->load->view('header', array('header' => $header));
		$this->load->view('ads/post_ad');
		$this->load->view('footer');
	}

	public function error()
	{
		$this->load->view('error');
	}
}
