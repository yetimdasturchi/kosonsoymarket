<?php

if ( ! function_exists('setting_item'))
{
	function setting_item($key='', $replacement='', $value='')
	{
		$CI	=&	get_instance();
		
		$item	=	$CI->db->get_where('settings', array('key' => $key));

		if ($item->num_rows() > 0) {
			$item = $item->row()->value;
			if (isset($replacement) && isset($value)) {
				$item = str_replace($replacement, $value, $item);
			}
		}else{
			$item = "";
		}

		return $item;
	}
}
function str_to_time($time='')
{
	if ($time != '') {
		return dateformat(strtotime($time));
	}else{
		return dateformat(time());
	}
}
function dateformat($time=''){
	if ($time == '') {
		$time = time();
	}
	
	$new_date = getdate($time);

    $my_months= array(
            'January'   => 'Yan',
            'February'  => 'Fev',
            'March'     => 'Mar',
            'April'     => 'Apr',
            'May'       => 'May',
            'June'      => 'Iyun',
            'July'      => 'Iyul',
            'August'    => 'Avg',
            'September' => 'Sen',
            'October'   => 'Okt',
            'November'  => 'Noy',
            'December'  => 'Dek',
    );

	$new_date['month']= $my_months[$new_date['month']];


    return $new_date['mday']. ' ' .$new_date['month']. ' '. $new_date['year'].' | '.$new_date['hours'].':'.$new_date['minutes'];

}

function shorttext($text='', $limit='180')
{
	$shorttext = preg_replace('/^([\s\S]{1,'.$limit.'})[\s]+?[\s\S]+/', '$1', strip_tags($text));

	return $shorttext;
}

function my_substr($str, $start, $length, $charset='utf-8' ) {

	if ( strtolower($charset) == "utf-8") {
		if( function_exists( 'mb_substr' ) ) {
			return mb_substr( $str, $start, $length, "utf-8" );
	
		} elseif( function_exists( 'iconv_substr' ) ) {
			return iconv_substr($str, $start, $length, "utf-8");
		}
	}

	return substr($str, $start, $length);

}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function filter_options($data='', $key='', $attr=false)
{
	if ($data != '' && $key != '') {
		$array = array();
		$set = preg_split("/(\r\n|\n|\r)/", $data);
		foreach ($set as $row) {
			$row = explode('|', $row);
			$array[$row[0]] = $row[1];
		}
		if (array_key_exists($key, $array)) {
			if ($attr == true) {
				return $key.'="'.$array[$key].'"';
			}else{
				return $array[$key];
			}
		}else{
			return "";
		}
	}else{
		return "";
	}
}

function uniqueKey($limit = 4) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randstring = '';

    for ($i = 0; $i < $limit; $i++) {

        $randstring .= $characters[rand(0, strlen($characters)-1)];
    }

    return $randstring;
}

function image_handler($source_image,$destination,$tn_w = 750,$tn_h = 420,$quality = 80,$wmsource = false) {

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

  if(Imagejpeg($final,$destination,$quality)) {
  return true;
  }

  return false;

}

function search_revisions($dataArray, $search_value, $key_to_search, $other_matching_value = null, $other_matching_key = null) {
    $keys = array();
    foreach ($dataArray as $key => $cur_value) {
        if ($cur_value[$key_to_search] == $search_value) {
            if (isset($other_matching_key) && isset($other_matching_value)) {
                if ($cur_value[$other_matching_key] == $other_matching_value) {
                    $keys[] = $key;
                }
            } else {
                $keys[] = $key;
            }
        }
    }
    return $keys;
}

function gettelegramUsers($action='')
{
  $count = 0;
  $CI =&  get_instance();
  $count_allusers = $CI->session->userdata('count_allusers');
  if ($count_allusers == '') {
    $data = setting_item('bot_settings');
    if ($data != '') {
      $data = json_decode($data, true);
      if (is_array($data)) {
        foreach ($data['channels'] as $row) {
          $json = json_decode(getTelegramjson('getChatMembersCount', array('chat_id' => $row['username'])), true);
          if ($json['ok'] == true) {
            $count = $count+$json['result'];
          }
        }
        $CI->session->set_userdata('count_allusers' , $count);
      }
    }
  }else{
    $count = $count_allusers;
  }
  
  if ($action == 'daily') {
    if ($count > 0) {
      $count_dailyusers = $CI->session->userdata('count_dailyusers');
      if ($count_dailyusers == '') {
        $daily = (rand(40, 70) / 100) * $count;
        $daily = number_format($daily, 0, '', '');
        $CI->session->set_userdata('count_dailyusers' , $daily);
        return $daily;
      }else{
        return $count_dailyusers;
      }
      
    }
  }

  return $count;
}

