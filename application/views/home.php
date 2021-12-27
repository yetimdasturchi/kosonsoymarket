      <!-- Home Banner 1 -->
      <section id="hero" class="hero bg-img">
         <div class="content">
            <p>Umumiy <b><?=$this->db->count_all_results('posts');?></b> dan ortiq e'lonlar</p>
            <h1>Kosonsoy bo`ylab e`lonlarni izlash va joylash</h1>
            <div class="search-holder">
               <div id="custom-search-input">
                  <div class="input-group col-md-12 col-xs-12 col-sm-12">
                     <form action="/ads" method="get" autocomplete="off">
                        <input type="hidden" name="sort" value="default">
                        <input type="hidden" name="limit" value="12">
                        <input type="hidden" name="from" value="0">
                        <input type="hidden" name="category" value="0">
                        <input type="hidden" name="list" value="list">
                        <input type="text" name="query" class="form-control" placeholder="Izlamoqchi bo`lgan mahsulot nomini kiriting..." /> <span class="input-group-btn">
                        <button class="btn btn-theme" type="submit"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>
                     </form>
                  </div>
               </div>
            </div>
            <!-- .search-holder -->
         </div>
         <!-- .content -->
      </section>
      <!-- Home Banner 1 End -->
      <!-- Main Content Area -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Home Tabs =-=-=-=-=-=-= -->
         <section class="home-tabs">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="tabs-container">
                        <ul role="tablist" class="nav nav-tabs header-cats-list dragscroll" id="headercatslist">
                           <?
                              if ($categories->num_rows() > 0) {
                                 $headercatslist = $categories->result_array();
                                 $x = 0;
                                 foreach ($headercatslist as $category) {
                                    $x++;
                           ?>
                                    <!-- Category -->
                                    <li class="clearfix <?if($x==1){echo 'active';}?>">
                                       <a data-toggle="tab" role="tab" href="#headercatslist-<?=$category['category_id'];?>" aria-expanded="false"> <i class="<?=$category['icon'];?>"></i> </a>
                                    </li>
                           <?         
                                 }
                              }
                           ?>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                           <?
                              if ($categories->num_rows() > 0) {
                                 $headercatslist_tab = $categories->result_array();
                                 $x = 0;
                                 foreach ($headercatslist_tab as $category) {
                                    $x++;
                           ?>
                                    <div id="headercatslist-<?=$category['category_id'];?>" class=" row tab-pane <?if($x==1){echo 'active in';}?> fade">
                                       <?
                                          $post = array(
                                             'limit' => 9,
                                             'from' => 0, 
                                             'category' => $category['category_id'],
                                             'sort' => 'rand'
                                          );
                                          $data = $this->Model_core->posts($post, 2, 'main');
                                          if ($data->num_rows() > 0) {
                                             $data = $data->result_array();
                                             foreach ($data as $row) {
                                                $this->load->view('ads/single_main', array('data' => $row));
                                             }
                                          }
                                       ?>
                                    </div>
                           <?         
                                 }
                              }
                           ?>
                        </div>
                        <!-- End Tab panes -->
                        <!-- Tab Content End -->
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- =-=-=-=-=-=-= Home Tabs End =-=-=-=-=-=-= -->
         <?php
         	$this->load->view('sections/funfacts');
            $this->load->view('sections/howitwork');
         ?>
         <!-- =-=-=-=-=-=-= Blog Section =-=-=-=-=-=-= -->
         <section class="custom-padding gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Content Box -->
               <!-- Row -->
               <div class="row">
                  <!-- Heading Area -->
                  <div class="heading-panel">
                     <div class="col-xs-12 col-md-12 col-sm-12">
                        <h3 class="main-title text-left">
                           {language=latest_news}
                        </h3>
                     </div>
                  </div>
                  <!-- Middle Content Box -->
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="row">
                        <?
                            $news = $this->Model_core->news('', '6');
                            if ($news->num_rows() > 0) {
                            	$news = $news->result_array();
                        		foreach ($news as $row) {
                        			$this->load->view('news/col_md_4', array('data' => $row));
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
         <!-- =-=-=-=-=-=-= Blog Section End =-=-=-=-=-=-= -->
         <?php
         	$this->load->view('sections/partners');
         ?>
         
      
