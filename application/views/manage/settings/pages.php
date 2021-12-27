<?
$languages = $this->config->item('languages_list');
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
                  <h4 class="card-title">Sahifalar</h4>
                  <div class="tab-minimal tab-minimal-success">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab_rules_tab" data-toggle="tab" href="#rules_tab" role="tab" aria-controls="tab_rules_tab" aria-selected="false"><i class="icon-notebook"></i>Qoidalari</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab_faq_tab" data-toggle="tab" href="#faq_tab" role="tab" aria-controls="faq_tab" aria-selected="true"><i class="icon-map"></i>Yordam</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab_about_tab" data-toggle="tab" href="#about_tab" role="tab" aria-controls="about_tab" aria-selected="true"><i class="icon-info"></i>Biz haqimizda</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab_how_it_work_tab" data-toggle="tab" href="#how_it_work_tab" role="tab" aria-controls="how_it_work_tab" aria-selected="true"><i class="icon-puzzle"></i>Bu qanday ishlaydi</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-content-solid">
                      <div class="tab-pane fade show active" id="rules_tab" role="tabpanel" aria-labelledby="tab_rules_tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/pages_rules" autocomplete="off">
                            <p class="card-description">
                              Qoidalar (Har bir qator yangi punktni belgilaydi):
                            </p>
                            <div class="row">
                            <?
                              $rules = json_decode(setting_item('rules'), true);
                              foreach ($languages as $key => $value) {
                                $default_value = '';
                                if (array_key_exists($key, $rules)) {
                                  foreach ($rules[$key] as $content_value) {
                                    $default_value .= $content_value.PHP_EOL.PHP_EOL;
                                  }
                                }
                            ?>
                                <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                  <label for="rules_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <textarea class="form-control" id="rules_<?=$key;?>" rows="20" name="rules[<?=$key;?>]" placeholder="<?=$value;?>..." required=""><?=$default_value;?></textarea>
                                </div>
                            <?
                              }
                            ?>
                            </div>
                            <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="faq_tab" role="tabpanel" aria-labelledby="tab_faq_tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/pages_faq" autocomplete="off">
                            <p class="card-description">
                              Yordam (Har bir qator yangi punktni belgilaydi va punktlar tarkibini <code>|</code> belgisi orqali ajrating):<br /><br />

                              Misol: <code>Savol|Javob</code>
                            </p>
                            <div class="row">
                            <?
                              $faq = json_decode(setting_item('faq'), true);
                              foreach ($languages as $key => $value) {
                                if (is_array($faq)) {
                                  if (array_key_exists($key, $faq)) {
                                    $content_value = array();
                                    foreach ($faq[$key] as $row) {
                                      $content_value[] =  $row['question'].'|'.$row['content'];
                                    }
                                    $content_value = implode(PHP_EOL.PHP_EOL, $content_value);
                                  }else{
                                    $content_value = '';
                                  }
                                }else{
                                  $content_value = '';
                                }
                            ?>
                                <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                  <label for="faq_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <textarea class="form-control" id="faq_<?=$key;?>" rows="20" name="faq[<?=$key;?>]" placeholder="<?=$value;?>..." required=""><?=$content_value;?></textarea>
                                </div>
                            <?
                              }
                            ?>
                            </div>
                            <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="about_tab" role="tabpanel" aria-labelledby="tab_about_tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/pages_about" autocomplete="off">
                            <div class="row">
                              <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Biz haqimizda:
                              </p>
                              <?
                              $about_site = json_decode(setting_item('about_site'), true);
                              foreach ($languages as $key => $value) {
                                $default_value = '';
                                if (array_key_exists($key, $about_site)) {
                                  $default_value .= $about_site[$key];
                                }
                              ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="about_site_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <textarea class="quil-fake-data-about_site_<?=$key;?>" name="about_site[<?=$key;?>]" style="display: none;"><?=$default_value?></textarea>
                                  <div class="quill-container quill-editor-about_site_<?=$key;?>">
                                    <?=$default_value?>
                                  </div>
                                </div>
                              <?
                                }
                              ?>
                            </div>
                            <div class="row">
                              <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Reklama:
                              </p>
                              <?
                              $advertisement = json_decode(setting_item('advertisement'), true);
                              foreach ($languages as $key => $value) {
                                $advertisement_default_value = '';
                                if (array_key_exists($key, $advertisement)) {
                                  $advertisement_default_value .= $advertisement[$key];
                                }
                              ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="advertisement_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <textarea class="quil-fake-data-advertisement_<?=$key;?>" name="advertisement[<?=$key;?>]" style="display: none;"><?=$advertisement_default_value?></textarea>
                                  <div class="quill-container quill-editor-advertisement_<?=$key;?>">
                                    <?=$advertisement_default_value?>
                                  </div>
                                </div>
                              <?
                                }
                              ?>
                            </div>
                            <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Ilovalar:
                            </p>
                            <p class="card-description">
                              Har bir qator yangi punktni belgilaydi va punktlar tarkibini <code>|</code> belgisi orqali ajrating:<br /><br />

                              Misol: <code>Sarlavha|Matn</code>
                            </p>
                            <div class="row">
                            <?
                              $about_site_archive = json_decode(setting_item('about_site_archive'), true);
                              foreach ($languages as $key => $value) {
                                if (is_array($about_site_archive)) {
                                  if (array_key_exists($key, $about_site_archive)) {
                                    $content_value = array();
                                    foreach ($about_site_archive[$key] as $row) {
                                      $content_value[] =  $row['title'].'|'.$row['content'];
                                    }
                                    $content_value = implode(PHP_EOL.PHP_EOL, $content_value);
                                  }else{
                                    $content_value = '';
                                  }
                                }else{
                                  $content_value = '';
                                }
                            ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="about_site_archive_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <textarea class="form-control" id="about_site_archive_<?=$key;?>" rows="10" name="about_site_archive[<?=$key;?>]" placeholder="<?=$value;?>..." required=""><?=$content_value;?></textarea>
                                </div>
                            <?
                              }
                            ?>
                            </div>
                            <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="how_it_work_tab" role="tabpanel" aria-labelledby="tab_how_it_work_tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/pages_how_it_work" autocomplete="off">
                            <?
                              $how_it_work = json_decode(setting_item('how_it_work'), true);
                            ?>
                            <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Sarlavha:
                            </p>
                            <div class="row">
                            <?
                              foreach ($languages as $key => $value) {
                                if (array_key_exists($key, $how_it_work['title'])) {
                                  $title_value = $how_it_work['title'][$key];
                                }else{
                                  $title_value = '';
                                }
                            ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="how_it_work_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <input type="text" class="form-control" id="how_it_work_<?=$key;?>" name="how_it_work[title][<?=$key;?>]" placeholder="<?=$key;?>..." value="<?=$title_value?>" required="">
                                </div>
                            <?
                              }
                            ?>
                            </div>
                            <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Kichik sarlavha:
                            </p>
                            <div class="row">
                            <?
                              foreach ($languages as $key => $value) {
                                if (array_key_exists($key, $how_it_work['subtitle'])) {
                                  $title_value = $how_it_work['subtitle'][$key];
                                }else{
                                  $title_value = '';
                                }
                            ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="how_it_work_<?=$key;?>" class="text-primary"><?=$value;?></label>
                                  <input type="text" class="form-control" id="how_it_work_<?=$key;?>" name="how_it_work[subtitle][<?=$key;?>]" placeholder="<?=$key;?>..." value="<?=$title_value?>" required="">
                                </div>
                            <?
                              }
                            ?>
                            </div>
                            <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-dark pl-1">
                                Tarkib:
                            </p>
                            <div class="row">
                            <?
                              foreach ($languages as $key => $value) {
                            ?>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                              <p class="card-description col-md-12 col-sm-12 col-lg-12 text-light bg-danger pl-1">
                                <?=$value;?>
                              </p>
                            </div>
                            <?
                                if (array_key_exists($key, $how_it_work['content'])) {
                                  foreach ($how_it_work['content'][$key] as $content_key => $content_value) {
                            ?>

                            <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">

                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white"><i class="icon-energy" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control content-icon-<?=$key;?>-<?=$content_key;?>" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][icon]" placeholder="Belgi..." required="" readonly="" value="<?=$content_value['icon']?>">
                                <div class="input-group-prepend">
                                  <span class="input-group-append">
                                    <button class="btn btn-outline-secondary" data-input=".content-icon-<?=$key;?>-<?=$content_key;?>" data-icon="<?=$content_value['icon']?>" role="iconpicker" data-iconset="flaticon" data-label-header="{0} - {1} sahifalar" data-label-footer="{2} dan {0} - {1} belgilar" data-search-text="Izlash..." data-arrow-prev-icon-class="fa fa-angle-left" data-arrow-next-icon-class="fa fa-angle-right" data-arrow-class="btn-success"></button>
                                  </span>                           
                                </div>
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white font-weight-bold"><i class="icon-pencil" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][title]" placeholder="Sarlavha..." value="<?=$content_value['title']?>" required="">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <textarea class="form-control" id="meta_description_" rows="3" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][subtitle]" placeholder="Matn..." required=""><?=$content_value['subtitle']?></textarea>
                              </div>
                            </div>
                            <?
                                  }
                                }else{
                                  for ($i=0; $i < 3; $i++) { 
                                    $content_key = $i;
                            ?>
                            <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">

                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white"><i class="icon-energy" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control content-icon-<?=$key;?>-<?=$content_key;?>" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][icon]" placeholder="Belgi..." required="" readonly="" value="">
                                <div class="input-group-prepend">
                                  <span class="input-group-append">
                                    <button class="btn btn-outline-secondary" data-input=".content-icon-<?=$key;?>-<?=$content_key;?>" data-icon="" role="iconpicker" data-iconset="flaticon" data-label-header="{0} - {1} sahifalar" data-label-footer="{2} dan {0} - {1} belgilar" data-search-text="Izlash..." data-arrow-prev-icon-class="fa fa-angle-left" data-arrow-next-icon-class="fa fa-angle-right" data-arrow-class="btn-success"></button>
                                  </span>                           
                                </div>
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark text-white font-weight-bold"><i class="icon-pencil" style="margin-right: unset;"></i></span>                            
                                </div>
                                <input type="text" class="form-control" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][title]" placeholder="Sarlavha..." value="" required="">
                              </div>
                              <div class="input-group alert alert-fill-dark" style="background-color: unset;border-color: #d9d9d9;margin-bottom: unset;border-radius: unset;">
                                <textarea class="form-control" id="meta_description_" rows="3" name="how_it_work[content][<?=$key;?>][<?=$content_key;?>][subtitle]" placeholder="Matn..." required=""></textarea>
                              </div>
                            </div>  
                            <?
                                  }
                                }
                            ?>
                            <?
                              }
                            ?>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-success mr-2 col-12">Saqlash</button>
                        </form>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
              <?
                if ($this->input->get('tab') != '') {
                  $el = '#'.$this->input->get('tab').'_tab';
              ?>
                  $("[href='<?=$el;?>']").trigger('click');
              <?
                }
              ?>
              var ColorClass = Quill.import('attributors/class/color');
              var SizeStyle = Quill.import('attributors/style/size');
              Quill.register(ColorClass, true);
              Quill.register(SizeStyle, true);
              <?
                $about_site = json_decode(setting_item('about_site'), true);
                foreach ($languages as $key => $value) {
                  $default_value = '';
                  if (array_key_exists($key, $about_site)) {
                    $default_value .= $about_site[$key];
                  }
              ?>
              var about_site_<?=$key;?>_quill = new Quill('.quill-editor-about_site_<?=$key;?>', {
                modules: {
                  toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{
                      align: ['', 'center', 'right', 'justify']
                    }],
                    ['link', 'code-block']
                  ]
                },
                placeholder: 'Matnni kiriting...',
                theme: 'snow' // or 'bubble'
              });
              about_site_<?=$key;?>_quill.on('text-change', function() {
                $('.quil-fake-data-about_site_<?=$key;?>').val(''); $('.quil-fake-data-about_site_<?=$key;?>').val(about_site_<?=$key;?>_quill.root.innerHTML);
              });
              <?
                }
              ?>
              <?
                $advertisement = json_decode(setting_item('advertisement'), true);
                foreach ($languages as $key => $value) {
                  $default_value = '';
                  if (array_key_exists($key, $advertisement)) {
                    $default_value .= $advertisement[$key];
                  }
              ?>
              var advertisement_<?=$key;?>_quill = new Quill('.quill-editor-advertisement_<?=$key;?>', {
                modules: {
                  toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{
                      align: ['', 'center', 'right', 'justify']
                    }],
                    ['link', 'code-block']
                  ]
                },
                placeholder: 'Matnni kiriting...',
                theme: 'snow' // or 'bubble'
              });
              advertisement_<?=$key;?>_quill.on('text-change', function() {
                $('.quil-fake-data-advertisement_<?=$key;?>').val(''); $('.quil-fake-data-advertisement_<?=$key;?>').val(advertisement_<?=$key;?>_quill.root.innerHTML);
              });
              <?
                }
              ?>
              $(document).on('change', "#language_id", function(el) {
                window.location = '{base_url}manage/settings/language/'+$(this).val();
              });
            });
          </script>