<form class="forms-sample" method="post" action="{base_url}manage/ads/telegram/<?=$item['post_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="channels">Kanallar</label>
                        <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="channels[]" id="channels" required="">
                          <option value="">Tanlash</option>
                          <?
                            $bot_settings = json_decode(setting_item('bot_settings'), true);
                            if (array_key_exists('channels', $bot_settings)) {
                              foreach ($bot_settings['channels'] as $channel) {
                                echo '<option value="'.$channel['username'].'">'.$channel['name'].'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="pinned">Biriktirish</label>
                        <select class="js-example-basic-single" name="pinned" id="pinned" style="width:100%" required="">
                          <option value="0">Yo'q</option>
                          <option value="1">Ha</option>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Yuborish</button>
                  </form>