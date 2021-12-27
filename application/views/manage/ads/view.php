<?php
                        $category = $this->Model_core->categories($post['category_id']);
                        if ($category->num_rows() > 0) {
                          $category = $category->row_array();
                          $category_name = json_decode($category['name'], true);
                          $category = $category_name[setting_item('default_language')];
                        }else{
                          $category = "";
                        }
                        $price_options = json_decode($post['price_options'], true);
                        if ($price_options['currency'] == 'sum') {$price_options['currency'] = get_phrase('currency_sum');}else if ($price_options['currency'] == 'usd') {$price_options['currency'] = get_phrase('currency_usd');}
                        if ($price_options['covenant'] == '0') {$price_options['covenant'] = "";}else if ($price_options['covenant'] == '1') {$price_options['covenant'] = '('.get_phrase('covenant').')';}
                        $pricing = $this->Model_core->pricing($post['pricing_id']);
                        if ($pricing->num_rows() > 0) {
                          $pricing = $pricing->row_array();
                          $pricing_name = json_decode($pricing['name'], true);
                                             if (is_array($pricing_name)) {
                                                $pricing = $pricing_name[setting_item('default_language')];
                                             }else{
                                                $pricing = '';
                                             }
                        }else{
                          $pricing = '';
                        }
?>
<div>
	<ul class="list-arrow">
		<li><b>Sarlavha:</b> <em><?=$post['title'];?></em></li>
		<li><b>Rukn:</b> <em><?=$category;?></em></li>
		<li><b>Narx:</b> <em><?=number_format($post['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?></em></li>
		<li><b>Ism:</b> <em><?=$post['contact_name'];?></em></li>
		<li><b>Email:</b> <em><?=$post['email'];?></em></li>
		<li><b>Telefon raqam:</b> <em><?=$post['phone'];?></em></li>
		<li><b>Manzil:</b> <em><?=$post['address'];?></em></li>
		<li><b>Joylashuv:</b> <em><?if($post['position'] == 'main'){echo'Premium';}elseif($post['position'] == 'featured'){echo'Turbo';}else{echo'Odatiy';}?></em></li>
		<li><b>Amal qilish:</b> <em><?=str_to_time($post['position_period']);?></em></li>
		<li><b>Xizmat turi:</b> <em><?=$pricing;?></em></li>
		<li><b>Ko'rishlar:</b> <em><?=$post['visits'];?></em></li>
		<li><b>Sana:</b> <em><?=str_to_time($post['created_at']);?></em></li>
		<li><b>Holat:</b> <em><?if ($post['status']==3) {echo'Sotilgan';}else if ($post['status']==2) {echo'Tasdiqlangan';}elseif($post['status']==1){echo'Jarayonda';}else{echo'Bekor qilingan';}?></em></li>
	</ul>
	
		<?
                                 $filters = json_decode($post['filter'], true);
                                 if (is_array($filters)) {
                                 	echo '<h5 class="text-center">Filtrlar</h5>
	<ul class="list-arrow">';
                                    foreach ($filters as $key => $value) {
                                       $id = str_replace("filter_", "", $key);
                                       $filter = $this->db->get_where('filters', array('filter_id' => $id));
                                       if ($filter->num_rows() > 0) {
                                          $filter = $filter->row_array();
                                          $filter_name = json_decode($filter['filter_name'], true);
                                          $filter_content = json_decode($filter['content'], true);
                                          if (is_array($filter_name)) {
                                             if ($filter['type'] == 'select') {
                                                if (is_array($filter_content)) {
                           ?>
                                                   <li><b><?=$filter_name[setting_item('default_language')];?></b> <em><?=$value;?></em></li>
                           <?   
                                                }
                                             }
                                             if ($filter['type'] == 'input') {
                           ?>
                                                   <li><b><?=$filter_name[setting_item('default_language')];?></b> <em><?=$value;?></em></li>
                           <?                      
                                             }
                                             
                                          }
                                       }

                                    }
                                    echo '</ul>';
                                 }
                              ?>
	
</div>