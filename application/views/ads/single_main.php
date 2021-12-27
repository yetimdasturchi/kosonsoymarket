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

                                 <div class="col-md-4 col-xs-12 col-sm-6">
                                 <!-- Ad Box -->
                                 <div class="category-grid-box fr-ads">
                                    <a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" title="<?=$data['title'];?>">
                                    <!-- Ad Img -->
                                    <div class="category-grid-img">
                                          
                                          <?
                                          if (is_array($images) && count($images) > 1) {
                                         ?>
                                         <div id="carousel-featured-<?=$data['post_id'];?>" class="carousel slide slide-carousel" data-ride="carousel" data-interval="1500" data-pause="hover">
                                             <!-- Indicators -->
                                             <ol class="carousel-indicators">
                                                <?
                                                   $count = 0;
                                                   foreach ($images as $image) {
                                                ?>
                                                      <li data-target="#carousel-featured-<?=$data['post_id'];?>" data-slide-to="<?=$count;?>" class="<?if($count==0){echo'active';}?>"></li>
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
                                          <?
                                          if ($data['status']==3) {
                                          ?>
                                             <div class="sold">
                                                <img class="img-responsive" src="<?=base_url();?>public/images/sold.png" alt="">
                                             </div>
                                          <?
                                             }
                                          ?>
                                       
                                    </div>
                                    </a>
                                    <!-- Ad Img End -->
                                    <div class="short-description">
                                       <!-- Ad Category -->
                                       <div class="category-title"> <span><?=$category;?></span> </div>
                                       <!-- Ad Title -->
                                       <h3><a href="<?=base_url();?>ads/view/<?=$data['post_id'];?>/<?=uniqueKey();?>" title="<?=$data['title'];?>"><?=my_substr($data['title'], 0, 25);?>...</a></h3>
                                       <!-- Price -->
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
                                             $price_options['covenant'] = '<span class="negotiable">('.get_phrase('covenant').')</span>';
                                          }
                                       ?>
                                       <div class="price"><?=number_format($data['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?></span></div>
                                        <?
                                        }else{
                                        ?>
                                        <div class="price">&nbsp;</div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <!-- Addition Info -->
                                    <div class="ad-info">
                                       <ul>
                                          <li><i class="fa fa-map-marker" title="<?=$data['address'];?>"></i> <?=my_substr($data['address'], 0, 18);?></li>
                                          <li><i class="fa fa-clock-o"></i> <?=str_to_time($data['created_at']);?> </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <!-- Ad Box End -->
                                 </div>