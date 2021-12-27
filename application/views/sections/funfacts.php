<!-- =-=-=-=-=-=-= Statistics Counter =-=-=-=-=-=-= -->
         <div class="funfacts custom-padding parallex">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="number"><span class="timer" data-from="0" data-to="<?=$this->db->count_all_results('posts');?>" data-speed="1000" data-refresh-interval="5">0</span>+</div>
                     <h4>{language=count_allads}</h4>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="number"><span class="timer" data-from="0" data-to="<?=$this->db->where('status', 2)->count_all_results('posts');?>" data-speed="1000" data-refresh-interval="5">0</span>+</div>
                     <h4>{language=count_activeads}</h4>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="number"><span class="timer" data-from="0" data-to="<?=gettelegramUsers();?>" data-speed="1000" data-refresh-interval="5">0</span>+</div>
                     <h4>{language=count_allusers}</span></h4>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="number"><span class="timer" data-from="0" data-to="<?=gettelegramUsers('daily');?>" data-speed="1000" data-refresh-interval="5">0</span>+</div>
                     <h4>{language=count_dailyusers}</span></h4>
                  </div>
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container -->
         </div>
         <!-- /.funfacts -->
         <!-- =-=-=-=-=-=-= Statistics Counter End =-=-=-=-=-=-= -->