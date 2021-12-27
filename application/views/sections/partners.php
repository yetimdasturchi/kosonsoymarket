<!-- =-=-=-=-=-=-= Our Partners =-=-=-=-=-=-= -->
         <section class="section-padding">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Box -->
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="row">
                        <?php
                           $parners = $this->Model_core->partner_show();
                           
                           if ( $parners->num_rows() > 0 ) {
                              $parners = $parners->result_array();
                              foreach ($parners as $row) {
                        ?>
                                 <div class="col-xs-6 col-sm-3 client-2">
                                    <a href="<?=$row['url'];?>" title="<?=$row['name'];?>" target="_blank"><img src="<?=base_url($row['image']);?>" alt="<?=$row['name'];?>" ></a>
                                 </div>
                        <?         
                              }
                           }
                        ?>
                     </div>
                  </div>
                  <!-- Middle Content Box End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Our Partners  End =-=-=-=-=-=-= -->