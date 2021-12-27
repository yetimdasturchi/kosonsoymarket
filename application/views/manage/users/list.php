
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
                  <h4 class="card-title">Foydalanuvchi qo'shish</h4>
                  <form class="forms-sample" method="post" action="{base_url}manage/users/insert" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="username">Login</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Login..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="password">Parol</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Parol..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="fullname">To'liq ism</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="To'liq ism..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="permissions">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="1">Aktivlangan</option>
                          <option value="0">Aktivlanmagan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="status">Huquqlar</label>
                        <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="permissions[]" id="permissions" required="">
                          <option value="">Tanlash</option>
                          <?
                            $permissions_data = $this->config->item('user_permissions');
                            foreach ($permissions_data as $key => $value) {
                              echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Kiritish</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Foydalanuvchilar</h4>
                  <div class="row">
                  <?
                    $limit = 36;
                    if ($this->input->get('page') != '') {
                      $from = $this->input->get('page');
                      if($from != 0){
                        $from = ($from-1) * $limit;
                      }
                    }else{$from = 0;}

                    $this->db->order_by('user_id', 'asc');
                    
                    $this->db->limit($limit, $from);

                    $users = $this->db->get('users');
                    
                    if ($users->num_rows() > 0) {
                      foreach ($users->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/users/single', array('item' => $item));
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
            $allcount = $this->db->count_all_results('users');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/users/list?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/users/list');
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