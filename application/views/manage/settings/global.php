<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12">
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
            </div>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Umumiy sozlamalar</h4>
                  <div class="tab-minimal tab-minimal-success">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab-site-tab" data-toggle="tab" href="#site_tab" role="tab" aria-controls="site-tab" aria-selected="false"><i class="icon-globe"></i>Sayt</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab-contact-tab" data-toggle="tab" href="#contact_tab" role="tab" aria-controls="contact_tab" aria-selected="true"><i class="icon-phone"></i>Aloqa</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-content-solid">
                      <div class="tab-pane fade show active" id="site_tab" role="tabpanel" aria-labelledby="tab-site-tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/global_site" autocomplete="off">
                          <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="site_title">Sayt sarlavhasi</label>
                              <input type="text" class="form-control" id="site_title" name="site_title" placeholder="Sayt sarlavhasi..." required="" value="<?=setting_item('site_title');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="site_description">Sayt tasnifi</label>
                              <textarea class="form-control" id="site_description" name="site_description" rows="3" placeholder="Sayt tasnifi..."><?=setting_item('site_description');?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="site_keywords">Kalit so'zlar</label>
                              <input type="text" class="form-control tags" id="site_keywords" name="site_keywords" placeholder="Kalit so'zlar..." required="" value="<?=setting_item('site_keywords');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="parent_id">Sayt tili</label>
                              <select class="js-example-basic-single" name="default_language" id="default_language" style="width:100%" required="">
                                <option value="0">Tanlash</option>
                                <?
                                  $languages = $this->config->item('languages_list');
                                  foreach ($languages as $key => $value) {
                                    if ($key == setting_item('default_language')) {
                                      echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }else{
                                      echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="app_token">Mobil ilova tokeni</label>
                              <input type="text" class="form-control" id="app_token" name="app_token" placeholder="Sayt sarlavhasi..." readonly="" value="<?=setting_item('app_token');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                              <button type="submit" class="btn btn-success mr-2 col-12" onClick="return confirm('Ma\'lumot saqlansinmi?');">Saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="contact_tab" role="tabpanel" aria-labelledby="tab-contact-tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/global_contact" autocomplete="off">
                          <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="contact_address">Manzil</label>
                              <input type="text" class="form-control" id="contact_address" name="contact_address" placeholder="Manzil..." required="" value="<?=setting_item('contact_address');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="contact_number">Telefon raqam</label>
                              <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Telefon raqam..." required="" value="<?=setting_item('contact_number');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="contact_email">Email manzil</label>
                              <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Email manzil..." required="" value="<?=setting_item('contact_email');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="contact_telegram">Telegram manzil</label>
                              <input type="text" class="form-control" id="contact_telegram" name="contact_telegram" placeholder="Manzil..." required="" value="<?=setting_item('contact_telegram');?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <hr />
                              <p class="card-description">
                                Ijtimoiy tarmoqlar:
                              </p>
                            </div>
                            <?
                              $json = json_decode(setting_item('social_links'), true);
                            ?>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                              <div class="input-group alert alert-fill-dark" style="background-color: #fff;border-color: rgba(0, 0, 0, 0.1);margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-white" style="background-color: #2DA5E1;"><i class="fa fa-telegram" style="margin-right: unset;"></i></span>                                   
                                </div>
                                <input type="text" class="form-control" name="social_links[telegram]" placeholder="Telegram..." required="" value="<?=$json['telegram'];?>">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: #fff;border-color: rgba(0, 0, 0, 0.1);margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-white" style="background-color: #3b579d;"><i class="fa fa-facebook" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control" name="social_links[facebook]" placeholder="Facebook..." required="" value="<?=$json['facebook'];?>">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: #fff;border-color: rgba(0, 0, 0, 0.1);margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-white" style="background-color: #ea4c89;"><i class="fa fa-instagram" style="margin-right: unset;"></i></span>                                   
                                </div>
                                <input type="text" class="form-control" name="social_links[instagram]" placeholder="Instagram..." required="" value="<?=$json['instagram'];?>">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: #fff;border-color: rgba(0, 0, 0, 0.1);margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-white" style="background-color: #03a9f3;"><i class="fa fa-twitter" style="margin-right: unset;"></i></span>                                   
                                </div>
                                <input type="text" class="form-control" name="social_links[twitter]" placeholder="Twitter..." required="" value="<?=$json['twitter'];?>">
                              </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                              <button type="submit" class="btn btn-success mr-2 col-12" onClick="return confirm('Ma\'lumot saqlansinmi?');">Saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>