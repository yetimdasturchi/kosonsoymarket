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
                  <h4 class="card-title">E'lon qo'shish</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/ads/insert" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-4 col-sm-12 col-lg-4">
                        <label for="title">Sarlavha</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="E'lon sarlavhasi..." required="">
                      </div>
                      <div class="form-group col-md-4 col-sm-6 col-lg-4">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <option value="3" <?if($this->input->get('s')=='3'){echo 'selected';}?>>Sotilgan</option>
                          <option value="2" <?if($this->input->get('s')=='2'){echo 'selected';}?>>Aktivlangan</option>
                          <option value="1" <?if($this->input->get('s')=='1'){echo 'selected';}?>>Jarayonda</option>
                          <option value="0" <?if($this->input->get('s')=='0'){echo 'selected';}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-6 col-lg-4">
                        <label for="category">Rukn</label>
                        <select class="js-example-basic-single category-select" name="category" id="category" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                              $categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
                              if ($categories->num_rows() > 0) {
                                 $categories = $categories->result_array();
                                 foreach ($categories as $category) {
                                    $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                                    $category['name'] = json_decode($category['name'], true);
                                    if ($subcategories->num_rows() > 0) {
                                       $subcategories = $subcategories->result_array();
                                       echo '<option value="'.$category['category_id'].'">'.$category['name'][setting_item('default_language')].'</option>';
                                       echo '<optgroup>';
                                       foreach ($subcategories as $subcategory) {
                                          $subcategory['name'] = json_decode($subcategory['name'], true);
                                          echo '<option value="'.$subcategory['category_id'].'">- '.$subcategory['name'][setting_item('default_language')].'</option>';
                                       }
                                       echo "</optgroup>";
                                    }else{
                                       echo '<option value="'.$category['category_id'].'">'.$category['name'][setting_item('default_language')].'</option>';
                                    }
                                 }
                              }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="filters-content" style="display: none;">
                      <hr>
                      <p class="card-description">
                        Filtrlar
                      </p>
                      <div class="filters row">

                        
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-4">
                        <label for="price">Narx</label>
                        <input type="number" min="0" class="form-control" id="price" name="price" placeholder="Narx...">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="currency">Valyuta</label>
                        <select class="js-example-basic-single" name="currency" id="currency" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="sum">So'm</option>
                          <option value="usd">$</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="covenant">Kelishuv</label>
                        <select class="js-example-basic-single" name="covenant" id="covenant" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="0">Odatiy</option>
                          <option value="1">Kelishilgan</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="exampleTextarea1">Matn</label>
                        <textarea class="quil-fake-data" name="content" style="display: none;"></textarea>
                        <div class="quill-container quill-editor">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label>Rasmlar</label>
                        <input type="file" name="images[]" class="file-upload-default" accept="image/*" required="" multiple="">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Yuklash">
                          <div class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Tanlash</button>                          
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="pricing">Narxnoma</label>
                        <select class="js-example-basic-single" name="pricing_id" id="pricing" style="width:100%" required="">
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
                                echo '<option value="'.$row['price_id'].'">'.$pricing_name.' ('.number_format($row['price']).')</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position">Joylashuv</label>
                        <select class="js-example-basic-single" name="position" id="position" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="default">Odatiy</option>
                          <option value="featured">Turbo</option>
                          <option value="main">Premium</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_period_date">Joylashuv amal qilish sanasi</label>
                        <input type="date" name="position_period_date" class="form-control" id="position_period_date" placeholder="To'liq ism..." required="" value="<?=date("Y-m-d");?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_period_time">Joylashuv amal qilish vaqti</label>
                        <input type="time" name="position_period_time" class="form-control" id="position_period_time" placeholder="To'liq ism..." required="" value="<?=date("H:i:s");?>">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_name">Ism</label>
                        <input type="text" class="form-control" id="onwer_name" name="onwer_name" placeholder="Ism..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_phone">Telefon raqam</label>
                        <input type="tel" class="form-control" id="onwer_phone" name="onwer_phone" placeholder="Telefon raqam..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_email">Email yoki telegram</label>
                        <input type="text" class="form-control" id="onwer_email" name="onwer_email" placeholder="Email yoki telegram...">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_address">Manzil</label>
                        <input type="text" class="form-control" id="onwer_address" name="onwer_address" placeholder="Manzil..." required="">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kiritish</button>
                    <a href="{base_url}manage/ads/list"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) { 
      $(document).on('change', ".category-select", function(el) {
        $.get( '{base_url}manage/ads/filters/'+$(el.target).val() , function(html) {
          console.log(html.length)
          if (html !== "error") {
            if (html.length > 2){
              $('.filters-content').show();
              $('.filters-content .filters').html(html);
              if($(".filters-content .filters .js-example-basic-single").length){
                $(".filters-content .filters .js-example-basic-single").select2({placeholder: "Tanlash"});
              }
            }else{
              $('.filters-content').hide();
              $('.filters-content .filters').empty();
            }
          }else{
            $('.filters-content').hide();
            $('.filters-content .filters').empty();
          }
        });
      });
    });
  </script>