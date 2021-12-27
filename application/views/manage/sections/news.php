
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
                  <h4 class="card-title">Rukn qo'shish</h4>
                  <form class="forms-sample" method="post" action="{base_url}manage/sections/news_insert" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="category_name">Nomi</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Nomi..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="language">Til</label>
                        <select class="js-example-basic-single" name="language" id="language" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                            $languages = $this->config->item('languages_list');
                            foreach ($languages as $key => $value) {
                              echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-6">
                        <label for="meta_title">Meta sarlavha</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta sarlavha..." required="">
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-6">
                        <label for="meta_description">Meta tasnif</label>
                        <input type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Meta tasnif..." required="">
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="meta_keyword">Meta kalit so'zlar</label>
                        <input type="text" name="meta_keyword" class="form-control tags" id="meta_keyword" placeholder="Meta kalit so'zlar..." required="">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kiritish</button>
                    <button type="reset" class="btn btn-light">Bekor qilish</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Xabarlar ruknlari</h4>
                  <div class="row">
                  <?
                    $limit = 36;
                    if ($this->input->get('page') != '') {
                      $from = $this->input->get('page');
                      if($from != 0){
                        $from = ($from-1) * $limit;
                      }
                    }else{$from = 0;}

                    $this->db->order_by('language', 'asc');
                    
                    $this->db->limit($limit, $from);

                    $news_category = $this->db->get('news_category');
                    
                    if ($news_category->num_rows() > 0) {
                      foreach ($news_category->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/sections/news_single', array('item' => $item));
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
            $allcount = $this->db->count_all_results('news_category');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/sections/news?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/sections/news');
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