function sendAdToTelegram($channels='', $data='', $pin=false){
  $template = @file_get_contents('./public/data/telegram_template.txt');
  if ($template === FALSE) {
  }else{
    if (is_array($data)) {
      /*
      foreach ($data as $key => $value) {
        if($key=='filters'){
          preg_match( "#\{filters=(.+?)\}#i", $template, $matches);
          $filters = '';
          if (count($data['filters']) > 0) {
            foreach ($data['filters'] as $filter) {
              $filters .= trim($matches[1]).' '.$filter['name'].': '.$filter['value'].PHP_EOL;
            }
            $template = str_replace($matches[0], $filters, $template);
          }
        }else{
          $template = str_replace('{'.$key.'}', $value, $template);
        }
      }
      */

      if (is_array($channels)) {
        foreach ($channels as $channel) {
          $template = @file_get_contents('./public/data/telegram_template.txt');
          foreach ($data as $key => $value) {
            if($key=='filters'){
              preg_match( "#\{filters=(.+?)\}#i", $template, $matches);
              $filters = '';
              foreach ($data['filters'] as $filter) {
                  $filters .= trim($matches[1]).' '.$filter['name'].': '.$filter['value'].PHP_EOL;
                }
                $template = str_replace($matches[0], $filters, $template);
            }else{
              $template = str_replace('{'.$key.'}', $value, $template);
            }
          }
          $bot_settings = json_decode(setting_item('bot_settings'), true);
          $channel_name = search_revisions($bot_settings['channels'], $channel, 'username');
          $channel_name = $bot_settings['channels'][$channel_name[0]]['name'];
          $template = str_replace('{channel_username}', $channel, $template);
          $template = str_replace('{channel_name}', $channel_name, $template);
          $message =  sendTelegramMessage($channel, $template, $data['image'], $data['url']);
          
          $message = json_decode($message);
          if ($message->ok == true) {
            if ($pin==true) {
              $content = array(
                "chat_id" => $channel,
                "message_id" => $message->result->message_id
              );
              getTelegramjson('pinChatMessage', $content);
            }
          }
        }
      }

    }
  }
}

function sendTelegramMessage($channel, $title, $image, $url)
{
  $inlinekeys[] = array(
    array(
      "text" => '🛒 Batafsil koʻrish',
      "url" => $url
    )
  );
  $inlinekeyboard = array("inline_keyboard" => $inlinekeys);
  $content = array(
    "chat_id" => $channel,
    "caption" => $title,
    "photo" => $image,
    "reply_markup" => $inlinekeyboard,
    "parse_mode" => 'html'
  );
  
  return getTelegramjson('sendPhoto', $content);
}

