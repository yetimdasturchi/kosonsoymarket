<?
  $permissions = '<ul class="list-arrow">';
  $permissions_data = $this->config->item('user_permissions');
  foreach (json_decode($item['permissions']) as $key => $value) {
  	++$key;
    $permissions .= '<li>'.$key.'-'.$permissions_data[$value].'</li> ';
  }
  $permissions .= '</ul>';
?>
<div>
	<ul class="list-arrow">
		<li><b>Login:</b> <em><?=$item['username'];?></em></li>
		<li><b>To'liq ism:</b> <em><?=$item['fullname'];?></em></li>
		<li><b>Vazifa:</b> <em><?=$item['role'];?></em></li>
		<li><b>Holat:</b> <em><?if($item['status']==1){echo'Aktivlangan';}else{echo'Aktivlanmagan';}?></em></li>
		<li><b>Huquqlar:</b> <em><?=$permissions;?></em></li>
	</ul>
</div>