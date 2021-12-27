<!-- =-=-=-=-=-=-= Pricing =-=-=-=-=-=-= -->
         <section class="custom-padding" id="prices">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Heading Area -->
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                        <!-- Main Title -->
                        <h1>{language=paid_services}</h1>
                        <!-- Short Description -->
                        <p class="heading-text">{language=paid_services_subtitle}</p>
                     </div>
                  </div>
                  <!-- Middle Content Box -->
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="row pricing">
                        <?php
                           $data = $this->Model_core->pricing();
                           if ($data->num_rows() > 0) {
                              $data = $data->result_array();
                              foreach ($data as $row) {
                                 $name = json_decode($row['name'], true);
                                 if (is_array($name)) {
                                    $name = $name[getDefaultLang()];
                                 }else{
                                    $name = '';
                                 }
                                 $subtitle = json_decode($row['subtitle'], true);
                                 if (is_array($subtitle)) {
                                    $subtitle = $subtitle[getDefaultLang()];
                                 }else{
                                    $subtitle = '';
                                 }

                                 $content = json_decode($row['content'], true);
                        ?>
                        <div class="col-sm-6 col-lg-4 col-md-4">
                           <div class="block <?=$row['featured']?>">
                              <h3><?=$name;?></h3>
                              <span class="price"><?=number_format($row['price'])?> {language=currency}</span>
                              <span class="time"><?=$subtitle;?></span>
                              <ul>
                                 <?php
                                    if (is_array($content)) {
                                       foreach ($content[getDefaultLang()] as $single) {
                                          echo "<li>{$single}</li>";
                                       }
                                    }
                                    
                                 ?>
                              </ul>
                           </div>
                        </div>
                        <?         
                              }
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Pricing End =-=-=-=-=-=-= -->