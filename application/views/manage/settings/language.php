<?
    $language_data = @file_get_contents('./application/language/lng_files/'.$language_id.'.lng');
    if ($language_data === FALSE) {
      redirect(base_url('manage/settings/language/backup/'.$language_id));
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
                  <h4 class="card-title">Til sozlamalari | <?=get_languge_name($language_id);?></h4>
                  <div class="tab-minimal tab-minimal-success">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab-list-tab" data-toggle="tab" href="#list_tab" role="tab" aria-controls="list-tab" aria-selected="false"><i class="icon-layers"></i>Ro'yxat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab-editor-tab" data-toggle="tab" href="#editor_tab" role="tab" aria-controls="editor_tab" aria-selected="true"><i class="icon-grid"></i>Tahrirlash</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-content-solid">
                      <div class="tab-pane fade" id="editor_tab" role="tabpanel" aria-labelledby="tab-editor-tab">
                        <form class="forms-sample" method="post" action="{base_url}manage/settings/language/save" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="parent_id">Til</label>
                        <select class="js-example-basic-single" name="language_id" id="language_id" style="width:100%" required="">
                          <option value="0">Tanlash</option>
                          <?
                            $languages = $this->config->item('languages_list');
                            foreach ($languages as $key => $value) {
                              if ($key == $language_id) {
                                echo '<option value="'.$key.'" selected>'.$value.'</option>';
                              }else{
                                echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <textarea name="language_data" id="language_data" style="display: none;"><?=$language_data;?></textarea>
                        <textarea id=language_editor><?=$language_data;?></textarea>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">
                            <a href="{base_url}manage/settings/language/backup/<?=$language_id;?>" onClick="return confirm('Siz rostdan ham ushbu til paketiga tegishli boshlang\'ich sozlamalarni tiklamoqchimisiz?');"><button type="button" class="btn btn-danger mr-2 col-12">Qayta tiklash</button></a>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6 channel-item">
                            <button type="submit" class="btn btn-success mr-2 col-12" onClick="return confirm('Ma\'lumot saqlansinmi?');">Saqlash</button>
                      </div>
                    </div>
                  </form>
                      </div>
                      <div class="tab-pane fade show active" id="list_tab" role="tabpanel" aria-labelledby="tab-list-ta">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                            <form class="forms-sample" method="post" action="{base_url}manage/settings/language/create" autocomplete="off">
                              <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="language_name">Nomi</label>
                                  <input type="text" name="language_name" class="form-control" id="language_name" placeholder="Nomi..." required="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                  <label for="language_key">Kalit</label>
                                  <input type="text" name="language_key" class="form-control slugify" id="language_key" placeholder="Kalit..." required="">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-lg-12 channel-item">
                                  <button type="submit" class="btn btn-success mr-2 col-12" onClick="return confirm('Ma\'lumot saqlansinmi?');">Qo'shish</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        <?
                          $languages = $this->config->item('languages_list');
                          foreach ($languages as $key => $value) {
                        ?>
                            <div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">
                            <div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-language-<?=$key;?>" data-toggle="popover" title="<?=$value;?>" data-content="<b>Kalit:</b> <em><?=$key;?></em><br /><b>Nomi:</b> <em><?=$value;?></em>" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($value);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$value;?></h6>
                            <small class="text-muted mb-0"><i class="icon-layers mr-1"></i><?=$key;?></small>
                          </div>
                        </div>
                        <menu class="context-menu-language-<?=$key;?>" type="context" style="display:none">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/settings/language/<?=$key;?>" ajax-modal-tab="this">
                          <command label="Qayta tiklash" icon="fa-magic" confirm-swal="{base_url}manage/settings/language/backup_swal/<?=$key;?>" confirm-swal-redirect="{base_url}manage/settings/language/">
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/settings/language/delete/<?=$key;?>" confirm-swal-redirect="{base_url}manage/settings/language/">
                        </menu></div>
                        <?      
                          }
                        ?>
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
              <?
                if ($this->uri->segment(4) != '') {
              ?>
                  $("[href='#editor_tab']").trigger('click');
              <?
                }
              ?>
              $(document).on('change', "#language_id", function(el) {
                window.location = '{base_url}manage/settings/language/'+$(this).val();
              });
            });
          </script>