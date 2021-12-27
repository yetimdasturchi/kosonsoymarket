<?
  $name = json_decode($item['name'], true);
  $subtitle = json_decode($item['subtitle'], true);
  $languages = $this->config->item('languages_list');
  $html = '';
  foreach ($languages as $key => $value) {
    if (array_key_exists($key, $name)) {
      $html .= '<b>Nomi ('.$value.'):</b> <em>'.$name[$key].'</em><br />';
    }
    if (array_key_exists($key, $subtitle)) {
      $html .= '<b>Sarlavha ('.$value.'):</b> <em>'.$subtitle[$key].'</em><br />';
    }
  }
  if ($item['featured']=='featured') {
    $html .= '<b>Turi:</b> <em>Maxsus</em><br />';
  }else{
    $html .= '<b>Turi:</b> <em>Belgilanmagan</em><br />';
  }
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-contacts-<?=$item['price_id'];?>" data-toggle="popover" title="<?=$item['price'];?> so'm" data-content="<?=$html;?>" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($item['price']);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$item['price'];?> so'm</h6>
                            <small class="text-muted mb-0"><i class="icon-magic-wand mr-1"></i><?echo ($item['featured']=='featured') ? 'Maxsus' : 'Belgilanmagan';?></small>
                          </div>
                          <?
                            if ($item['featured']=='featured') {
                          ?>
                              <div class="badge badge-pill badge-success ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-success" title="Maxsus"><i class="icon-magic-wand font-weight-bold"></i></div>
                          <?
                            }else{
                          ?>
                              <div class="badge badge-pill badge-danger ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-danger" title="Belgilanmagan"><i class="icon-magic-wand font-weight-bold"></i></div>
                          <?
                            }
                          ?>
                        </div>
                        <menu class="context-menu-contacts-<?=$item['price_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/pricing/view/<?=$item['price_id'];?>">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/pricing/edit/<?=$item['price_id'];?>" ajax-modal-tab="this">
                          <?
                            if ($item['featured']=='featured') {
                          ?>
                          <command label="Odatiy deb belgilash" icon="fa-magic" ajax-modal="{base_url}manage/pricing/featured/<?=$item['price_id'];?>">
                          <?
                            }else{
                          ?>
                            <command label="Maxsus deb belgilash" icon="fa-magic" ajax-modal="{base_url}manage/pricing/featured/<?=$item['price_id'];?>">
                          <?
                            }
                          ?>
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/pricing/delete/<?=$item['price_id'];?>">
                        </menu>