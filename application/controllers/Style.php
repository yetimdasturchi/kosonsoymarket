<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Style extends CI_Controller {

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

	public function css()
	{
		header("Content-type: text/css; charset: UTF-8");
		$css = $this->config->item('style_css');
		$this->load->view('css', array('style' => $css));
	}

	public function js()
	{
		# code...
	}

	public function language_js()
	{
		header("Content-type: application/javascript; charset: UTF-8");
    	$language = json_encode(language_parser('_allitems'));
    	echo 'var base_url = "'.base_url().'"'.PHP_EOL;
    	echo 'var base_host = "'.ucwords(base_host()).'"'.PHP_EOL;
    	echo "var language_parser = ".$language.PHP_EOL;
    	echo "
    		function get_phrase(keyword='')
			{
				//var language_parser = JSON.parse(language_parser);
		
				if(language_parser != 'undefined' || language_parser != 'null'){
					return language_parser[keyword];
				}else{
					keyword.replace('_', ' ');
					return keyword;
				}
			}

    	";
	}
}
