
<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <li><a class="active" href="{current_url}">{language=about_us}</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                     <div class="about-us-content">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                             {language=about_site}
                           </h3>
                        </div>
                        <h2></h2>
                        <?php
                           $data = json_decode(setting_item('about_site'), true);
                           if (is_array($data)) {
                              echo $data[getDefaultLang()];
                           }
                        ?>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                     <div class="about-page-featured-image">
                        <img src="{setting=style_path}images/project_at_work.png" alt="">
                     </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <section class="about-us">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12 no-padding">
                     <?php
                        $data = json_decode(setting_item('about_site_archive'), true);
                        if (is_array($data)) {
                           foreach ($data[getDefaultLang()] as $row) {
                     ?>
                     <!-- service box 3 -->
                     <div class="col-sm-4 col-md-4 col-xs-12 no-padding">
                        <div class="why-us border-box text-center">
                           <h5><?=$row['title'];?></h5>
                           <p><?=$row['content'];?></p>
                        </div>
                     </div>
                     <!-- service box end -->
                     <?
                           }
                        }
                     ?>
                  </div>
               </div>
            </div>
            <!-- end container -->
         </section>
         <div class="clearfix"></div>
         <?php
            $this->load->view('sections/funfacts');
            $this->load->view('sections/pricing');
         ?>
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding" id="advertising">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  
                  <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                     <div class="about-page-featured-image">
                        <img src="{setting=style_path}images/project_at_adversitement.png" alt="">
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                     <div class="about-us-content">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                             {language=advertising_service}
                           </h3>
                        </div>
                        <h2></h2>
                        <?php
                           $data = json_decode(setting_item('advertisement'), true);
                           if (is_array($data)) {
                              echo $data[getDefaultLang()];
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <!-- =-=-=-=-=-=-= App Download Section  =-=-=-=-=-=-= --> 
         <div class="app-download-section parallex">
            <!-- app-download-section-wrapper -->
            <div class="app-download-section-wrapper">
               <!-- app-download-section-container -->
               <div class="app-download-section-container">
                  <!-- container -->
                  <div class="container">
                     <!-- row -->
                     <div class="row">
                        <!-- col-md-12 -->
                        <div class="col-md-12">
                           <!-- section-title -->
                           <div class="section-title"> <span>{language=mobile_applications}</span></div>
                           <!-- /section-title -->
                        </div>
                        <!-- /col-md-12 -->
                        <!-- col-md-4 -->
                        <div class="col-md-2">
                          
                        </div>
                        <!-- /col-md-4 -->
                        <!-- col-md-4 -->
                        <div class="col-md-4">
                           <!-- Windows Store -->
                           <a href="<?=base_url('uploads/chrome.zip');?>" title="Windows Store" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-chrome"></i>
                           <span>
                           <span>{language=download}</span> <span>{language=download_for_chrome} </span> </span>
                           </span>
                           </a>
                           <!-- /Windows Store -->
                        </div>
                        <!-- /col-md-4 -->
                        <!-- col-md-4 -->
                        <div class="col-md-4">
                           <!-- Google Store -->
                           <a href="<?=base_url('uploads/Kosonsoy Market_1_1.0.apk');?>" title="Google Store" class="btn app-download-button"> <span class="app-store-btn">
                           <i class="fa fa-android"></i>
                           <span>
                           <span>{language=download}</span> <span>{language=download_for_android} </span> </span>
                           </span>
                           </a>
                           <!-- /Google Store -->
                        </div>
                        <!-- /col-md-4 -->
                        <!-- col-md-4 -->
                        <div class="col-md-2">
                          
                        </div>
                        <!-- /col-md-4 -->
                     </div>
                     <!-- /row -->
                  </div>
                  <!-- /container -->
               </div>
               <!-- /app-download-section-container -->
            </div>
            <!-- /download-section-wrapper -->
         </div>
         <!-- =-=-=-=-=-=-= App Download Section End =-=-=-=-=-=-= --> 

         <?php
            $this->load->view('sections/partners');
         ?>