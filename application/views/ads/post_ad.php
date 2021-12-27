<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <li><a class="active" href="{current_url}">{language=post_ad}</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding  gray waitme">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                     <!-- end post-padding -->
                     <div class="post-ad-form postdetails">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                              {language=post_ad}
                           </h3>
                        </div>
                        <p class="lead">{language=lead}</p>
                        <?
                           if ($this->session->flashdata('message_success') == 'ok') {
                        ?>
                              <div role="alert" class="alert alert-success alert-dismissible">
                                 <p class="message">{language=post_ad_success}</p>
                              </div>
                        <?
                           }
                        ?>
                        <div role="alert" class="alert alert-warning alert-dismissible" style="display: none;">
                           <p class="message"></p>
                        </div>
                        <form class="submit-form post-ad-data">
                           <!-- Title  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_title} <small>({language=post_ad_subtitle})</small></label>
                                 <input class="form-control" placeholder="" type="text" name="title">
                              </div>
                           </div>
                           <hr />
                           <div class="row">
                              <!-- Category  -->
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_category} <small>({language=post_ad_subcategory})</small></label>
                                 <select class="category form-control post-ad-categories" name="category">
                                    <option value="0">{language=select}</option>
                                    <?
                                    $categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
                                    if ($categories->num_rows() > 0) {
                                       $categories = $categories->result_array();
                                       foreach ($categories as $category) {
                                          $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                                          $category['name'] = json_decode($category['name'], true);
                                          if ($subcategories->num_rows() > 0) {
                                             $subcategories = $subcategories->result_array();
                                             echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][getDefaultLang()].'</option>';
                                             echo '<optgroup>';
                                             foreach ($subcategories as $subcategory) {
                                                $subcategory['name'] = json_decode($subcategory['name'], true);
                                                echo '<option value="'.$subcategory['category_id'].'" '.$selected.'>'.$subcategory['name'][getDefaultLang()].'</option>';
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
                              <div class="col-sm-12 col-xs-12 col-md-12 filter-content"></div>
                           </div>
                           <hr />
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_price}</label>
                                 <input class="form-control" placeholder="" type="number" min="0" name="price">
                              </div>
                              <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_price_currency}</label>
                                 <select class="category form-control" name="currency">
                                    <option value="sum">{language=currency_sum}</option>
                                    <option value="usd">{language=currency_usd}</option>
                                 </select>
                              </div>
                              <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_price_covenant}</label>
                                 <select class="category form-control" name="covenant">
                                    <option value="0">{language=post_ad_price_covenant_0}</option>
                                    <option value="1">{language=post_ad_price_covenant_1}</option>
                                 </select>
                              </div>
                           </div>
                           <hr />
                           <!-- Ad Description  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                                 <label class="control-label">{language=post_ad_description} <small>({language=post_ad_subdescription})</small></label>
                                 <textarea name="content" id="editor1" rows="12" class="form-control" placeholder=""></textarea>
                              </div>
                           </div>
                           <hr />
                           <!-- end row -->
                           <!-- Image Upload  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_photos} <small>{language=post_ad_photos_subtitle}</small></label>
                                 <div id="imageUpload" class="dropzone"></div>
                              </div>
                           </div>
                           <!-- end row -->
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_name}</label>
                                 <input class="form-control" placeholder="" type="text" name="onwer_name">
                              </div>
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_phone}</label>
                                 <input class="form-control" placeholder="" type="text" name="onwer_phone">
                              </div>
                           </div>
                           <!-- end row -->
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_email}</label>
                                 <input class="form-control" placeholder="" type="text" name="onwer_email">
                              </div>
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label class="control-label">{language=post_ad_address}</label>
                                 <input class="form-control" placeholder="" type="text" name="onwer_address">
                              </div>
                           </div>
                           <!-- end row -->
                           <div class="row publish">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <select class="category form-control" name="service_type">
                                    <option value="0">{language=post_ad_service_type}</option>
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
                                    ?>
                                    <option value="<?=$row['price_id']?>"><?=$name;?> (<?=number_format($row['price'])?> {language=currency})</option>
                                    <?
                                          }
                                       }
                                    ?>
                                 </select>
                              </div>
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <button type="submit" id="postsubmit" class="btn btn-theme btn-lg btn-block">{language=post_ad_submit}</button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <!-- end post-ad-form-->
                  </div>
                  <!-- end col -->
                  <?php
                     $this->load->view('sections/rules');
                  ?>
                  <!-- Middle Content Area  End --><!-- end col -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         