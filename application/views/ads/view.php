<?
$images = $this->Model_core->getPostImages($ad['post_id'], 100);
$category = $this->Model_core->categories($ad['category_id']);
if ($category->num_rows() > 0) {
   $category = $category->row_array();
   $category_name = json_decode($category['name'], true);
   $category = '<a href="'.base_url().'ads?list=grid&sort=default&limit=12&from=0&category='.$ad['category_id'].'">'.$category_name[getDefaultLang()].'</a>';
}else{
   $category = "";
}
?>
<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <li><a class="active" href="{current_url}">{language=ads}</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page pattern-bgs gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-xs-12 col-sm-12">
                     <!-- Single Ad -->
                     <div class="single-ad">
                        <!-- Title -->
                        <div class="ad-box <?if($ad['position'] == 'featured' || $ad['position'] == 'main' && $ad['position_period'] >= date('Y-m-d H:i:s')){echo 'featured-border';}?>">
                           <h3><?=$ad['title'];?></h3>
                           <div class="short-history">
                              <ul>
                                 <li><?=str_to_time($ad['created_at']);?></li>
                                 <li><?=$category;?></li>
                                 <li><i class="fa fa-map-marker"></i>: <?=$ad['address'];?></li>
                              </ul>
                           </div>
                           <?if($ad['position'] == 'featured' || $ad['position'] == 'main' && $ad['position_period'] >= date('Y-m-d H:i:s')):?>
                           <div class="featured-ribbon">
                               <span><?if($ad['position'] == 'main'){echo get_phrase('premium');}else if($ad['position'] == 'featured'){echo get_phrase('turbo');}?></span>
                            </div>
                           <?endif;?>
                        </div>
                        <?
                           if (is_array($images) && count($images) > 1) {
                        ?>
                        <!-- Listing Slider  --> 
                        <div class="flexslider single-page-slider">
                           <div class="flex-viewport">
                              <ul class="slides slide-main">
                                 <?
                                    $count = 0;
                                    foreach ($images as $image) {
                                 ?>
                                    <li><img alt="" src="<?=$image;?>"></li>
                                 <?
                                    $count++;
                                    }
                                 ?>
                              </ul>
                           </div>
                        </div>
                        <!-- Listing Slider Thumb --> 
                        <div class="flexslider" id="carousels">
                           <div class="flex-viewport">
                              <ul class="slides slide-thumbnail">
                                 <?
                                    $count = 0;
                                    foreach ($images as $image) {
                                 ?>
                                    <li><img alt="" draggable="false" src="<?=$image;?>"></li>
                                 <?
                                    $count++;
                                    }
                                 ?>
                              </ul>
                           </div>
                        </div>
                        <?
                           }else if(is_array($images) && count($images) == 1){
                        ?>
                        <!-- Listing Slider  --> 
                        <div class="flexslider single-page-slider">
                           <div class="flex-viewport">
                              <ul class="slides slide-main">
                                 <?
                                    $count = 0;
                                    foreach ($images as $image) {
                                 ?>
                                    <li><img alt="" src="<?=$image;?>"></li>
                                 <?
                                    $count++;
                                    }
                                 ?>
                              </ul>
                           </div>
                        </div>
                        <?
                           }else{
                        ?>
                        <!-- Listing Slider  --> 
                        <div class="flexslider single-page-slider">
                           <div class="flex-viewport">
                              <ul class="slides slide-main">
                                <li><img alt="" src="<?=$images;?>"></li>
                              </ul>
                           </div>
                        </div>
                        <?
                           }
                        ?>
                        <div class="clearfix"></div>
                        <!-- Short Description  --> 
                        <div class="ad-box">
                           <?
                              if ($ad['status']==3) {
                           ?>
                                 <div class="ad-closed">
                                    <img class="img-responsive" src="{base_url}public/images/sold-out.png" alt="">
                                 </div>  
                           <?      
                              }
                           ?>
                           <div class="short-features">
                              <?
                                 $filters = json_decode($ad['filter'], true);
                                 if (is_array($filters)) {
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
                                                   <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                                                      <span><strong><?=$filter_name[getDefaultLang()];?></strong> :</span> <?=$value;?>
                                                   </div>
                           <?   
                                                }
                                             }
                                             if ($filter['type'] == 'input') {
                           ?>
                                                   <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                                                      <span><strong><?=$filter_name[getDefaultLang()];?></strong> :</span> <?=$value;?>
                                                   </div>
                           <?                      
                                             }
                                             
                                          }
                                       }
                                    }
                                 }
                              ?>
                           </div>
                           <!-- Ad Specifications --> 
                           <div class="specification">
                              <!-- Heading Area -->
                              <?=$ad['content'];?>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <!-- Single Ad End --> 
                     
                  </div>
                  <!-- Right Sidebar -->
                  <div class="col-md-4 col-xs-12 col-sm-12">
                     <!-- Sidebar Widgets -->
                     <div class="sidebar">
                        <!-- Price info block -->   
                        <div class="ad-listing-price">
                           <?
                            if($ad['price']!=0){
                           ?>
                           <!-- Price -->
                                       <?
                                          $price_options = json_decode($ad['price_options'], true);
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
                           <p><?=number_format($ad['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];?></p>
                            <?
                            }
                            ?>
                        </div>
                        <!-- Contact info -->
                        <div class="contact white-bg">
                           <!-- Email Button trigger modal -->
                           <button class="btn-block btn-contact contactUser"><?=$ad['contact_name']?></button>
                           <!-- Email Modal -->
                           <a href="tel:<?=$ad['phone']?>"><button class="btn-block btn-contact contactPhone number"><?=$ad['phone']?></button></a>
                           <!-- Email Button trigger modal -->
                           <a href="mailto:<?=$ad['email']?>"><button class="btn-block btn-contact contactEmail"><?=$ad['email']?></button></a>
                        </div>
                        <!-- User Info -->
                        <div class="white-bg user-contact-info">
                           <div class="ad-listing-meta">
                              <ul>
                                 <li>{language=address}: <span class="color"><?=$ad['address']?></span></li>
                                 <li>{language=ad_id}: <span class="color"><?=$ad['post_id']?>/<?=$this->uri->segment(4);?></span></li>
                                 <li>{language=visits}: <span class="color"><?=$ad['visits']?></span></li>
                                 <li>{language=added}: <span class="color"><?=str_to_time($ad['created_at']);?></span></li>
                              </ul>
                           </div>
                        </div>
                        <!-- Featured Ads --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>{language=featured_ads}</a></h4>
                           </div>
                           <div class="widget-content featured">
                              <div class="featured-slider-3">
                                 <?
                                    $post = array(
                                       'limit' => 6,
                                       'from' => 0, 
                                       'sort' => 'rand'
                                    );
                                    $featured = $this->Model_core->posts($post, 2, 'main');
                                    if ($featured->num_rows() > 0) {
                                       $featured = $featured->result_array();
                                       foreach ($featured as $row) {
                                          $this->load->view('ads/single_featured_sidebar', array('data' => $row));
                                       }
                                    }
                                 ?>
                              </div>
                           </div>
                        </div>
                        <!-- Recent Ads --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>{language=latest_ads}</a></h4>
                           </div>
                           <div class="widget-content recent-ads">
                              <?
                                 $post = array(
                                    'limit' => 3,
                                    'from' => 0, 
                                    'sort' => 'new'
                                 );
                                 $featured = $this->Model_core->posts($post, 2, 'default');
                                 if ($featured->num_rows() > 0) {
                                    $featured = $featured->result_array();
                                    foreach ($featured as $row) {
                                       $this->load->view('ads/single_latest_sidebar', array('data' => $row));
                                    }
                                 }
                              ?>
                           </div>
                        </div>
                     </div>
                     <!-- Sidebar Widgets End -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         