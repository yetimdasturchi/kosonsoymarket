<?
$images = $this->Model_core->getPostImages($data['post_id']);
$category = $this->Model_core->categories($data['category_id']);
if ($category->num_rows() > 0) {
   $category = $category->row_array();
   $category_name = json_decode($category['name'], true);
   $category = '<a href="'.base_url().'ads?list=grid&sort=default&limit=12&from=0&category='.$data['category_id'].'">'.$category_name[getDefaultLang()].'</a>';
}else{
   $category = "";
}
?>
<!-- Ads -->
                              <div class="recent-ads-list">
                                 <div class="recent-ads-container">
                                    <div class="recent-ads-list-image">
                                       <a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" class="recent-ads-list-image-inner">
                                       <?
                                          if (is_array($images)) {
                                             echo'<img src="'.$images[0].'" alt="">';
                                          }else{
                                             echo'<img src="'.$images.'" alt="">';
                                          }
                                       ?>
                                       </a><!-- /.recent-ads-list-image-inner -->
                                    </div>
                                    <!-- /.recent-ads-list-image -->
                                    <div class="recent-ads-list-content">
                                       <h3 class="recent-ads-list-title">
                                          <a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" title="<?=$data['title'];?>"><?=my_substr($data['title'], 0, 20);?>...</a>
                                       </h3>
                                       <ul class="recent-ads-list-location">
                                          <li><a title="<?=$data['address'];?>"><?=my_substr($data['address'], 0, 18);?></a></li>
                                       </ul>
                                       <?
                                            if($data['price']!=0){
                                        ?>
                                        <?
                                          $price_options = json_decode($data['price_options'], true);
                                          if ($price_options['currency'] == 'sum') {
                                             $price_options['currency'] = get_phrase('currency_sum');
                                          }else if ($price_options['currency'] == 'usd') {
                                             $price_options['currency'] = get_phrase('currency_usd');
                                          }
                                          if ($price_options['covenant'] == '0') {
                                             $price_options['covenant'] = "";
                                          }else if ($price_options['covenant'] == '1') {
                                             $price_options['covenant'] = '('.get_phrase('covenant').')';
                                          }
                                       ?>
                                       <div class="recent-ads-list-price">
                                          <?=number_format($data['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?>
                                       </div>
                                       <?
                                       }else{
                                        ?>
                                        <div class="recent-ads-list-price">&nbsp;</div>
                                        <?
                                       }
                                       ?>
                                       <!-- /.recent-ads-list-price -->
                                    </div>
                                    <!-- /.recent-ads-list-content -->
                                 </div>
                                 <!-- /.recent-ads-container -->
                              </div>