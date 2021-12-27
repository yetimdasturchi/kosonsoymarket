
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-envelope-letter icon-lg text-success"></i>
                    <div class="ml-3">
                      <p class="mb-0">Umumiy aloqa xabarlari</p>
                      <h6><?=$this->db->count_all_results('contacts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-envelope-open icon-lg text-info"></i>
                    <div class="ml-3">
                      <p class="mb-0">Ko'rib chiqilgan xabarlari</p>
                      <h6><?=$this->db->where('status', 1)->count_all_results('contacts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-clock icon-lg text-warning"></i>
                    <div class="ml-3">
                      <p class="mb-0">Jarayondagi xabarlar</p>
                      <h6><?=$this->db->where('status', 0)->count_all_results('contacts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
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
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="s" id="status" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="0" <?if($this->input->get('s')=='0'){echo "selected";}?>>Ko'rib chiqilmagan</option>
                          <option value="1" <?if($this->input->get('s')=='1'){echo "selected";}?>>Ko'rib chiqilgan</option>
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
                  <h4 class="card-title">Aloqa xatlari</h4>
                  <div class="row">
                  <?
                    $limit = 21;
                    if ($this->input->get('page') != '') {
                      $from = $this->input->get('page');
                      if($from != 0){
                        $from = ($from-1) * $limit;
                      }
                    }else{$from = 0;}

                    if ($this->input->get('q') != '') {
                      $this->db->like('name', $this->input->get('q'));
                      $this->db->or_like('subject', $this->input->get('q'));
                      $this->db->or_like('email', $this->input->get('q'));
                      $this->db->or_like('message', $this->input->get('q'));
                    }

                    if ($this->input->get('b') != '') {
                      $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
                    }

                    if ($this->input->get('e') != '') {
                      $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
                    }

                    if ($this->input->get('s') != '') {
                      $this->db->where('status', $this->input->get('s'));
                    }

                    $this->db->order_by('date', 'desc');
                    
                    $this->db->limit($limit, $from);

                    $contacts = $this->db->get('contacts');
                    
                    if ($contacts->num_rows() > 0) {
                      foreach ($contacts->result_array() as $contact) {
                        echo '<div class="col-md-6 col-sm-6 col-lg-4">';
                        $this->load->view('manage/contacts/single', array('contact' => $contact));
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
              $this->db->or_like('subject', $this->input->get('q'));
              $this->db->or_like('email', $this->input->get('q'));
              $this->db->or_like('message', $this->input->get('q'));
            }

            if ($this->input->get('b') != '') {
              $this->db->where('date >=', strtotime($this->input->get('b').' 00:00:00'));
            }

            if ($this->input->get('e') != '') {
              $this->db->where('date <=', strtotime($this->input->get('e').' 23:59:59'));
            }

            if ($this->input->get('s') != '') {
              $this->db->where('status', $this->input->get('s'));
            }
            
            $allcount = $this->db->count_all_results('contacts');
            $queries = $this->input->get(); unset($queries['page']);

            if (count($queries) > 0) {
              $config['base_url'] = base_url('manage/contacts?'.http_build_query($queries));
            }else{
              $config['base_url'] = base_url('manage/contacts');
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