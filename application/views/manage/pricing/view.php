<?
  $name = json_decode($price['name'], true);
  $subtitle = json_decode($price['subtitle'], true);
  $content = json_decode($price['content'], true);
  $languages = $this->config->item('languages_list');
  $html = '';
?>
<div>
	<ul class="list-arrow">
		<li><b>Narxi:</b> <em><?=$price['price'];?> so'm</em></li>
		<li><b>Turi:</b> <?if ($price['featured']=='featured') {echo '<em>Maxsus</em><br />';}else{echo '<em>Belgilanmagan</em>';}?></li>
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
    			if (array_key_exists($key, $subtitle)) {
      				echo '<li><b>'.$value.':</b> <em>'.$subtitle[$key].'</em></li>';
    			}
  			}
		?>
	</ul>
	<h5 class="text-center">Tarkib:</h5>
	<ul class="list-arrow">
		<?
			foreach ($languages as $key => $value) {
    			if (array_key_exists($key, $content)) {
    				echo '<h6><em>'.$value.':</h6></em>';
    				foreach ($content[$key] as $row) {
    					echo '<li><em>'.$row.'</em></li>';
    				}
    			}
  			}
		?>
	</ul>
</div>