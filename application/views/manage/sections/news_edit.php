<form class="forms-sample" method="post" action="{base_url}manage/sections/news_update/<?=$item['category_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="category_name">Nomi</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Nomi..." value="<?=$item['category_name'];?>" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="language">Til</label>
                        <select class="js-example-basic-single" name="language" id="language" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                            $languages = $this->config->item('languages_list');
                            foreach ($languages as $key => $value) {
                              if ($item['language'] == $key) {
                                echo '<option value="'.$key.'" selected>'.$value.'</option>';
                              }else{
                                echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-6">
                        <label for="meta_title">Meta sarlavha</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title" value="<?=$item['meta_title'];?>" placeholder="Meta sarlavha..." required="">
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-6">
                        <label for="meta_description">Meta tasnif</label>
                        <input type="text" name="meta_description" class="form-control" value="<?=$item['meta_description'];?>" id="meta_description" placeholder="Meta tasnif..." required="">
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="meta_keyword">Meta kalit so'zlar</label>
                        <input type="text" name="meta_keyword" class="form-control tags" value="<?=$item['meta_keyword'];?>" id="meta_keyword" placeholder="Meta kalit so'zlar..." required="">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Saqlash</button>
                    <a href="#" rel="modal:close"><button type="button" class="btn btn-light">Bekor qilish</button></a>
                  </form>