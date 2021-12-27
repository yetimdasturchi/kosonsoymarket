<?php
	foreach ($style as $row) {
		$row = str_replace("{setting=style_path}", setting_item('style_path'), $row);
		$file = file_get_contents($row);
		$file = str_replace('../fonts/', setting_item('style_path').'fonts/', $file);
		$file = str_replace('../images/', setting_item('style_path').'images/', $file);
		$file = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$file)))));
		echo $file;
	}
?>