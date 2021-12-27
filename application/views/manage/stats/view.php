<div>
	<ul class="list-arrow">
		<?
			if ($item['ip'] != '') {
				echo '<li><b>Ip manzil:</b> <em>'.$item['ip'].'</em></li>';
			}
			if ($item['country_name'] != '') {
				if ($item['country_code'] != '') {
					echo '<li><i class="flag-icon flag-icon-'.strtolower($item['country_code']).'"></i> <b>Mamlakat:</b> <em>'.$item['country_name'].' ('.$item['country_code'].')</em></li>';
				}else{
					echo '<li><b>Mamlakat:</b> <em>'.$item['country_name'].'</em></li>';
				}
			}
			if ($item['region_name'] != '') {
				echo '<li><b>Viloyat:</b> <em>'.$item['region_name'].'</em></li>';
			}
			if ($item['location'] != '' && $item['location'] != '""') {
				$location = json_decode($item['location'], true);
				if (is_array($location)) {
					if (array_key_exists('city', $location)) {
						if ($location['city'] != '') {
							echo '<li><b>Shahar:</b> <em>'.$location['city'].'</em></li>';
						}
					}
					if (array_key_exists('lat', $location) && array_key_exists('lon', $location)) {
						if ($location['lat'] != '' && $location['lon'] != '') {
							echo '<li><b>Kenglik:</b> <em>'.$location['lat'].','.$location['lon'].' (<a href="https://maps.google.com/?q='.$location['lat'].','.$location['lon'].'" target="_blank">Google xaritadan ko\'rish</a>)</em></li>';
						}
					}
					echo "<hr />";
					if (array_key_exists('isp', $location)) {
						if ($location['isp'] != '') {
							echo '<li><b>Internet provayder:</b> <em>'.$location['isp'].'</em></li>';
						}
					}
					if (array_key_exists('as', $location)) {
						if ($location['as'] != '') {
							echo '<li><b>Avtonom tizim:</b> <em>'.$location['as'].'</em></li>';
						}
					}
					if (array_key_exists('timezone', $location)) {
						if ($location['timezone'] != '') {
							echo '<li><b>Vaqt mintaqasi:</b> <em>'.$location['timezone'].'</em></li>';
						}
					}
				}
				echo "<hr />";
				if ($item['platform_type'] != '') {
					if ($item['platform_type']=='os') {
						echo '<li><b>Platforma turi:</b> <em>Desktop</em></li>';
					}else if ($item['platform_type']=='device') {
						echo '<li><b>Platforma turi:</b> <em>Mobil qurilma</em></li>';
					}else if ($item['platform_type']=='application') {
						echo '<li><b>Platforma turi:</b> <em>Mobil ilova</em></li>';
					}else{
						echo '<li><b>Platforma turi:</b> <em>Boshqa</em></li>';
					}
				}

				if ($item['platform'] != '') {
					echo '<li><b>Platforma:</b> <em>'.$item['platform'].'</em></li>';
				}

				if ($item['device'] != '') {
					if ($item['device_image'] != '') {
						echo '<li><img src='.base_url('public/images/visits/16'.$item['device_image']).' /> <b>Qurilma:</b> <em>'.$item['device'].'</em></li>';
					}else{
						echo '<li><b>Qurilma:</b> <em>'.$item['device'].'</em></li>';
					}
				}
				if ($item['os'] != '') {
					if ($item['os_image'] != '') {
						echo '<li><img src='.base_url('public/images/visits/16'.$item['os_image']).' /> <b>Operatsion tizim:</b> <em>'.$item['os'].'</em></li>';
					}else{
						echo '<li><b>Operatsion tizim:</b> <em>'.$item['os'].'</em></li>';
					}
				}
				if ($item['browser'] != '') {
					if ($item['browser_image'] != '') {
						echo '<li><img src='.base_url('public/images/visits/16'.$item['browser_image']).' /> <b>Brauzer:</b> <em>'.$item['browser'].'</em></li>';
					}else{
						echo '<li><b>Brauzer:</b> <em>'.$item['browser'].'</em></li>';
					}
				}
				echo "<hr />";
				if ($item['page'] != '') {
					echo '<li><b>Sahifa:</b> <em><a href="'.$item['page'].'" target="_blank">'.$item['page'].'</a></em></li>';
				}

				if ($item['referrer'] != '') {
					echo '<li><b>Referal:</b> <em><a href="'.$item['referrer'].'" target="_blank">'.$item['referrer'].'</a></em></li>';
				}

				if ($item['date'] != '') {
					echo '<li><b>Vaqt:</b> <em>'.date("Y-m-d H:i:s", $item['date']).'</em></li>';
				}
			}

		?>
	</ul>
</div>