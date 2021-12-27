<form class="forms-sample" method="post" action="{base_url}manage/ads/pricing/<?=$item['post_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
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
                                if ($item['pricing_id']==$row['price_id']) {
                                  echo '<option value="'.$row['price_id'].'" selected>'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }else{
                                 echo '<option value="'.$row['price_id'].'">'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Saqlash</button>
                  </form>