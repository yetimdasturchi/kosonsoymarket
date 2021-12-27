 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
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
                  <h4 class="card-title">Xabar qo'shish</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/news/insert" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="title">Sarlavha</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Xabar sarlavhasi..." required="">
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="status">Til</label>
                        <select class="js-example-basic-single language-select" name="language" id="language" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                            $languages = $this->config->item('languages_list');
                            foreach ($languages as $key => $value) {
                              echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="status">Rukn</label>
                        <select class="js-example-basic-single category-select" name="category" id="category" style="width:100%" required="">
                          <option value="">Tanlash</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-4">
                        <label>Rasm</label>
                        <input type="file" name="photo" class="file-upload-default" accept="image/*" required="">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Yuklash">
                          <div class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Tanlash</button>                          
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Matn</label>
                      <textarea class="quil-fake-data" name="content" style="display: none;"></textarea>
                      <div class="quill-container quill-editor">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kiritish</button>
                    <a href="{base_url}manage/news/list"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) { 
      <?
        $categories = $this->db->order_by('language', 'asc')->get('news_category');
        echo 'var json = '.json_encode($categories->result_array()).';';
      ?>
      $(document).on('change', ".language-select", function(el) {
        var categories = [];
        var as=$(json).filter(function (i,n){return n.language === $(el.target).val()});
        $.each( as, function( k, v ) {
          item = {}
          item["id"] = v.category_id;
          item["text"] = v.category_name;
          categories.push(item);
        });
        $('.category-select').select2('destroy').empty().select2({data: categories});
      });
    });
  </script>