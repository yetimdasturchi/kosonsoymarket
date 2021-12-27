<?
   $data = setting_item('how_it_work');
   $data = json_decode($data, true);
?>
<!-- =-=-=-=-=-=-= How It Work =-=-=-=-=-=-= -->
         <section class="section-padding white">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Heading Area -->
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                        <!-- Main Title -->
                        <h1><?=$data['title'][getDefaultLang()];?></h1>
                        <!-- Short Description -->
                        <p class="heading-text"><?=$data['subtitle'][getDefaultLang()];?></p>
                     </div>
                  </div>
                  <!-- Middle Content Box -->
                  <div class="col-xs-12 col-md-12 col-sm-12 ">
                     <div class="row">
                        <?
                           foreach ($data['content'][getDefaultLang()] as $row) {
                        ?>
                        <div class="how-it-work text-center">
                           <div class="how-it-work-icon"> <i class="<?=$row['icon'];?>"></i> </div>
                           <h4><?=$row['title'];?></h4>
                           <p><?=$row['subtitle'];?></p>
                        </div>
                        <?
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
         <!-- =-=-=-=-=-=-= How It Work End =-=-=-=-=-=-= -->