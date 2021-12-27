<?
  $languages = $this->config->item('languages_list');
  $filter_name = json_decode($item['filter_name'], true);
  $category = $this->Model_core->categories($item['category_id']);
  if ($category->num_rows() > 0) {
    $category = $category->row_array();
    $category = json_decode($category['name'], true);
    $category = $category[setting_item('default_language')];
  }else{
    $category = "Aniqlanmagan";
  }
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-filter-<?=$item['filter_id'];?>" data-toggle="popover" title="<?=$filter_name[setting_item('default_language')];?>" data-content="<b>Nomi:</b> <em><?=$filter_name[setting_item('default_language')];?></em><br /><b>Asosiy rukn:</b> <em><?=$category;?></em><br /><b>Tartib:</b> <em><?=$item['sort'];?></em><br /><b>Turi:</b> <em><?if ($item['type']=='select') {echo'Tanlovchi';}else{echo'Kirituvchi';}?></em><br /><b>Xususiyat:</b> <em><?if ($item['action']=='min') {echo'Minimal';}else if ($item['action']=='max') {echo'Maksimal';}else{echo'Teng';}?></em><br />" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($filter_name[setting_item('default_language')]);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$filter_name[setting_item('default_language')];?></h6>
                            <small class="text-muted mb-0"><i class="icon-layers mr-1"></i><?=$category;?></small>
                          </div>
                          <div class="badge badge-pill badge-danger ml-auto"><i class="fa fa-sort-amount-asc"></i> <?=$item['sort'];?></div>
                        </div>
                        <menu class="context-menu-filter-<?=$item['filter_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/sections/filters_view/<?=$item['filter_id'];?>">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/sections/filters_edit/<?=$item['filter_id'];?>" ajax-modal-tab="this">
                          <command label="Saralash" icon="fa-sort-amount-asc" ajax-modal="{base_url}manage/sections/filters_sort/<?=$item['filter_id'];?>">
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/sections/filters_delete/<?=$item['filter_id'];?>">
                        </menu>