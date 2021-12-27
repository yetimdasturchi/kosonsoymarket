<form class="forms-sample" method="post" action="{base_url}manage/ads/position/<?=$item['post_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="position">Joylashuv</label>
                        <select class="js-example-basic-single" name="position" id="position" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="default" <?if($item['position']=='default'){echo 'selected';}?>>Odatiy</option>
                          <option value="featured" <?if($item['position']=='featured'){echo 'selected';}?>>Turbo</option>
                          <option value="main" <?if($item['position']=='main'){echo 'selected';}?>>Premium</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="position_period_date">Joylashuv amal qilish sanasi</label>
                        <input type="date" name="position_period_date" class="form-control" id="position_period_date" placeholder="To'liq ism..." required="" value="<?=date("Y-m-d", strtotime($item['position_period']));?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="position_period_time">Joylashuv amal qilish vaqti</label>
                        <input type="time" name="position_period_time" class="form-control" id="position_period_time" placeholder="To'liq ism..." required="" value="<?=date("H:i:s", strtotime($item['position_period']));?>">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Saqlash</button>
                  </form>