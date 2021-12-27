<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-contacts-<?=$contact['contact_id'];?>" data-toggle="popover" title="<?=$contact['subject'];?>" data-content="<b>Ism:</b> <em><?=$contact['name'];?></em><br /><b>Mavzu:</b> <em><?=$contact['subject'];?></em><br /><b>Email:</b> <em><?=$contact['email'];?></em><br /><b>Sana:</b> <em><?=dateformat($contact['date']);?></em><br /><b>Holat:</b> <em><?if($contact['status']==1){echo 'Ko\'rib chiqilgan';}else{echo'Jarayonda';}?></em>" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($contact['name']);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$contact['name'];?></h6>
                            <small class="text-muted mb-0"><i class="icon-envelope-letter mr-1"></i><?=$contact['email'];?></small>
                          </div>
                          <?
                            if ($contact['status']==1) {
                          ?>
                              <div class="badge badge-pill badge-success ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-success" title="Ko'rib chiqilgan"><i class="icon-eye font-weight-bold"></i></div>
                          <?
                            }else{
                          ?>
                              <div class="badge badge-pill badge-danger ml-auto px-1 py-1" data-toggle="tooltip" data-placement="right" data-custom-class="tooltip-danger" title="Jarayonda"><i class="icon-eye font-weight-bold"></i></div>
                          <?
                            }
                          ?>
                        </div>
                        <menu class="context-menu-contacts-<?=$contact['contact_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/contacts/view/<?=$contact['contact_id'];?>">
                          <?
                            if ($contact['status']==1) {
                          ?>
                          <command label="O'qilmagan deb belgilash" icon="edit" ajax-modal="{base_url}manage/contacts/read/<?=$contact['contact_id'];?>">
                          <?
                            }else{
                          ?>
                            <command label="O'qilgan deb belgilash" icon="edit" ajax-modal="{base_url}manage/contacts/read/<?=$contact['contact_id'];?>">
                          <?
                            }
                          ?>
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/contacts/delete/<?=$contact['contact_id'];?>">
                        </menu>