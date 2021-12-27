<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-contacts-<?=$partner['partner_id'];?>" data-toggle="popover" title="<?=$partner['name'];?>" data-content="<img src='{base_url}<?=$partner['image'];?>' width='100%'>" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="{base_url}<?=$partner['image'];?>" alt="profile" style="object-fit: contain;">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$partner['name'];?></h6>
                            <small class="text-muted mb-0"><i class="icon-globe mr-1"></i><?=$partner['url'];?></small>
                          </div>
                        </div>
                        <menu class="context-menu-contacts-<?=$partner['partner_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="<?=$partner['url'];?>" ajax-modal-tab="new">
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/partners/edit/<?=$partner['partner_id'];?>">
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/partners/delete/<?=$partner['partner_id'];?>">
                        </menu>