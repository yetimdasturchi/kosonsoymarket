
<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <?
                     if (isset($category)) {
                  ?>
                        <li><a href="{base_url}p/news">{language=news}</a></li>
                        <li><a class="active" href="{current_url}"><?=$category['category_name']?></a></li>
                        

                  <?
                     }else{
                  ?>
                        <li><a class="active" href="{current_url}">{language=news}</a></li>
                  <?
                     }
                  ?>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page pattern-bgs gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-xs-12 col-sm-12">
                     <div class="blog-detial">
                        <!-- Blog Archive -->
                        <div class="blog-post">
                           <div class="post-img">
                              <a href=""> <img class="img-responsive large-img" alt="" src="<?=$news['photo'];?>"> </a>
                           </div>
                           <div class="post-info"> <a href=""><?=dateformat($news['date'])?></a> <a href="{base_url}p/news/category/<?=$category['category_id']?>"><?=$category['category_name']?></a> </div>
                           <h3 class="post-title"> <a href=""> <?=$news['title'];?> </a> </h3>
                           <div class="post-excerpt">
                              <div class="text-justify"><?=$news['content'];?></div>
                              <div class="clearfix"></div>
                              <div class="tags-share clearfix">
                                 <div class="tags pull-left">
                                    <h3><i class="fa fa-share-alt"></i>:</h3>
                                    <ul>
                                       <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                                       <script src="https://yastatic.net/share2/share.js"></script>
                                       <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,telegram" data-size="s"></div>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Blog Grid -->
                     </div>
                  </div>
                  <!-- Right Sidebar -->
                  <div class="col-md-4 col-xs-12 col-sm-12">
                     <!-- Sidebar Widgets -->
                     <div class="blog-sidebar">
                        <!-- Categories --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>{language=categories}</a></h4>
                           </div>
                           <div class="widget-content categories">
                              <ul>
                                 <?php
                                    $categories = $this->Model_core->news_categories();
                                    if ($categories->num_rows() > 0) {
                                       $categories = $categories->result_array();
                                       foreach ($categories as $category) {
                                          echo '<li> <a href="'.base_url('p/news/category/'.$category['category_id']).'"> '.$category['category_name'].' </a> </li>';
                                       }
                                    }
                                 ?>
                              </ul>
                           </div>
                        </div>
                        <!-- Latest News --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>{language=latest_news}</a></h4>
                           </div>
                           <div class="widget-content recent-ads">
                              <?
                                 $news = $this->Model_core->news('', '6');
                                 if ($news->num_rows() > 0) {
                                    $news = $news->result_array();
                                    foreach ($news as $row) {
                              ?>
                              <!-- Ads -->
                              <div class="recent-ads-list">
                                 <div class="recent-ads-container">
                                    <div class="recent-ads-list-image">
                                       <a href="{base_url}p/news/view/<?=$row['news_id'];?>-<?=$row['slug'];?>" class="recent-ads-list-image-inner">
                                       <img src="<?=$row['photo'];?>" alt="">
                                       </a><!-- /.recent-ads-list-image-inner -->
                                    </div>
                                    <!-- /.recent-ads-list-image -->
                                    <div class="recent-ads-list-content">
                                       <h3 class="recent-ads-list-title">
                                          <a href="{base_url}p/news/view/<?=$row['news_id'];?>-<?=$row['slug'];?>"><?=$row['title']?></a>
                                       </h3>
                                       <ul class="recent-ads-list-location">
                                          <li><a href=""><?=dateformat($row['date'])?></a></li>
                                       </ul>
                                       <!-- /.recent-ads-list-price -->
                                    </div>
                                    <!-- /.recent-ads-list-content -->
                                 </div>
                                 <!-- /.recent-ads-container -->
                              </div>
                              <?         
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
         