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
      <!-- =-=-=-=-=-=-= Advance Search =-=-=-=-=-=-= -->
      <div id="search-section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-xs-12 col-md-12">
                  <!-- Form -->
                  <form method="post" class="search-form ad-search-form">
                     <div class="col-md-4 col-xs-6 col-sm-3 no-padding custom-filter">
                        <select class="category form-control" palceholder="{language=sections}" name="category">
                           <option value="0">{language=sections}</option>
                           <?
                              $categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
                              if ($categories->num_rows() > 0) {
                                 $categories = $categories->result_array();
                                 foreach ($categories as $category) {
                                    if ($this->input->get('category') == $category['category_id']) {
                                       $selected = 'selected=""';
                                    }else{
                                       $selected = '';
                                    }
                                    $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                                    $category['name'] = json_decode($category['name'], true);
                                    if ($subcategories->num_rows() > 0) {
                                       $subcategories = $subcategories->result_array();
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][getDefaultLang()].'</option>';
                                       echo '<optgroup>';
                                       foreach ($subcategories as $subcategory) {
                                          $subcategory['name'] = json_decode($subcategory['name'], true);
                                          echo '<option value="'.$subcategory['category_id'].'" '.$selected.'>- '.$subcategory['name'][getDefaultLang()].'</option>';
                                       }
                                       echo "</optgroup>";
                                    }else{
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][getDefaultLang()].'</option>';
                                    }
                                 }
                              }
                           ?>
                        </select>
                     </div>
                     <!-- Search Field -->
                     <div class="col-md-4 col-xs-6 col-sm-3 no-padding">
                        <input type="text" class="custom-filter form-control" placeholder="{language=search}" name="query" value="<?=$this->input->get('query')?>" />
                     </div>
                     <!-- Search Field -->
                     <div class="col-md-2 col-xs-6 col-sm-3 no-padding">
                        <input type="number" class="custom-filter form-control" placeholder="{language=min_sum}" name="min" min="1" value="<?=$this->input->get('min')?>"/>
                     </div>
                     <!-- Search Field -->
                     <div class="col-md-2 col-xs-6 col-sm-3 no-padding">
                        <input type="number" class="custom-filter form-control" placeholder="{language=max_sum}" name="max" min="1" value="<?=$this->input->get('max')?>" />
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-12 filter-content">
                           <?
                             // $this->load->view('ads/filter', array('category_id' => 2));
                           ?>
                        </div>
                     </div>
                  </form>
                  <!-- end .search-form -->
               </div>
            </div>
         </div>
      </div>
      <!-- =-=-=-=-=-=-= Advance Search End  =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix main-content-ads">
         <div class="waitme">
         <div class="featured-content">
         
         </div>
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding gray" style="padding: 30px 0;">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-12 col-lg-12 col-sx-12">
                     <!-- Row -->
                     <div class="row">

                        <!-- Sorting Filters End-->
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                           <div class="clearfix"></div>
                           <div class="listingTopFilterBar">
                              <div class="col-md-8 col-xs-5 col-sm-6 no-padding">
                                 <ul class="filterAdType">
                                    <li class="active"><a href="" list="list"><i class="fa fa-list"></i> <span class="hidden-xs">{language=list}</span></a> </li>
                                    <li class=""><a href="" list="grid"><i class="fa fa-th"></i> <span class="hidden-xs">{language=gallery}</span></a> </li>
                                 </ul>
                              </div>
                              <div class="col-md-4 col-xs-7 col-sm-6 no-padding text-right">
                                 <div class="header-listing">
                                    <h6 class="hidden-xs">{language=sort} :</h6>
                                    <div class="custom-select-box text-justify">
                                        <select class="custom-select ads-sort" name="sort">
                                            <option value="default">{language=sort_default}</option>
                                            <option value="cheap">{language=sort_cheap}</option>
                                            <option value="expensive">{language=sort_expensive}</option>
                                            <option value="new">{language=sort_new}</option>
                                            <option value="old">{language=sort_old}</option>
                                            <option value="name_az">{language=sort_name_az}</option>
                                            <option value="name_za">{language=sort_name_za}</option>
                                        </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Ads Archive -->
                        <div class="posts-masonry row">
                           <div class="col-md-12 col-xs-12 col-sm-12 ads-content">
                             
                           </div>
                        </div>
                        <!-- Ads Archive End -->  
                        
                        <div class="clearfix"></div>
                        <!-- Pagination -->  
                        <div class="col-md-12 col-xs-12 col-sm-12 text-center postlist-pagination">
                           
                        </div>
                        <!-- Pagination End -->   
                     </div>
                     <!-- Row End -->
                  </div>
                  <!-- Middle Content Area  End -->
                  <!-- Left Sidebar -->
                  <!-- Left Sidebar End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         </div>

                     <input type="hidden" name="limit" value="12" />
                     <input type="hidden" name="from" value="0"/>