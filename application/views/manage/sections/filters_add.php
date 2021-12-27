 <?
  $languages = $this->config->item('languages_list');
 ?>
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
                  <h4 class="card-title">Filtr qo'shish</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/sections/filters_insert" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="parent_id">Asosiy rukn</label>
                        <select class="js-example-basic-single" name="category_id" id="category_id" style="width:100%" required="">
                          <option value="0">Tanlash</option>
                          <?
                            $categories = $this->db->order_by('category_id', 'asc')->get_where('categories');
                            foreach ($categories->result_array() as $category) {
                              $category_name = json_decode($category['name'], true);
                              echo '<option value="'.$category['category_id'].'">'.$category_name[setting_item('default_language')].'</option>';
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="sort">Tartib</label>
                        <div class="input-group">
                          <input type="number" min="0" name="sort" class="form-control" placeholder="Tartib" aria-label="tartib" aria-describedby="sort" value="0" required="">
                          <div class="input-group-append">
                            <span class="input-group-text bg-dark border-dark pointer math-minus" data-input="[type='number']"><i class="fa fa-minus text-white"></i></span>                            
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text bg-dark border-dark pointer math-plus" data-input="[type='number']"><i class="fa fa-plus text-white"></i></span>                            
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="action">Xususiyat</label>
                        <select class="js-example-basic-single" name="action" id="action" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="min">Minimal</option>
                          <option value="max">Maksimal</option>
                          <option value="equal">Teng</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="type">Turi</label>
                        <select class="js-example-basic-single type-select" name="type" id="type" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="input">Kirituvchi</option>
                          <option value="select">Tanlovchi</option>
                        </select>
                      </div>
                    </div>
                    <hr />
                    <div class="options" style="display: none;">
                      <p class="card-description">
                        Sozlamalar (Keraksiz maydonlar bo'sh qoldirilsin):
                      </p>
                      <div class="row options-data">
                      </div>
                      <hr />
                    </div>
                    <p class="card-description">
                        Nomi:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="filter_name_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" min="0" class="form-control" id="filter_name_<?=$key;?>" name="filter_name[<?=$key;?>]" placeholder="<?=$value;?>..." required="">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <div class="option-content" style="display: none;">
                      <hr />
                      <p class="card-description">
                        Tarkib (Har bir qator yangi punktni belgilaydi va punktlar tarkibini <code>|</code> belgisi orqali ajrating):<br /><br />

                        Misol: <code>Nomi|qiymati</code>
                      </p>
                      <div class="row">
                        <?
                          foreach ($languages as $key => $value) {
                        ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="content_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <textarea class="form-control" id="content_<?=$key;?>" rows="5" name="content[<?=$key;?>]" placeholder="<?=$value;?>..."></textarea>
                          </div>
                        <?
                          }
                        ?>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kiritish</button>
                    <a href="{base_url}manage/sections/filters"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>

  <div class="input-options" style="display:none;">
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_type">Turi</label>
                          <select class="form-control" name="options[type]" id="options_type" style="width:100%">
                            <option value="">Tanlash</option>
                            <option value="text">Matn</option>
                            <option value="number">Raqam</option>
                            <option value="date">Sana</option>
                            <option value="time">Vaqt</option>
                            <option value="datetime">Sana va vaqt</option>
                            <option value="month">Oylar</option>
                            <option value="week">Hafta</option>
                            <option value="tel">Telefon raqam</option>
                            <option value="url">Veb manzil</option>
                            <option value="email">Email</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_value">Standart yozuv</label>
                          <input type="text" class="form-control" id="options_value" name="options[value]" placeholder="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_minlength">Minimal uzunlik</label>
                          <input type="number" min="0" class="form-control" id="options_minlength" name="options[minlength]" placeholder="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_maxlength">Maksimal uzunlik</label>
                          <input type="number" min="0" class="form-control" id="options_maxlength" name="options[maxlength]" placeholder="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_required">Majburiy</label>
                          <select class="form-control" name="options[required]" id="options_required" style="width:100%">
                            <option value="">Tanlash</option>
                            <option value="null">Yo'q</option>
                            <option value="required">Ha</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_readonly">Faqat o'qish uchun</label>
                          <select class="form-control" name="options[readonly]" id="options_readonly" style="width:100%">
                            <option value="">Tanlash</option>
                            <option value="null">Yo'q</option>
                            <option value="readonly">Ha</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_min">Minimal son (Raqam kiritish turi uchun)</label>
                          <input type="number" min="0" class="form-control" id="options_min" name="options[min]" placeholder="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_max">Maksimal son (Raqam kiritish turi uchun)</label>
                          <input type="number" min="0" class="form-control" id="options_max" name="options[max]" placeholder="">
                        </div>
                      </div>

  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) { 
      $(document).on('change', ".type-select", function(el) {
        var $this = $(this);
        $('.options').hide();
        if ($this.val() == 'select') {
          $('.option-content').show();
          $('.options-data input, .options-data select').val('');
          $('.options-data').empty();
        }else if ($this.val() == 'input') {
          $('.option-content').hide();
          $('.option-content textarea').val('');
          $('.options-data').html($('.input-options').html());
          $('.options').show();
        }else{
          $('.option-content').hide();
          $('.options-data input, .options-data select').val('');
          $('.options-data').empty();
          $('.option-content textarea').val('');
        }
      });
    });
  </script>