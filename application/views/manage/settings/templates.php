<?
    $data_name = $this->input->get('data');
    if ($data_name == '') {
      redirect('manage/settings/templates?data=application/controllers/Home.php');
    }
    $template_data = @file_get_contents('./'.$data_name);
    if ($template_data === FALSE) {
      $template_data = '';
    }else{
      $template_data = removeDocCom($template_data);
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
                  <h4 class="card-title">Andozalar | <span class="text-lowercase"><?=$data_name;?><span></h4>
                  <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <select class="js-example-basic-single" name="template_id" id="template_id" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                            $controllers = scanDirectories('./application/controllers');
                            echo '<optgroup label="Controllers">';
                            foreach ($controllers as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $helpers = scanDirectories('./application/helpers');
                            echo '<optgroup label="Helpers">';
                            foreach ($helpers as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $hooks = scanDirectories('./application/hooks');
                            echo '<optgroup label="Hooks">';
                            foreach ($hooks as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $models = scanDirectories('./application/models');
                            echo '<optgroup label="Models">';
                            foreach ($models as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $language = scanDirectories('./application/language');
                            echo '<optgroup label="Language">';
                            foreach ($language as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $views = scanDirectories('./application/views');
                            echo '<optgroup label="Views">';
                            foreach ($views as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $javascript = array('./public/js/custom.js', './public/js/forest-megamenu.js', './public/js/form-dropzone.js', './public/js/imagesloaded.js', './public/js/infobox.js', './public/js/theia-sticky-sidebar.js', './public/js/TouchScroll.js', './public/manage/js/dashboard.js', './public/manage/js/hoverable-collapse.js', './public/manage/js/misc.js', './public/manage/js/off-canvas.js', './public/manage/js/settings.js', './public/manage/js/todolist.js');
                            echo '<optgroup label="Javascript">';
                            foreach ($javascript as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $css = array('./public/css/defualt.css','./public/css/error.css','./public/css/style.css','./public/manage/css/style.css');
                            echo '<optgroup label="Css">';
                            foreach ($css as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                          <?
                            $data = scanDirectories('./public/data');
                            echo '<optgroup label="Data">';
                            foreach ($data as $key => $value) {
                              $name = str_replace('./', '', $value);
                              if ($data_name == $name) {
                                echo '<option value="'.$name.'" selected>- '.$name.'</option>';
                              }else{
                                echo '<option value="'.$name.'">- '.$name.'</option>';
                              }
                            }
                            echo '</optgroup>';
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <textarea name="template_data" id="template_data" style="display: none;"><?=$template_data;?></textarea>
                        <textarea id=language_editor><?=$template_data;?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                  
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
              $(document).on('change', "#template_id", function(el) {
                var data = {};
                data['data'] = $(this).val();
                window.location = '{base_url}manage/settings/templates?'+$.param( data );
              });
            });
          </script>