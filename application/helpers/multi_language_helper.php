<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('getDefaultLang'))
{
	function getDefaultLang($language = '') {
		$CI	=&	get_instance();
		
		if ($language != '') {

			$CI->session->set_userdata('current_language' , $language);

		}else{
			$current_language = $CI->session->userdata('current_language');

			if ($current_language == '') {
				$current_language	=	setting_item('default_language');
				
				$CI->session->set_userdata('current_language' , $current_language);
				$language = $current_language;
			}else{
				
				$language = $current_language;
			}
		}

		return $language;
	}
}

if ( ! function_exists('get_languge_name'))
{
	function get_languge_name($language = '') {
		$CI	=&	get_instance();
		
		$languages = $CI->config->item('languages_list');
		
		if (array_key_exists($language, $languages)) {
			return $languages[$language];
		}else{
			return '';
		}
	}
}

if ( ! function_exists('language_parser'))
{
	function language_parser($key='')
	{
		$lng_file = APPPATH .'/language/lng_files/' . strtolower(getDefaultLang()) . '.lng';
		if (file_exists($lng_file)) {
		
			$lng = parse_ini_file($lng_file) or die('Xatolik: Til paketi topilmadi');
		
		} else {
		
			die('Xatolik: Til paketi topilmadi');
		
		}
		
		if (array_key_exists($key, $lng)) {
			return $lng[$key];
		}else if($key == '_allitems'){
			return $lng;
		}else{
			return ucwords(str_replace('_',' ',$key));
		}
	}
}
if ( ! function_exists('get_phrase'))
{
	function get_phrase($keyword='', $replacement='', $value='')
	{
		$result = language_parser($keyword);
		
		if (isset($replacement) && isset($value)) {
		
			$result = str_replace($replacement, $value, $result);
		
		}
		
		return $result;
	}
}