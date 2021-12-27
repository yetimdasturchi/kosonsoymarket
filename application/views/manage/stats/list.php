
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample form-autosubmit" method="get" action="{current_url}" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-4 col-sm-4 col-lg-2">
                        <label for="unique">Takroriy qiymat</label>
                        <select class="js-example-basic-single" name="u" id="unique" style="width:100%">
                          <option value="null">Tanlash</option>
                          <option value="ip" <?if ($this->input->get('u') == 'ip'){echo "selected";}?>>Ip manzil</option>
                          <option value="country_code" <?if ($this->input->get('u') == 'country_code'){echo "selected";}?>>Mamlakat</option>
                          <option value="region_name" <?if ($this->input->get('u') == 'region_name'){echo "selected";}?>>Shahar</option>
                          <option value="platform" <?if ($this->input->get('u') == 'platform'){echo "selected";}?>>Platforma</option>
                          <option value="device" <?if ($this->input->get('u') == 'device'){echo "selected";}?>>Qurilma</option>
                          <option value="device_model" <?if ($this->input->get('u') == 'device_model'){echo "selected";}?>>Qurilma modeli</option>
                          <option value="os_name" <?if ($this->input->get('u') == 'os_name'){echo "selected";}?>>Operatsion tizim</option>
                          <option value="browser_name" <?if ($this->input->get('u') == 'browser_name'){echo "selected";}?>>Brauzer</option>
                          <option value="page" <?if ($this->input->get('u') == 'page'){echo "selected";}?>>Sahifa</option>
                          <option value="referrer" <?if ($this->input->get('u') == 'referrer'){echo "selected";}?>>Referal</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-2">
                        <label for="begin">Boshlanish sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="b" class="form-control" value="<?=$this->input->get('b');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-2">
                        <label for="end">Tugash sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="e" class="form-control" value="<?=$this->input->get('e');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-4 col-lg-3">
                        <label for="country">Mamlakat</label>
                        <select class="js-example-basic-single" name="c" id="country" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('country_name');
                            $this->db->group_by('country_name');
                            $this->db->order_by('country_name', 'asc');
                            $countries = $this->db->get('visitors');
                            foreach ($countries->result_array() as $row) {
                              if ($this->input->get('c') == $row['country_name']) {
                                echo ' <option value="'.$row['country_name'].'" selected>'.$row['country_name'].'</option>';
                              }else{
                                echo ' <option value="'.$row['country_name'].'">'.$row['country_name'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-4 col-lg-3">
                        <label for="region">Shahar</label>
                        <select class="js-example-basic-single" name="r" id="region" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('region_name');
                            $this->db->group_by('region_name');
                            $this->db->order_by('region_name', 'asc');
                            $regions = $this->db->get('visitors');
                            foreach ($regions->result_array() as $row) {
                              if ($this->input->get('r') == $row['region_name']) {
                                echo ' <option value="'.$row['region_name'].'" selected>'.$row['region_name'].'</option>';
                              }else{
                                echo ' <option value="'.$row['region_name'].'">'.$row['region_name'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-2">
                        <label for="app">Mobil ilovalar</label>
                        <select class="js-example-basic-single" name="app" id="app" style="width:100%">
                          <option value="null">Yo'q</option>
                          <option value="yes" <?if ($this->input->get('app') == 'yes'){echo "selected";}?>>Ha</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-2">
                        <label for="platform">Platforma</label>
                        <select class="js-example-basic-single" name="p" id="platform" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('platform');
                            $this->db->group_by('platform');
                            $this->db->order_by('platform', 'asc');
                            $platform = $this->db->get('visitors');
                            foreach ($platform->result_array() as $row) {
                              if ($this->input->get('p') == $row['platform']) {
                                echo ' <option value="'.$row['platform'].'" selected>'.$row['platform'].'</option>';
                              }else{
                                echo ' <option value="'.$row['platform'].'">'.$row['platform'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-2">
                        <label for="os_name">Operatsion tizim</label>
                        <select class="js-example-basic-single" name="os" id="os_name" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('os_name');
                            $this->db->group_by('os_name');
                            $this->db->order_by('os_name', 'asc');
                            $os_name = $this->db->get('visitors');
                            foreach ($os_name->result_array() as $row) {
                              if ($this->input->get('os') == $row['os_name']) {
                                echo ' <option value="'.$row['os_name'].'" selected>'.$row['os_name'].'</option>';
                              }else{
                                echo ' <option value="'.$row['os_name'].'">'.$row['os_name'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-3">
                        <label for="device_brand">Brend</label>
                        <select class="js-example-basic-single" name="db" id="device_brand" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('device_brand');
                            $this->db->group_by('device_brand');
                            $this->db->order_by('device_brand', 'asc');
                            $device_brand = $this->db->get('visitors');
                            foreach ($device_brand->result_array() as $row) {
                              if ($this->input->get('db') == $row['device_brand']) {
                                echo ' <option value="'.$row['device_brand'].'" selected>'.$row['device_brand'].'</option>';
                              }else{
                                echo ' <option value="'.$row['device_brand'].'">'.$row['device_brand'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-3">
                        <label for="browser_name">Brauzer</label>
                        <select class="js-example-basic-single" name="br" id="browser_name" style="width:100%">
                          <option value="null">Tanlash</option>
                          <?
                            $this->db->select('browser_name');
                            $this->db->group_by('browser_name');
                            $this->db->order_by('browser_name', 'asc');
                            $browser_name = $this->db->get('visitors');
                            foreach ($browser_name->result_array() as $row) {
                              if ($this->input->get('br') == $row['browser_name']) {
                                echo ' <option value="'.$row['browser_name'].'" selected>'.$row['browser_name'].'</option>';
                              }else{
                                echo ' <option value="'.$row['browser_name'].'">'.$row['browser_name'].'</option>';
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
                  <h4 class="card-title">Statistika</h4>
                  <div class="row">
                  <?
                    $limit = 36;
                    if ($this->input->get('page') != '') {
                      $from = $this->input->get('page');
                      if($from != 0){
                        $from = ($from-1) * $limit;
                      }
                    }else{$from = 0;}

                    if ($this->input->get('b') != '') {
                      $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
                    }

                    if ($this->input->get('e') != '') {
                      $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
                    }

                    if ($this->input->get('c') != '') {
                      $this->db->where('country_name', $this->input->get('c'));
                    }

                    if ($this->input->get('r') != '') {
                      $this->db->where('region_name', $this->input->get('r'));
                    }

                    if ($this->input->get('p') != '') {
                      $this->db->where('platform', $this->input->get('p'));
                    }

                    if ($this->input->get('os') != '') {
                      $this->db->where('os_name', $this->input->get('os'));
                    }

                    if ($this->input->get('db') != '') {
                      $this->db->where('device_brand', $this->input->get('db'));
                    }

                    if ($this->input->get('br') != '') {
                      $this->db->where('browser_name', $this->input->get('br'));
                    }
                    
                    if ($this->input->get('app') != '') {
                      $this->db->where('platform_type', 'application');
                    }

                    if ($this->input->get('u') != '') {
                      $this->db->group_by($this->input->get('u'));
                    }

                    $this->db->order_by('date', 'desc');
                    
                    $this->db->limit($limit, $from);

                    $visitors = $this->db->get('visitors');
                    
                    if ($visitors->num_rows() > 0) {
                      foreach ($visitors->result_array() as $visitor) {
                        echo '<div class="col-md-6 col-sm-6 col-lg-4">';
                        $this->load->view('manage/stats/single', array('item' => $visitor));
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
            if ($this->input->get('b') != '') {
              $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
            }

            if ($this->input->get('e') != '') {
              $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
            }

            if ($this->input->get('c') != '') {
              $this->db->where('country_name', $this->input->get('c'));
            }

            if ($this->input->get('r') != '') {
              $this->db->where('region_name', $this->input->get('r'));
            }

            if ($this->input->get('p') != '') {
              $this->db->where('platform', $this->input->get('p'));
            }

            if ($this->input->get('os') != '') {
              $this->db->where('os_name', $this->input->get('os'));
            }

            if ($this->input->get('db') != '') {
              $this->db->where('device_brand', $this->input->get('db'));
            }

            if ($this->input->get('br') != '') {
              $this->db->where('browser_name', $this->input->get('br'));
            }
            if ($this->input->get('app') != '') {
                $this->db->where('platform_type', 'application');
            }
                    
            if ($this->input->get('u') != '') {
              $this->db->group_by($this->input->get('u'));
            }

            $allcount = $this->db->count_all_results('visitors');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/stats/list?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/stats/list');
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