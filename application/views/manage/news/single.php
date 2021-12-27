<?
$languages = $this->config->item('languages_list');
                        $category = $this->Model_core->news_categories($item['category_id']);
                        if ($category->num_rows() > 0) {
                          $category = $category->first_row('array');;
                          $category = $category['category_name'];
                        }else{
                          $category = '';
                        }
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-news-<?=$item['news_id'];?>" data-toggle="popover" title="<?=$item['title'];?>" data-content="<b>Til:</b> <em><?=$languages[$item['language']]?></em><br /><b>Sana:</b> <em><?=dateformat($item['date']);?></em><br /><b>Rukn:</b> <em><?=$category;?></em><br />" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="<?=$item['photo'];?>" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?if(strlen($item['title']) > 41){echo my_substr($item['title'], 0, 41).'...';}else{echo $item['title'];}?></h6>
                            <small class="text-muted mb-0"><i class="icon-clock mr-1"></i><?=dateformat($item['date']);?></small>
                          </div>
                        </div>
                        <menu class="context-menu-news-<?=$item['news_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/news/view/<?=$item['news_id'];?>">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/news/edit/<?=$item['news_id'];?>" ajax-modal-tab="this">
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/news/delete/<?=$item['news_id'];?>">
                        </menu>