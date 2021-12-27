<?
  $languages = $this->config->item('languages_list');
  $filter_name = json_decode($item['filter_name'], true);
  $content = json_decode($item['content'], true);
  $category = $this->Model_core->categories($item['category_id']);
  if ($category->num_rows() > 0) {
    $category = $category->row_array();
    $category = json_decode($category['name'], true);
    $category = $category[setting_item('default_language')];
  }else{
    $category = "Aniqlanmagan";
  }

  	if ($item['options'] != '') {
  		$options = array();
		$set = preg_split("/(\r\n|\n|\r)/", $item['options']);
		foreach ($set as $set_row) {
			$set_row = explode('|', $set_row);
			$options[$set_row[0]] = $set_row[1];
		}
  	}else{
  		$options = array();
  	}
?>
<div>
	<ul class="list-arrow">
		<li><b>Asosiy rukn:</b> <em><?=$category;?></em></li>
		<li><b>Tartib:</b> <em><?=$item['sort'];?></em></li>
		<li><b>Turi:</b> <em><?if ($item['type']=='select') {echo'Tanlovchi';}else{echo'Kirituvchi';}?></em></li>
		<li><b>Xususiyat:</b> <em><?if ($item['action']=='min') {echo'Minimal';}else if ($item['action']=='max') {echo'Maksimal';}else{echo'Teng';}?></em></li>
	</ul>
	<?
		if ($item['options'] != '') {
	?>
			<h5 class="text-center">Sozlamalar:</h5>
			<ul class="list-arrow">
			<?
				foreach ($options as $key => $value) {
    				if ($key == 'type') {
      					$types = array('text' => 'Matn','number' => 'Raqam','date' => 'Sana','time' => 'Vaqt','datetime' => 'Sana va vaqt','month' => 'Oylar','week' => 'Hafta','tel' => 'Telefon raqam','url' => 'Veb manzil','email' => 'Email'); 
      					if (array_key_exists($value, $types)) {
      						echo '<li><b>Turi:</b> <em>'.$types[$value].'</em></li>';
      					}
    				}
    				if ($key == 'value') {
      					echo '<li><b>Standart yozuv:</b> <em>'.$value.'</em></li>';
    				}
    				if ($key == 'minlength') {
      					echo '<li><b>Minimal uzunlik:</b> <em>'.$value.'</em></li>';
    				}
    				if ($key == 'maxlength') {
      					echo '<li><b>Maksimal uzunlik son:</b> <em>'.$value.'</em></li>';
    				}
    				if ($key == 'required') {
      					echo '<li><b>Majburiy:</b> <em>Ha</em></li>';
    				}
    				if ($key == 'readonly') {
      					echo '<li><b>Faqat o\'qish uchun:</b> <em>Ha</em></li>';
    				}
    				if ($key == 'min') {
      					echo '<li><b>Minimal son:</b> <em>'.$value.'</em></li>';
    				}
    				if ($key == 'max') {
      					echo '<li><b>Maksimal son:</b> <em>'.$value.'</em></li>';
    				}
  				}
			?>
		</ul>
	<?
		}
	?>
	<h5 class="text-center">Nomi:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $filter_name)) {
      				echo '<li><b>'.$value.':</b> <em>'.$filter_name[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
	<?
		if (is_array($content)) {
	?>
			<h5 class="text-center">Tarkib:</h5>
			<ul class="list-arrow">
			<?
				foreach ($languages as $key => $value) {
    				if (array_key_exists($key, $content)) {
    					echo '<h6><em>'.$value.':</h6></em>';
    					foreach ($content[$key] as $row) {
    						echo '<li><b>'.$row['label'].':</b> <em>'.$row['value'].';</em></li>';
    					}
    				}
  				}
			?>
		</ul>
	<?
		}
	?>
</div>