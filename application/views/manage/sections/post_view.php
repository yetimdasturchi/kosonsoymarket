<?
  $name = json_decode($item['name'], true);
  $title = json_decode($item['title'], true);
  $keywords = json_decode($item['keywords'], true);
  $description = json_decode($item['description'], true);
  $parent = $this->Model_core->categories($item['parent_id']);
  if ($parent->num_rows() > 0) {
    $parent = $parent->row_array();
    $parent = json_decode($parent['name'], true);
    $parent = $parent[setting_item('default_language')];
  }else{
    $parent = "Belgilanmagan";
  }
  $languages = $this->config->item('languages_list');
  $html = '';
?>
<div>
	<ul class="list-arrow">
		<li><b>Asosiy rukn:</b> <em><?=$parent;?></em></li>
		<li><b>Slug:</b> <em><?=$item['slug'];?></em></li>
		<li><b>Belgi:</b> <em><i class="<?=$item['icon'];?>"></i></em></li>
		<li><b>Holat:</b> <?if ($item['status']==1) {echo '<em>Aktivlangan</em><br />';}else{echo '<em>Aktivlanmagan</em>';}?></li>
	</ul>
	<h5 class="text-center">Nomi:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $name)) {
      				echo '<li><b>'.$value.':</b> <em>'.$name[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
	<h5 class="text-center">Sarlavha:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $title)) {
      				echo '<li><b>'.$value.':</b> <em>'.$title[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
	<h5 class="text-center">Meta kalit so'zlar:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $keywords)) {
      				echo '<li><b>'.$value.':</b> <em>'.$keywords[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
	<h5 class="text-center">Meta tasnif:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $description)) {
      				echo '<li><b>'.$value.':</b> <em>'.$description[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
</div>