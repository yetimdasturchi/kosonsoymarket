
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <?
                if ($this->session->flashdata('message') != '') {
              ?>
                  <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    <?=$this->session->flashdata('message');?>
                  </div>
              <?
                }
              ?>
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample form-autosubmit" method="get" action="{current_url}" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-4 col-sm-4 col-lg-3">
                        <label for="query">Izlash uchun kalit so'z</label>
                        <input type="text" name="q" class="form-control" id="query" placeholder="Kalit so'z" value="<?=$this->input->get('q');?>">
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-3">
                        <label for="category">Rukn</label>
                        <select class="js-example-basic-single" name="c" id="category" style="width:100%">
                          <option value="0">Tanlash</option>
                          <?
                              $categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
                              if ($categories->num_rows() > 0) {
                                 $categories = $categories->result_array();
                                 foreach ($categories as $category) {
                                    if ($this->input->get('c') == $category['category_id']) {
                                       $selected = 'selected=""';
                                    }else{
                                       $selected = '';
                                    }
                                    $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                                    $category['name'] = json_decode($category['name'], true);
                                    if ($subcategories->num_rows() > 0) {
                                       $subcategories = $subcategories->result_array();
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][setting_item('default_language')].'</option>';
                                       echo '<optgroup>';
                                       foreach ($subcategories as $subcategory) {
                                          $subcategory['name'] = json_decode($subcategory['name'], true);
                                          echo '<option value="'.$subcategory['category_id'].'" '.$selected.'>- '.$subcategory['name'][setting_item('default_language')].'</option>';
                                       }
                                       echo "</optgroup>";
                                    }else{
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][setting_item('default_language')].'</option>';
                                    }
                                 }
                              }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-2">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="s" id="status" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <option value="3" <?if($this->input->get('s')=='3'){echo 'selected';}?>>Sotilgan</option>
                          <option value="2" <?if($this->input->get('s')=='2'){echo 'selected';}?>>Aktivlangan</option>
                          <option value="1" <?if($this->input->get('s')=='1'){echo 'selected';}?>>Sotilgan</option>
                          <option value="0" <?if($this->input->get('s')=='0'){echo 'selected';}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-2">
                        <label for="begin">Boshlanish sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="b" class="form-control" value="<?=$this->input->get('b');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-2">
                        <label for="end">Tugash sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="e" class="form-control" value="<?=$this->input->get('e');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_begin">Joylashuv boshlanish sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="pb" class="form-control" value="<?=$this->input->get('pb');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_end">Joylashuv tugash sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="pe" class="form-control" value="<?=$this->input->get('pe');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="positon">Joylashuv</label>
                        <select class="js-example-basic-single" name="p" id="positon" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <option value="default" <?if($this->input->get('p')=='default'){echo 'selected';}?>>Odatiy</option>
                          <option value="featured" <?if($this->input->get('p')=='featured'){echo 'selected';}?>>Turbo</option>
                          <option value="main" <?if($this->input->get('p')=='main'){echo 'selected';}?>>Premium</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="pricing">Narxnoma</label>
                        <select class="js-example-basic-single" name="pr" id="pricing" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <?php
                            $pricing = $this->Model_core->pricing();
                            if ($pricing->num_rows() > 0) {
                              $pricing = $pricing->result_array();
                              foreach ($pricing as $row) {
                                $pricing_name = json_decode($row['name'], true);
                                if (is_array($pricing_name)) {
                                  $pricing_name = $pricing_name[setting_item('default_language')];
                                }else{
                                  $pricing_name = '';
                                }
                                if ($this->input->get('pr')==$row['price_id']) {
                                  echo '<option value="'.$row['price_id'].'" selected>'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }else{
                                 echo '<option value="'.$row['price_id'].'">'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Eʼlonlar</h4>
                  <div class="row">
                  <?
                    $limit = 36;
                    if ($this->input->get('page') != '') {
                      $from = $this->input->get('page');
                      if($from != 0){
                        $from = ($from-1) * $limit;
                      }
                    }else{$from = 0;}

                    if ($this->input->get('q') != '') {
                      $this->db->like('title', $this->input->get('q'));
                      $this->db->or_like('content', $this->input->get('q'));
                      $this->db->or_like('price', $this->input->get('q'));
                      $this->db->or_like('contact_name', $this->input->get('q'));
                      $this->db->or_like('email', $this->input->get('q'));
                      $this->db->or_like('phone', $this->input->get('q'));
                      $this->db->or_like('address', $this->input->get('q'));
                    }

                    if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
                      $this->db->where('category_id', $this->input->get('c'));
                    }

                    if ($this->input->get('s') != '' && $this->input->get('s') != 'null') {
                      $this->db->where('status', $this->input->get('s'));
                    }

                    if ($this->input->get('b') != '') {
                      $this->db->where('created_at >=', strtotime($this->input->get('b').' 00:00:00'));
                    }

                    if ($this->input->get('e') != '') {
                      $this->db->where('created_at <=', strtotime($this->input->get('e').' 23:59:59'));
                    }

                    if ($this->input->get('pb') != '') {
                      $this->db->where('position_period >=', strtotime($this->input->get('pb').' 00:00:00'));
                    }

                    if ($this->input->get('pb') != '') {
                      $this->db->where('position_period <=', strtotime($this->input->get('pb').' 23:59:59'));
                    }

                    if ($this->input->get('p') != '' && $this->input->get('pr') != 'null') {
                      $this->db->where('position', $this->input->get('p'));
                    }

                    if ($this->input->get('pr') != '' && $this->input->get('pr') != 'null') {
                      $this->db->where('pricing_id', $this->input->get('pr'));
                    }
                    

                    $this->db->order_by('created_at', 'desc');
                    
                    $this->db->limit($limit, $from);

                    $posts = $this->db->get('posts');
                    
                    if ($posts->num_rows() > 0) {
                      foreach ($posts->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/ads/single', array('post' => $item));
                        echo '</div>';
                      }
                    }else{
                  ?>
                    <div class="col-lg-12 text-center">
                      <div class="wrapper align-items-center py-2 border-bottom text-center">
                        Ma'lumotlar mavjud emas
                      </div>
                    </div>
                  <?
                    }
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?
            if ($this->input->get('q') != '') {
              $this->db->like('title', $this->input->get('q'));
              $this->db->or_like('content', $this->input->get('q'));
              $this->db->or_like('price', $this->input->get('q'));
              $this->db->or_like('contact_name', $this->input->get('q'));
              $this->db->or_like('email', $this->input->get('q'));
              $this->db->or_like('phone', $this->input->get('q'));
                      $this->db->or_like('address', $this->input->get('q'));
            }

            if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
              $this->db->where('category_id', $this->input->get('c'));
            }

            if ($this->input->get('s') != '' && $this->input->get('s') != 'null') {
              $this->db->where('status', $this->input->get('s'));
            }

            if ($this->input->get('b') != '') {
              $this->db->where('created_at >=', strtotime($this->input->get('b').' 00:00:00'));
            }

            if ($this->input->get('e') != '') {
              $this->db->where('created_at <=', strtotime($this->input->get('e').' 23:59:59'));
            }

            if ($this->input->get('pb') != '') {
              $this->db->where('position_period >=', strtotime($this->input->get('pb').' 00:00:00'));
            }

            if ($this->input->get('pb') != '') {
              $this->db->where('position_period <=', strtotime($this->input->get('pb').' 23:59:59'));
            }

            if ($this->input->get('p') != '' && $this->input->get('pr') != 'null') {
              $this->db->where('position', $this->input->get('p'));
            }

            if ($this->input->get('pr') != '' && $this->input->get('pr') != 'null') {
              $this->db->where('pricing_id', $this->input->get('pr'));
            }

            $allcount = $this->db->count_all_results('posts');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/ads/list?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/ads/list');
            }

            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $allcount;
            $config['per_page'] = $limit;
            $config['attributes'] = array('class' => 'page-link');
            $config['page_query_string']    = TRUE;
            $config['query_string_segment']= 'page';
 
            $config['full_tag_open']    = '<nav><ul class="pagination d-flex justify-content-center pagination-danger rounded-flat">';
            $config['full_tag_close']   = '</nav>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close']    = '</a></li>';
            $config['next_tag_open']    = '<li class="page-item">';
            $config['next_tag_close']  = '</li>';
            $config['prev_tag_open']    = '<li class="page-item">';
            $config['prev_tag_close']  = '</li>';
            $config ['prev_link'] = '<i class="mdi mdi-chevron-left"></i>';
            $config ['next_link'] = '<i class="mdi mdi-chevron-right"></i>';
            $config['first_link'] = false; 
            $config['last_link']  = false;
 
            $this->pagination->initialize($config);
            echo $this->pagination->create_links();
          ?>