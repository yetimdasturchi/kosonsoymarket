
<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <li><a class="active" href="{current_url}">{language=faq}</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding error-page">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-8 col-xs-12 col-sm-12">
                     <ul class="accordion">
                        <?php
                           $data = json_decode(setting_item('faq'), true);
                           if (is_array($data)) {
                              foreach ($data[getDefaultLang()] as $row) {
                        ?>
                        <li class="">
                           <h3 class="accordion-title"><a href="#"><?=$row['question']?></a></h3>
                           <div class="accordion-content">
                              <p><?=$row['content']?></p>
                           </div>
                        </li>
                        <?
                              }
                           }
                        ?>
                     </ul>
                  </div>
                  <?php
                     $this->load->view('sections/rules');
                  ?>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>