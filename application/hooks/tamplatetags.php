<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function render()
{
    $path_parts = pathinfo(base_host());
    $custom_item = array(
      '02bd92faa38aaa6cc0ea75e59937a1ef' => '<meta name="author" content="Manuchehr Usmonov">',
      '6a72bde84cd442d3922006b5df965100' => '<div class="copyright text-center">© Copyright '.date('Y').' Manuchehr Usmonov. <a href="http://devcon.uz" target="_blank">DEVCON P/E</a> tomonidan ishlab chiqilgan.</div>',
      '7937d481747ecb09106cac82c1388c5a' => '<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © '.date('Y').' Manuchehr Usmonov.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="http://devcon.uz" target="_blank">DEVCON P/E</a> tomonidan ishlab chiqilgan.</span>',
      'base_url' => base_url(),
      'base_host' => base_host(),
      'current_url' => current_url() ,
      'sitename' => $path_parts['filename']
    );
    $CI =& get_instance();
    $uri_string = $CI->uri->uri_string();
    $buffer = $CI->output->get_output();
    preg_match_all( "#\{language=(.+?)\}#i", $buffer, $matches );

    foreach ($matches[1] as $key => $value) {
      $tag = $matches[0][$key];
      $value = trim($matches[1][$key]);
      $buffer = str_replace($tag, get_phrase($value), $buffer);
    }

    preg_match_all( "#\{setting=(.+?)\}#i", $buffer, $matches );

    foreach ($matches[1] as $key => $value) {
      $tag = $matches[0][$key];
      $value = trim($matches[1][$key]);
      $setting_item = setting_item($value);

      preg_match_all( "#\{setting=(.+?)\}#i", $setting_item, $setting_item_matches );
      
      foreach ($setting_item_matches[1] as $setting_item_key => $setting_item_value) {
        $setting_item_tag = $setting_item_matches[0][$setting_item_key];
        $setting_item_value = trim($setting_item_matches[1][$setting_item_key]);
        $setting_item = str_replace($setting_item_tag, setting_item($setting_item_value), $setting_item);
      }

      $buffer = str_replace($tag, $setting_item, $buffer);
    }

    foreach ($custom_item as $key => $value) {
      $buffer = str_replace('{'.$key.'}', $value, $buffer);
    }

    $search = array(
    '/\n/',      // replace end of line by a space
    '/\>[^\S ]+/s',    // strip whitespaces after tags, except space
    '/[^\S ]+\</s',    // strip whitespaces before tags, except space
     '/(\s)+/s'    // shorten multiple whitespace sequences
    );
 
   $replace = array(
    ' ',
    '>',
     '<',
     '\\1'
    );
   // $fetch_class = $CI->router->fetch_class().'/'.
    //if ($CI ->router->directory != 'admin/') {
    if ($CI->uri->segment(1) != 'post-ad' && $CI->uri->segment(1) != 'manage') {
      $buffer = preg_replace($search, $replace, $buffer);
    }
    

    $CI->output->set_output($buffer);
    $CI->output->_display();
}

