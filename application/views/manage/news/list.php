
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
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="query">Izlash uchun kalit so'z</label>
                        <input type="text" name="q" class="form-control" id="query" placeholder="Kalit so'z" value="<?=$this->input->get('q');?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="begin">Boshlanish sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="b" class="form-control" value="<?=$this->input->get('b');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="end">Tugash sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="e" class="form-control" value="<?=$this->input->get('e');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="status">Rukn</label>
                        <select class="js-example-basic-single" name="c" id="category" style="width:100%">
                          <option value="0">Tanlash</option>
                          <?
                            $categories = $this->db->order_by('language', 'asc')->get('news_category');
                            foreach ($categories->result_array() as $category) {
                              if ($this->input->get('c')==$category['category_id']) {
                                echo '<option value="'.$category['category_id'].'" selected>'.$category['category_name'].' ('.get_languge_name($category['language']).')</option>';
                              }else{
                                echo '<option value="'.$category['category_id'].'">'.$category['category_name'].' ('.get_languge_name($category['language']).')</option>';
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
                  <h4 class="card-title">Xabarlar</h4>
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
                      $this->db->or_like('tags', $this->input->get('q'));
                    }

                    if ($this->input->get('b') != '') {
                      $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
                    }

                    if ($this->input->get('e') != '') {
                      $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
                    }

                    if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
                      $this->db->where('category_id', $this->input->get('c'));
                    }

                    $this->db->order_by('date', 'desc');
                    
                    $this->db->limit($limit, $from);

                    $news = $this->db->get('news');
                    
                    if ($news->num_rows() > 0) {
                      foreach ($news->result_array() as $item) {
                        echo '<div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">';
                        $this->load->view('manage/news/single', array('item' => $item));
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
              $this->db->or_like('tags', $this->input->get('q'));
            }

            if ($this->input->get('b') != '') {
              $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
            }

            if ($this->input->get('e') != '') {
              $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
            }

            if ($this->input->get('c') != '' && $this->input->get('c') > '0') {
              $this->db->where('category_id', $this->input->get('c'));
            }
            
            $allcount = $this->db->count_all_results('news');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/news/list?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/news/list');
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