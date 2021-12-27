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
<!-- Ads Listing -->
                              <div class="ads-list-archive <?if($data['position'] == 'featured' || $data['position'] == 'main'){echo'fr-ads';}?>">
                                 <!-- Image Block -->
                                 <div class="col-lg-3 col-md-5 col-sm-5 no-padding">
                                    <a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" title="<?=$data['title'];?>">
                                    <!-- Img Block -->
                                    <div class="ad-archive-img">

                                         <?
                                          if (is_array($images) && count($images) > 1) {
                                         ?>
                                         <div id="carousel-list-<?=$data['post_id'];?>" class="carousel slide slide-carousel" data-ride="carousel" data-interval="1500" data-pause="hover">
                                             <!-- Indicators -->
                                             <ol class="carousel-indicators">
                                                <?
                                                   $count = 0;
                                                   foreach ($images as $image) {
                                                ?>
                                                      <li data-target="#carousel-list-<?=$data['post_id'];?>" data-slide-to="<?=$count;?>" class="<?if($count==0){echo'active';}?>"></li>
                                                <?
                                                   $count++;
                                                   }
                                                ?>
                                             </ol>
                                             <!-- Wrapper for slides -->
                                             <div class="carousel-inner">
                                                <?
                                                   $count = 0;
                                                   foreach ($images as $image) {
                                                ?>
                                                      <div class="item <?if($count==0){echo'active';}?>"> <img src="<?=$image;?>" alt="Image"> </div>
                                                <?
                                                   $count++;
                                                   }
                                                ?>
                                             </div>
                                          </div>
                                          <?
                                             }else if(is_array($images) && count($images) == 1){
                                          ?>
                                                <img class="img-responsive" src="<?=$images[0];?>" alt="">
                                          <?
                                             }else{
                                          ?>
                                             <img class="img-responsive" src="<?=$images;?>" alt="">
                                          <?      
                                             }
                                          ?>
                                      
                                    </div>
                                       <?
                                          if ($data['status']==3) {
                                       ?>
                                             <div class="sold">
                                                <img class="img-responsive" src="<?=base_url();?>public/images/sold.png" alt="">
                                             </div>
                                       <?
                                          }
                                       ?>
                                    <!-- Img Block -->
                                     </a>
                                     
                                 </div>
                                 <!-- Ads Listing -->
                                 <div class="clearfix visible-xs-block"></div>
                                 <!-- Content Block -->
                                 <div class="col-lg-9 col-md-7 col-sm-7 no-padding">
                                    <!-- Ad Desc -->
                                    <div class="ad-archive-desc">
                                        <?
                                            if($data['price']!=0){
                                        ?>
                                       <!-- Price -->
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
                                       <div class="ad-price"><?=number_format($data['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?></div>
                                       <?
                                            }
                                       ?>
                                       <!-- Title -->
                                       <a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" title="<?=$data['title'];?>"><h3><?=$data['title'];?>  </h3></a>
                                       <!-- Category -->
                                       <div class="category-title"> <span><?=$category;?></span> </div>
                                       <!-- Short Description -->
                                       <div class="clearfix visible-xs-block"></div>
                                       <p class="hidden-sm">&nbsp;&nbsp;</p>
                                       <!-- Ad Features -->
                                       <ul class="add_info">
                                          <!-- Contact Details -->
                                          <li>
                                             <a class="custom-tooltip tooltip-effect-4" href="tel:<?=$data['phone'];?>">
                                                <span class="tooltip-item"><i class="fa fa-phone"></i></span>
                                                <div class="tooltip-content">
                                                   <h4><?=get_phrase('phone_number');?>:</h4>
                                                   <?=$data['phone'];?>
                                                </div>
                                             </a>
                                          </li>
                                          <!-- Address -->
                                          <li>
                                             <div class="custom-tooltip tooltip-effect-4">
                                                <span class="tooltip-item"><i class="fa fa-map-marker"></i></span>
                                                <div class="tooltip-content">
                                                   <h4><?=get_phrase('address');?>:</h4>
                                                   <?=$data['address'];?>
                                                </div>
                                             </div>
                                          </li>
                                          <!-- Ad Type -->
                                       </ul>
                                       <!-- Ad History -->
                                       <div class="clearfix archive-history">
                                          <div class="last-updated" title="<?=$data['address'];?>"><i class="fa fa-map-marker"></i> <?=my_substr($data['address'], 0, 20);?> </div>
                                          <div class="last-updated">&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=str_to_time($data['created_at']);?></div>
                                       </div>
                                    </div>
                                    <!-- Ad Desc End -->
                                 </div>
                                 <!-- Content Block End -->
                              </div>