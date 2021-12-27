<form class="forms-sample" method="post" action="{base_url}manage/ads/status/<?=$item['post_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <option value="3" <?if($item['status']=='3'){echo 'selected';}?>>Sotilgan</option>
                          <option value="2" <?if($item['status']=='2'){echo 'selected';}?>>Aktivlangan</option>
                          <option value="1" <?if($item['status']=='1'){echo 'selected';}?>>Jarayonda</option>
                          <option value="0" <?if($item['status']=='0'){echo 'selected';}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Saqlash</button>
                  </form>