function getTelegramjson($action, $content)
{
  $url = 'https://api.telegram.org/bot' . getTelegramToken() . '/' . $action;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

function getTelegramToken($action = '')
{
  $data = setting_item('bot_settings');
  if ($data != '') {
    $data = json_decode($data, true);
    if (is_array($data)) {
      if ($action == 'username') {
        return $data['bot']['username'];
      }else{
        return $data['bot']['token'];
      }
    }else{
      return false;
    }
  }else{
    return false;
  }
}

function create_metatags($story, $keyword_count=3, $sperator='') {
  
  $newarr = array ();
  $headers = array ();
  $quotes = array ("\x22", "\x60", "\t", '\n', '\r', "\n", "\r", "\\", ",", ".", "/", "¬", "#", ";", ":", "@", "~", "[", "]", "{", "}", "=", "-", "+", ")", "(", "*", "^", "%", "$", "<", ">", "?", "!", '"');
  $fastquotes = array ("\x22", "\x60", "\t", "\n", "\r", '"', '\r', '\n', "$", "{", "}", "[", "]", "<", ">", "\\");

  $story = str_replace( "&nbsp;", " ", $story );
  
  $story = str_replace( '<br />', ' ', $story );
  $story = str_replace( '<br>', ' ', $story );
  $story = strip_tags( $story );
  $story = preg_replace( "#&(.+?);#", "", $story );
  $story = trim(str_replace( " ,", "", $story ));
 
  
  
  $story = str_replace( $quotes, ' ', $story );
    
  $arr = explode( " ", $story );
    
  foreach ( $arr as $word ) {
    if( my_strlen( $word ) > 4 ) $newarr[] = $sperator.$word;
  }
    
  $arr = array_count_values( $newarr );
  arsort( $arr );
    
  $arr = array_keys( $arr );
   
  $total = count( $arr );
  
  $offset = 0;
    
  $arr = array_slice( $arr, $offset, $keyword_count );
   
  if ($sperator=='#') {
    $headers = implode( " ", $arr );
  }else{
    $headers = implode( ", ", $arr );
  }
  
  return $headers;
}

function my_strlen($value, $charset="utf-8" ) {

  if ( strtolower($charset) == "utf-8") {
    if( function_exists( 'mb_strlen' ) ) {
      return mb_strlen( $value, "utf-8" );
  
    } elseif( function_exists( 'iconv_strlen' ) ) {
      return iconv_strlen($value, "utf-8");
    }else{
      return strlen($value);
    }
  }else{
    return strlen($value);
  }

}
function hexToRgb($hex, $alpha = false) {
   $hex      = str_replace('#', '', $hex);
   $length   = strlen($hex);
   $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
   $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
   $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
   if ( $alpha ) {
      $rgb['a'] = $alpha;
   }
   return $rgb;
}

function random_color($action='')
{
  $colors = array('03a9f3','00c292','fb9678','ffb463','ab8ce4','3a3f51');
  if ($action == 'list') {
    return $colors;
  }else if ($action == 'random') {
    shuffle($colors);
    return $colors;
  }else if ($action == 'randomrgb') {
    shuffle($colors);
    $newcolors = array();
    foreach ($colors as $value) {
      $hexToRgb = hexToRgb($value);
      $newcolors[] =  'rgba('.$hexToRgb['r'].', '.$hexToRgb['g'].', '.$hexToRgb['b'].', 0.5)';
    }
    return $newcolors;
  }else{
    return $colors[array_rand($colors)];
  }
}

function toUniversalString($str, $options = array()) {
  $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
  $defaults = array(
    'delimiter'   => ' ',
    'limit'     => null,
    'lowercase'   => true,
    'replacements'  => array(),
    'transliterate' => true,
  );
  
  $options = array_merge($defaults, $options);
  $char_map = array
    (
    // Latin
    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
    'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
    'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
    'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
    'ß' => 'ss',
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
    'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
    'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
    'ÿ' => 'y',
    // Latin symbols
    '©' => '(c)',
    // Greek
    'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
    'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
    'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
    'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
    'Ϋ' => 'Y',
    'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
    'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
    'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
    'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
    'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
    // Turkish
    'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
    'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
    // Russian
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'Ye', 'Ё' => 'Yo', 'Ж' => 'J',
    'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
    'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'X', 'Ц' => 'Ts',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '\'', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
    'Я' => 'Ya',
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'j',
    'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
    'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'x', 'ц' => 'ts',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '\'', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
    'я' => 'ya',
    // Ukrainian
    'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
    'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
    // Czech
    'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
    'Ž' => 'Z',
    'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
    'ž' => 'z',
    // Polish
    'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
    'Ż' => 'Z',
    'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
    'ż' => 'z',
    // Latvian
    'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
    'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
    'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
    'š' => 's', 'ū' => 'u', 'ž' => 'z',
    // Uzbek
    "Ў"=>"O'", "ў"=>"o'", "Ғ"=>"G'", "ғ"=>"g'", "Ҳ"=>"H", "ҳ"=>"h", "Қ"=>"Q", "қ"=>"q",
    //Symbols
    "\"" => "'", "–" => "-", "‘" => "'", "“" => "\"", "”" => "\"", "’" => "'", "´" => "'",
  );
  
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
  
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }
  
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
  
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
  
  $str = trim($str, $options['delimiter']);
  return $str;
}

function slugify($text) {
  
  $text = toUniversalString($text);
  
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  $text = preg_replace('~[^-\w]+~', '', $text);

  $text = trim($text, '-');

  $text = preg_replace('~-+~', '-', $text);

  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
function scanDirectories($rootDir, $allData=array()) {
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd", "errors", "index.html", "lng_files_backup_core", "english");
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            if(is_file($path) && is_readable($path)) {
                $allData[] = $path;
            }elseif(is_dir($path) && is_readable($path)) {
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

function removeDocCom($fileStr='')
{
  $newStr  = '';

  $commentTokens = array(T_COMMENT);

  if (defined('T_DOC_COMMENT'))
      $commentTokens[] = T_DOC_COMMENT; 
  if (defined('T_ML_COMMENT'))
    $commentTokens[] = T_ML_COMMENT;  
  if (defined('T_COMMENT'))
    $commentTokens[] = T_COMMENT;  

  $tokens = token_get_all($fileStr);

  foreach ($tokens as $token) {    
    if (is_array($token)) {
        if (in_array($token[0], $commentTokens))
            continue;

        $token = $token[1];
    }

    $newStr .= $token;
  }
$newStr = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $newStr);


$newStr = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $newStr);
$newStr = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $newStr);
$newStr = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $newStr);
$newStr = preg_replace('/<!--(.|\s)*?-->/', '', $newStr);

//die($newStr);
  return $newStr;
}
?>