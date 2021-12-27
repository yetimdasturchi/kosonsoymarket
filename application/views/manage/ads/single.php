<?php
$image = $this->Model_core->getPostImages($post['post_id'], 1);
                        if (is_array($image)) {
                          $image = $image[0];
                        }
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
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-ads-<?=$post['post_id'];?>" data-toggle="popover" title="<?=$post['title'];?>" data-content="<b>Sarlavha:</b> <em><?=$post['title'];?></em><br /><b>Rukn:</b> <em><?=$category;?></em><br /><b>Narx:</b> <em><?=number_format($post['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?></em><br /><b>Ism:</b> <em><?=$post['contact_name'];?></em><br /><b>Email:</b> <em><?=$post['email'];?></em><br /><b>Telefon raqam:</b> <em><?=$post['phone'];?></em><br /><b>Manzil:</b> <em><?=$post['address'];?></em><br /><b>Joylashuv:</b> <em><?if($post['position'] == 'main'){echo'Premium';}elseif($post['position'] == 'featured'){echo'Turbo';}else{echo'Odatiy';}?></em><br /><b>Amal qilish:</b> <em><?=str_to_time($post['position_period']);?></em><br /><b>Xizmat turi:</b> <em><?=$pricing;?></em><br /><b>Ko'rishlar:</b> <em><?=$post['visits'];?></em><br /><b>Sana:</b> <em><?=str_to_time($post['created_at']);?></em><br /><b>Holat:</b> <em><?if ($post['status']==3) {echo'Sotilgan';}else if ($post['status']==2) {echo'Aktivlangan';}elseif($post['status']==1){echo'Jarayonda';}else{echo'Aktivlanmagan';}?></em><br />" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="<?=$image;?>" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?if(my_strlen($post['title']) > 20){echo my_substr($post['title'], 0, 20).'...';}else{echo $post['title'];}?></h6>
                            <small class="text-muted mb-0"><i class="icon-clock mr-1"></i><?=str_to_time($post['created_at']);?></small>
                          </div>
                          
                          <?
                            if ($post['status']==3) {
                          ?>
                              <div class="badge badge-pill badge-primary ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-primary" title="Sotilgan"><i class="icon-check font-weight-bold"></i></div>
                          <?
                            }else if ($post['status']==2) {
                          ?>
                              <div class="badge badge-pill badge-success ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-success" title="Aktivlangan"><i class="icon-check font-weight-bold"></i></div>
                          <?
                            }else if ($post['status']==1) {
                          ?>
                              <div class="badge badge-pill badge-danger ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-danger" title="Jarayonda"><i class="icon-clock font-weight-bold"></i></div>
                          <?
                            }else{
                          ?>
                              <div class="badge badge-pill badge-dark ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right"  title="Aktivlanmagan"><i class="icon-close font-weight-bold"></i></div>
                          <?
                            }
                          ?>
                        </div>
                        <menu class="context-menu-ads-<?=$post['post_id'];?>" type="context" style="display:none">
                          	<command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/ads/view/<?=$post['post_id'];?>/<?=uniqueKey();?>">
                         	<command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/ads/edit/<?=$post['post_id'];?>" ajax-modal-tab="this">
                          <hr />
                         	<command label="Rasmlar" icon="fa-image" ajax-modal="{base_url}manage/ads/images/<?=$post['post_id'];?>">
                          <command label="Telegramga yuborish" icon="fa-send" ajax-modal="{base_url}manage/ads/telegram/<?=$post['post_id'];?>">
                         	<hr />
                         	<command label="Joylashuv" icon="fa-sitemap" ajax-modal="{base_url}manage/ads/position/<?=$post['post_id'];?>">
                         	<command label="Holat" icon="fa-sliders" ajax-modal="{base_url}manage/ads/status/<?=$post['post_id'];?>">
                         	<command label="Narxnoma" icon="fa-suitcase" ajax-modal="{base_url}manage/ads/pricing/<?=$post['post_id'];?>">
                         	<hr />
                         	<command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/ads/delete/<?=$post['post_id'];?>">
                        </menu>