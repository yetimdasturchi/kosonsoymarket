
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
                      <div class="form-group col-md-4 col-sm-4 col-lg-4">
                        <label for="query">Izlash uchun kalit so'z</label>
                        <input type="text" name="q" class="form-control" id="query" placeholder="Kalit so'z" value="<?=$this->input->get('q');?>">
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-4">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="s" id="status" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="0" <?if($this->input->get('s')=='0'){echo "selected";}?>>Aktivlanmagan</option>
                          <option value="1" <?if($this->input->get('s')=='1'){echo "selected";}?>>Aktiv</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-4">
                        <label for="status">Asosiy rukn</label>
                        <select class="js-example-basic-single" name="c" id="category" style="width:100%">
                          <option value="0">Tanlash</option>
                          <?
                            $categories = $this->db->order_by('category_id', 'asc')->get_where('categories', array('parent_id' => 0));
                            foreach ($categories->result_array() as $category) {
                              $category_name = json_decode($category['name'], true);
                              if ($this->input->get('c')==$category['category_id']) {
                                echo '<option value="'.$category['category_id'].'" selected>'.$category_name[setting_item('default_language')].'</option>';
                              }else{
                                echo '<option value="'.$category['category_id'].'">'.$category_name[setting_item('default_language')].'</option>';
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
                  <h4 class="card-title">E'lonlar ruknlari <a href="{base_url}manage/sections/posts_add"><button type="button" class="btn btn-outline-success float-right btn-xs"><i class="mdi mdi-plus"></i>Qo'shish</button><a></h4>
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
                      $this->db->like('name', $this->input->get('q'));
                      $this->db->or_like('slug', $this->input->get('q'));
                      $this->db->or_like('title', $this->input->get('q'));
                      $this->db->or_like('keywords', $this->input->get('q'));
                      $this->db->or_like('description', $this->input->get('q'));
                    }

                    if ($this->input->get('s') != '') {
                      $this->db->where('status', $this->input->get('s'));
                    }

                    if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
                      $this->db->where('parent_id', $this->input->get('c'));
                    }

                    $this->db->order_by('category_id', 'asc');
                    
                    $this->db->limit($limit, $from);

                    $categories = $this->db->get('categories');
                    
                    if ($categories->num_rows() > 0) {
                      foreach ($categories->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/sections/post_single', array('item' => $item));
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
              $this->db->like('name', $this->input->get('q'));
              $this->db->or_like('slug', $this->input->get('q'));
              $this->db->or_like('title', $this->input->get('q'));
              $this->db->or_like('keywords', $this->input->get('q'));
              $this->db->or_like('description', $this->input->get('q'));
            }

            if ($this->input->get('s') != '') {
              $this->db->where('status', $this->input->get('s'));
            }

            if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
              $this->db->where('parent_id', $this->input->get('c'));
            }

            $allcount = $this->db->count_all_results('categories');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/sections/posts?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/sections/posts');
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