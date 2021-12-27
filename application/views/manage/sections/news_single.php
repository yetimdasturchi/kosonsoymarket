<?
  $languages = $this->config->item('languages_list');
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-news-<?=$item['category_id'];?>" data-toggle="popover" title="<?=$item['category_name'];?>" data-content="<b>Nomi:</b> <em><?=$item['category_name'];?></em><br /><b>Til:</b> <em><?=get_languge_name($item['language']);?></em><br /><b>Meta sarlavha:</b> <em><?=$item['meta_title'];?></em><br /><b>Meta tasnif:</b> <em><?=$item['meta_description'];?></em><br /><b>Meta kalit so'zlar:</b> <em><?=$item['meta_keyword'];?></em><br />" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($item['category_name']);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$item['category_name'];?></h6>
                            <small class="text-muted mb-0"><i class="icon-globe mr-1"></i><?=get_languge_name($item['language']);?></small>
                          </div>
                        </div>
                        <menu class="context-menu-news-<?=$item['category_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/sections/news_view/<?=$item['category_id'];?>">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/sections/news_edit/<?=$item['category_id'];?>">
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/sections/news_delete/<?=$item['category_id'];?>">
                        </menu>