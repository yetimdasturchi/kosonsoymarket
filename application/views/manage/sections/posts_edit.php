 <?
  $languages = $this->config->item('languages_list');
  $name = json_decode($item['name'], true);
  $title = json_decode($item['title'], true);
  $keywords = json_decode($item['keywords'], true);
  $description = json_decode($item['description'], true);
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
                  <h4 class="card-title">E'lon rukni qo'shish</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/sections/posts_update/<?=$item['category_id'];?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="parent_id">Asosiy rukn</label>
                        <select class="js-example-basic-single" name="parent_id" id="parent_id" style="width:100%">
                          <option value="0">Tanlash</option>
                          <?
                            $categories = $this->db->order_by('category_id', 'asc')->get_where('categories', array('parent_id' => 0));
                            foreach ($categories->result_array() as $category) {
                              $category_name = json_decode($category['name'], true);
                              if ($item['parent_id']==$category['category_id']) {
                                echo '<option value="'.$category['category_id'].'" selected>'.$category_name[setting_item('default_language')].'</option>';
                              }else{
                                echo '<option value="'.$category['category_id'].'">'.$category_name[setting_item('default_language')].'</option>';
                              }
                             
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control slugify" id="slug" name="slug" value="<?=$item['slug'];?>" placeholder="Slug..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="icon">Belgi</label>
                        <div class="input-group">
                          <input type="text" class="form-control cat-icon" id="icon" value="<?=$item['icon'];?>" name="icon" placeholder="Belgi..." required="" readonly="">
                          <span class="input-group-append">
                            <button class="btn btn-outline-secondary" data-input=".cat-icon" data-icon="<?=$item['icon'];?>" role="iconpicker" data-iconset="flaticon" data-label-header="{0} - {1} sahifalar" data-label-footer="{2} dan {0} - {1} belgilar" data-search-text="Izlash..." data-arrow-prev-icon-class="fa fa-angle-left" data-arrow-next-icon-class="fa fa-angle-right" data-arrow-class="btn-success"></button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="1" <?if ($item['status']==1) {echo "selected";}?>>Aktivlangan</option>
                          <option value="0" <?if ($item['status']==0) {echo "selected";}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                    </div>
                    <hr />
                    <p class="card-description">
                        Nomi:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                          if (array_key_exists($key, $name)) {$default_value = $name[$key];}else{$default_value = '';}
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="name_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" min="0" class="form-control" id="name_<?=$key;?>" name="name[<?=$key;?>]" placeholder="<?=$value;?>..." required="" value="<?=$default_value;?>">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <p class="card-description">
                        Sarlavha:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                          if (array_key_exists($key, $title)) {$default_value = $title[$key];}else{$default_value = '';}
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="title_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" min="0" class="form-control" id="title_<?=$key;?>" name="title[<?=$key;?>]" placeholder="<?=$value;?>..." required="" value="<?=$default_value;?>">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <p class="card-description">
                        Meta kalit so'zlar:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                          if (array_key_exists($key, $keywords)) {$default_value = $keywords[$key];}else{$default_value = '';}
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="meta_keyword_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" id="meta_keyword_<?=$key;?>" name="keywords[<?=$key;?>]" class="form-control tags" placeholder="<?=$value;?>..." required="" value="<?=$default_value;?>">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <p class="card-description">
                        Meta tasnif:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                          if (array_key_exists($key, $description)) {$default_value = $description[$key];}else{$default_value = '';}
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="meta_description_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <textarea class="form-control" id="meta_description_<?=$key;?>" rows="3" name="description[<?=$key;?>]" placeholder="<?=$value;?>..." required=""><?=$default_value;?></textarea>
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-success mr-2">Saqlash</button>
                    <a href="{base_url}manage/sections/posts"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>