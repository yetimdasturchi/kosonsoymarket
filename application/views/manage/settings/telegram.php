<?
    $template = @file_get_contents('./public/data/telegram_template.txt');
    if ($template === FALSE) {
      $template = '';
    }

    $bot = json_decode(setting_item('bot_settings'), true);
    if (is_array($bot)) {
      if (array_key_exists('token', $bot['bot'])) {
        $bot_token = $bot['bot']['token'];
      }else{
        $bot_token = '';
      }
      if (array_key_exists('username', $bot['bot'])) {
        $bot_username = $bot['bot']['username'];
      }else{
        $bot_username = '';
      }
    }
?>
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
                  <h4 class="card-title">Telegram sozlamalari</h4>
                  <div class="tab-minimal tab-minimal-success">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab-bots" data-toggle="tab" href="#bots" role="tab" aria-controls="bots" aria-selected="true"><i class="icon-grid"></i>Botlar</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab-template" data-toggle="tab" href="#template" role="tab" aria-controls="template" aria-selected="false"><i class="icon-layers"></i>Andoza</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab-tags" data-toggle="tab" href="#template_tags" role="tab" aria-controls="template_tags" aria-selected="false"><i class="icon-puzzle"></i>Kalitlari</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-content-solid">
                      <div class="tab-pane fade show active" id="bots" role="tabpanel" aria-labelledby="tab-bots">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/telegram/bot_settings" autocomplete="off">
                          <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="bot_token">Bot tokeni</label>
                              <input type="text" class="form-control" id="bot_token" name="bot[token]" placeholder="Bot tokeni..." required="" value="<?=$bot_token;?>">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <label for="bot_username">Bot idenfikatori</label>
                              <input type="text" class="form-control" id="bot_username" name="bot[username]" placeholder="Bot idenfikatori..." required="" value="<?=$bot_username;?>">
                            </div>
                          </div>
                          <hr />
                          <p class="card-description">
                            Kanallar:
                          </p>
                          <div class="row mt-2 channels">
                            <?
                              if (count($bot['channels']) > 0) {
                                $count=0;
                                foreach ($bot['channels'] as $key => $value) {
                            ?>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white"><i class="fa fa-user" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control" name="channels[name][]" placeholder="Nomi..." value="<?=$value['name'];?>" required="">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white font-weight-bold" style="font-size: 1rem;">@</span>                            
                                </div>
                                <input type="text" class="form-control" name="channels[username][]" placeholder="Idenfikator..." value="<?=$value['username'];?>" required="">
                                <?
                                  if ($count > 0) {
                                ?>
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-danger text-white remove-channel"><i class="fa fa-times" style="margin-right: unset;"></i></span>
                                </div>
                                <?    
                                  }
                                ?>
                              </div>
                            </div>
                            <?    
                                $count++;
                                }
                              }else{
                            ?>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white"><i class="fa fa-user" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control" name="channels[name][]" placeholder="Nomi..." required="">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white font-weight-bold" style="font-size: 1rem;">@</span>                            
                                </div>
                                <input type="text" class="form-control" name="channels[username][]" placeholder="Idenfikator..." required="">
                              </div>
                            </div>
                            <?
                              }
                            ?>
                          </div>
                          <div class="row mt-2">
                          <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">
                            <button type="button" class="btn btn-light mr-2 md-2 col-12 add-channel">Kanal qo'shish</button>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">
                            <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="tab-template">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/telegram/telegram_template" autocomplete="off">
                          <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <textarea class="form-control" id="template_data" rows="20" name="telegram_template" placeholder="Andoza..." required=""><?=$template;?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                              <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="template_tags" role="tabpanel" aria-labelledby="tab-tags">
                        <div>
                          <ul class="list-arrow">
                            <li><b>Teglar:</b> <code>{tags}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">#reklama #telefon #sotiladi</span></p>
                            <li><b>Sarlavha:</b> <code>{title}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">GALAXY A50 2019 sotiladi</span></p>
                            <li><b>Narxi:</b> <code>{price}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">440 000 so‘m (Kelishilgan)</span></p>
                            <li><b>Foydalanuvchi:</b> <code>{onwer_name}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">Eshmatov Toshmat</span></p>
                            <li><b>Telefon raqam:</b> <code>{onwer_phone}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">+998(99)999-99-99</span></p>
                            <li><b>Pochta (Telegram yoki email):</b> <code>{onwer_email}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">@username, mail@example.com</span></p>
                            <li><b>Filtrlar:</b> <code>{filters=belgi}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">> Quvvat:  1 kun, > Xotira: 64 GB</span></p>
                            <li><b>Manzil:</b> <code>{address}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">Namangan, Kosonsoy</span></p>
                            <li><b>E'lon raqami:</b> <code>{id}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">001/KivD</span></p>
                            <li><b>Joylandi:</b> <code>{date}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">01 Yan 2019 | 00:00</span></p>
                            <li><b>Bo'lim:</b> <code>{category}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">Mobil qurilmalar</span></p>
                            <li><b>Batafsil:</b> <code>{url}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">{base_url}001/KivD</span></p>
                            <li><b>Sayt nomi:</b> <code>{site_name}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger text-capitalize">{base_host}</span></p>
                            <li><b>Sayt manzili:</b> <code>{site_url}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">{base_url}</span></p>
                            <li><b>Kanal idenfikatori:</b> <code>{channel_username}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">@Kosonsoymarket</span></p>
                            <li><b>Kanal nomi:</b> <code>{channel_name}</code></li>
                            <p class="text-white bg-dark pl-1">Misol: <span class="text-danger">Kosonsoymarket reklama</span></p>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
              $(document).on('click', ".add-channel", function(el) {
                var html = '<div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">\
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">\
                                <div class="input-group-prepend">\
                                  <span class="input-group-text bg-dark text-white"><i class="fa fa-user" style="margin-right: unset;"></i></span>\
                                </div>\
                                <input type="text" class="form-control" name="channels[name][]" placeholder="Nomi..." required="">\
                              </div>\
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">\
                                <div class="input-group-prepend">\
                                  <span class="input-group-text bg-dark text-white font-weight-bold" style="font-size: 1rem;">@</span>\
                                </div>\
                                <input type="text" class="form-control" name="channels[username][]" placeholder="Idenfikator..." required="">\
                                <div class="input-group-prepend">\
                                  <span class="input-group-text bg-danger text-white remove-channel"><i class="fa fa-times" style="margin-right: unset;"></i></span>\
                                </div>\
                              </div>\
                            </div>';
                $('.channels .channel-item:last').after(html);
              });
              $(document).on('click', ".remove-channel", function(el) {
                $(this).parent().parent().parent().remove();
              });
            });
          </script>