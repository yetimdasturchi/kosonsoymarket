<div>
	<ul class="list-arrow">
		<li><b>Ism:</b> <em><?=$contact['name'];?></em></li>
		<li><b>Mavzu:</b> <em><?=$contact['subject'];?></em></li>
		<li><b>Email:</b> <em><?=$contact['email'];?></em></li>
		<li><b>Sana:</b> <em><?=dateformat($contact['date']);?></em></li>
		<li><b>Holat:</b> <em><?if($contact['status']==1){echo '<del class="text-danger">Ko\'rib chiqilgan</del>';}else{echo'Jarayonda';}?></em></li>
		<li><b>Xabar:</b> <em><?=$contact['message'];?></em></li>
	</ul>
</div>