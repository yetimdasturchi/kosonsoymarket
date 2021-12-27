<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		$this->load->view('header', array('header' => $header));
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function contact($action = '')
	{
		
		$header = array(
			'title' => ucwords(base_host()) .' - '.get_phrase('contact'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$this->load->view('header', array('header' => $header));
		$this->load->view('pages/contact');
		$this->load->view('footer');
	}

	public function faq($action = '')
	{
		
		$header = array(
			'title' => ucwords(base_host()) .' - '.get_phrase('faq'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$this->load->view('header', array('header' => $header));
		$this->load->view('pages/faq');
		$this->load->view('footer');
	}

	public function about()
	{
		
		$header = array(
			'title' => ucwords(base_host()) .' - '.get_phrase('about'),
			'description' => setting_item('site_description'),
			'keywords' => setting_item('site_keywords'),
			'og_image' => setting_item('style_path').'images/og_image.png',
		);
		$this->load->view('header', array('header' => $header));
		$this->load->view('pages/about');
		$this->load->view('footer');
	}

	public function news($action='', $id='')
	{
		switch ($action) {
			case 'category':
				$category = $this->Model_core->news_categories($id);
   				if ($category->num_rows() > 0) {
   					$category = $category->first_row('array');
					$header = array(
						'title' => ucwords(base_host()) .' - '.get_phrase('news').' -> '.$category['category_name'],
						'description' => setting_item('site_description'),
						'keywords' => setting_item('site_keywords'),
						'og_image' => setting_item('style_path').'images/og_image.png',
					);
					$this->load->view('header', array('header' => $header));
					$this->load->view('news/list', array('category' => $category));
					$this->load->view('footer');
				}else{
					show_404();
				}
			break;

			case 'view':
				$news = $this->Model_core->news($id);
				if ($news->num_rows() > 0) {
					$news = $news->first_row('array');
					$category = $this->Model_core->news_categories($news['category_id'])->first_row('array');
					$header = array(
						'title' => $news['title'],
						'description' => $news['meta_description'],
						'keywords' => $news['meta_keyword'],
						'og_image' => $news['photo'],
					);
					$this->load->view('header', array('header' => $header));
					$this->load->view('news/view', array('category' => $category, 'news' => $news));
					$this->load->view('footer');
				}else{
					show_404();
				}
			break;
			
			default:
				$header = array(
					'title' => ucwords(base_host()) .' - '.get_phrase('news'),
					'description' => setting_item('site_description'),
					'keywords' => setting_item('site_keywords'),
					'og_image' => setting_item('style_path').'images/og_image.png',
				);
				$this->load->view('header', array('header' => $header));
				$this->load->view('news/list');
				$this->load->view('footer');
			break;
		}
		
	}

	public function sc()
	{
		
		if ($_POST) {
			$this->session->set_flashdata('message_success', 'ok');
		}
		redirect(base_url('post-ad'));
	}

}
