<?
  $languages = $this->config->item('languages_list');
  $filter_name = json_decode($item['filter_name'], true);
  $content = json_decode($item['content'], true);
  $category = $this->Model_core->categories($item['category_id']);
  if ($category->num_rows() > 0) {
    $category = $category->row_array();
    $category = json_decode($category['name'], true);
    $category = $category[setting_item('default_language')];
  }else{
    $category = "Aniqlanmagan";
  }

    if ($item['options'] != '') {
      $options = array();
    $set = preg_split("/(\r\n|\n|\r)/", $item['options']);
    foreach ($set as $set_row) {
      $set_row = explode('|', $set_row);
      $options[$set_row[0]] = $set_row[1];
    }
    }else{
      $options = array();
    }
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
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/sections/filters_update/<?=$item['filter_id'];?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="parent_id">Asosiy rukn</label>
                        <select class="js-example-basic-single" name="category_id" id="category_id" style="width:100%" required="">
                          <option value="0">Tanlash</option>
                          <?
                            $categories = $this->db->order_by('category_id', 'asc')->get_where('categories');
                            foreach ($categories->result_array() as $category) {
                              $category_name = json_decode($category['name'], true);
                              if ($item['category_id']==$category['category_id']) {
                                echo '<option value="'.$category['category_id'].'" selected>'.$category_name[setting_item('default_language')].'</option>';
                              }else{
                                echo '<option value="'.$category['category_id'].'">'.$category_name[setting_item('default_language')].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="sort">Tartib</label>
                        <div class="input-group">
                          <input type="number" min="0" name="sort" class="form-control" placeholder="Tartib" aria-label="tartib" aria-describedby="sort" value="<?=$item['sort'];?>" required="">
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
                          <option value="min" <?if ($item['action'] == 'min') {echo "selected";}?>>Minimal</option>
                          <option value="max" <?if ($item['action'] == 'max') {echo "selected";}?>>Maksimal</option>
                          <option value="equal" <?if ($item['action'] == 'equal') {echo "selected";}?>>Teng</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="type">Turi</label>
                        <select class="js-example-basic-single type-select" name="type" id="type" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="input" <?if ($item['type'] == 'input') {echo "selected";}?>>Kirituvchi</option>
                          <option value="select" <?if ($item['type'] == 'select') {echo "selected";}?>>Tanlovchi</option>
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
                            <input type="text" min="0" class="form-control" id="filter_name_<?=$key;?>" name="filter_name[<?=$key;?>]" placeholder="<?=$value;?>..." value="<?=$filter_name[$key];?>" required="">
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
                            if (is_array($content)) {
                              if (array_key_exists($key, $content)) {
                                $content_value = array();
                                foreach ($content[$key] as $row) {
                                  $content_value[] =  $row['label'].'|'.$row['value'];
                                }
                                $content_value = implode(PHP_EOL, $content_value);
                              }else{
                                $content_value = '';
                              }
                            }else{
                              $content_value = '';
                            }
                        ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="content_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <textarea class="form-control" id="content_<?=$key;?>" rows="5" name="content[<?=$key;?>]" placeholder="<?=$value;?>..."><?=$content_value;?></textarea>
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
                            <option value="text" <?if(filter_options($item['options'], 'type') == 'text') {echo "selected";}?>>Matn</option>
                            <option value="number" <?if(filter_options($item['options'], 'type') == 'number') {echo "selected";}?>>Raqam</option>
                            <option value="date" <?if(filter_options($item['options'], 'type') == 'date') {echo "selected";}?>>Sana</option>
                            <option value="time" <?if(filter_options($item['options'], 'type') == 'time') {echo "selected";}?>>Vaqt</option>
                            <option value="datetime" <?if(filter_options($item['options'], 'type') == 'datetime') {echo "selected";}?>>Sana va vaqt</option>
                            <option value="month" <?if(filter_options($item['options'], 'type') == 'month') {echo "selected";}?>>Oylar</option>
                            <option value="week" <?if(filter_options($item['options'], 'type') == 'week') {echo "selected";}?>>Hafta</option>
                            <option value="tel" <?if(filter_options($item['options'], 'type') == 'tel') {echo "selected";}?>>Telefon raqam</option>
                            <option value="url" <?if(filter_options($item['options'], 'type') == 'url') {echo "selected";}?>>Veb manzil</option>
                            <option value="email" <?if(filter_options($item['options'], 'type') == 'email') {echo "selected";}?>>Email</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_value">Standart yozuv</label>
                          <input type="text" class="form-control" id="options_value" name="options[value]" placeholder="" value="<?=filter_options($item['options'], 'value');?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_minlength">Minimal uzunlik</label>
                          <input type="number" min="0" class="form-control" id="options_minlength" name="options[minlength]" placeholder="" value="<?=filter_options($item['options'], 'minlength');?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_maxlength">Maksimal uzunlik</label>
                          <input type="number" min="0" class="form-control" id="options_maxlength" name="options[maxlength]" placeholder="" value="<?=filter_options($item['options'], 'maxlength');?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_required">Majburiy</label>
                          <select class="form-control" name="options[required]" id="options_required" style="width:100%">
                            <option value="">Tanlash</option>
                            <option value="null" <?if(filter_options($item['options'], 'required') == 'null') {echo "selected";}?>>Yo'q</option>
                            <option value="required" <?if(filter_options($item['options'], 'required') == 'required') {echo "selected";}?>>Ha</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_readonly">Faqat o'qish uchun</label>
                          <select class="form-control" name="options[readonly]" id="options_readonly" style="width:100%">
                            <option value="">Tanlash</option>
                            <option value="null" <?if(filter_options($item['options'], 'readonly') == 'null') {echo "selected";}?>>Yo'q</option>
                            <option value="readonly" <?if(filter_options($item['options'], 'readonly') == 'readonly') {echo "selected";}?>>Ha</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_min">Minimal son (Raqam kiritish turi uchun)</label>
                          <input type="number" min="0" class="form-control" id="options_min" name="options[min]" placeholder="" value="<?=filter_options($item['options'], 'min');?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-lg-3">
                          <label for="options_max">Maksimal son (Raqam kiritish turi uchun)</label>
                          <input type="number" min="0" class="form-control" id="options_max" name="options[max]" placeholder="" value="<?=filter_options($item['options'], 'max');?>">
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
          $('.options-data').html($('.input-options').html());
          $('.options').show();
        }else{
          $('.option-content').hide();
          $('.options-data input, .options-data select').val('');
          $('.options-data').empty();
        }
      });

      <?
        if ($item['type'] == 'input') {
      ?>
          
          $('.option-content').hide();
          $('.options-data').html($('.input-options').html());
          $('.option-content textarea').val('');
          $('.options').show();
          
      <?
        }
      ?>
      <?
        if ($item['type'] == 'select') {
      ?>
          
          $('.option-content').show();
          $('.options-data input, .options-data select').val('');
          $('.options-data').empty();

      <?
        }
      ?>
    });
  </script>