<?
  $languages = $this->config->item('languages_list');
  $category_name = json_decode($item['name'], true);
  $parent = $this->Model_core->categories($item['parent_id']);
  if ($parent->num_rows() > 0) {
    $parent = $parent->row_array();
    $parent = json_decode($parent['name'], true);
    $parent = $parent[setting_item('default_language')];
  }else{
    $parent = "Belgilanmagan";
  }
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-post-<?=$item['category_id'];?>" data-toggle="popover" title="<?=$category_name[setting_item('default_language')];?> <i class='<?=$item['icon'];?>'></i>" data-content="<b>Nomi:</b> <em><?=$category_name[setting_item('default_language')];?></em><br /><b>Slug:</b> <em><?=$item['slug'];?></em><br /><b>Asosiy rukn:</b> <em><?=$parent;?></em><br /><b>Holat:</b> <em><?if ($item['status']==1) {echo'Aktivlangan';}else{echo'Aktivlanmagan';}?></em>" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <button type="button" class="btn social-btn btn-success btn-rounded" style="border-color: unset;background-color: #<?=random_color();?>;color: #fff;"><i class="<?=$item['icon'];?>"></i></button>
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$category_name[setting_item('default_language')];?></h6>
                            <small class="text-muted mb-0"><i class="icon-layers mr-1"></i><?=$parent;?></small>
                          </div>
                          <?
                            if ($item['status']==1) {
                          ?>
                              <div class="badge badge-pill badge-success ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-success" title="Aktivlangan"><i class="icon-check font-weight-bold"></i></div>
                          <?
                            }else{
                          ?>
                              <div class="badge badge-pill badge-danger ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right"  title="Aktivlanmagan"><i class="icon-close font-weight-bold"></i></div>
                          <?
                            }
                          ?>
                        </div>
                        <menu class="context-menu-post-<?=$item['category_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/sections/posts_view/<?=$item['category_id'];?>">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/sections/posts_edit/<?=$item['category_id'];?>" ajax-modal-tab="this">
                          <?
                            if ($item['status']==1) {
                          ?>
                          <command label="Aktivlanmagan etib belgilash" icon="fa-magic" ajax-modal="{base_url}manage/sections/posts_status/<?=$item['category_id'];?>">
                          <?
                            }else{
                          ?>
                            <command label="Aktivlangan etib belgilash" icon="fa-magic" ajax-modal="{base_url}manage/sections/posts_status/<?=$item['category_id'];?>">
                          <?
                            }
                          ?>
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/sections/posts_delete/<?=$item['category_id'];?>">
                        </menu>