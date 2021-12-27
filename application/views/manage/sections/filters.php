
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
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="query">Izlash uchun kalit so'z</label>
                        <input type="text" name="q" class="form-control" id="query" placeholder="Kalit so'z" value="<?=$this->input->get('q');?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="status">Rukn</label>
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
                  <h4 class="card-title">Filtrlar <a href="{base_url}manage/sections/filters_add"><button type="button" class="btn btn-outline-success float-right btn-xs"><i class="mdi mdi-plus"></i>Qo'shish</button><a></h4>
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
                      $this->db->like('filter_name', $this->input->get('q'));
                      $this->db->or_like('content', $this->input->get('q'));
                    }

                    if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
                      $this->db->where('category_id', $this->input->get('c'));
                    }

                    $this->db->order_by('category_id', 'asc');
                     $this->db->order_by('sort', 'asc');
                    
                    $this->db->limit($limit, $from);

                    $filters = $this->db->get('filters');
                    
                    if ($filters->num_rows() > 0) {
                      foreach ($filters->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/sections/filter_single', array('item' => $item));
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
              $this->db->like('filter_name', $this->input->get('q'));
              $this->db->or_like('content', $this->input->get('q'));
            }

            if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
              $this->db->where('category_id', $this->input->get('c'));
            }

            $allcount = $this->db->count_all_results('filters');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/sections/filters?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/sections/filters');
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