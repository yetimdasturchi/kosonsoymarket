<form class="forms-sample" method="post" action="{base_url}manage/users/update/<?=$item['user_id']?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="password">Yangi parol</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Parol...">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="fullname">To'liq ism</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="To'liq ism..." required="" value="<?=$item['fullname']?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="permissions">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="1" <?if($item['status']==1){echo'selected';}?>>Aktivlangan</option>
                          <option value="0" <?if($item['status']==0){echo'selected';}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="status">Huquqlar</label>
                        <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="permissions[]" id="permissions" required="">
                          <option value="">Tanlash</option>
                          <?
                            $permissions_data = $this->config->item('user_permissions');
                            $user_permissions = json_decode($item['permissions']);
                            foreach ($permissions_data as $key => $value) {
                              if(in_array($key, $user_permissions)){
                                echo '<option value="'.$key.'" selected>'.$value.'</option>';
                              }else{
                                echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Saqlash</button>
                  </form>