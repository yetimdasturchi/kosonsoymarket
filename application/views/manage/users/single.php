<?
  $permissions = '';
  $permissions_data = $this->config->item('user_permissions');
  $x = 0;
  foreach (json_decode($item['permissions']) as $key => $value) {
    $x++;
    $permissions .= $permissions_data[$value].', ';
    if ($x == 2) {
      $permissions .= '<br />';
      $x = 0;
    }
  }
?>
<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" context-menu=".context-menu-user-<?=$item['user_id'];?>" data-toggle="popover" title="<?=$item['username'];?>" data-content="<b>Login:</b> <em><?=$item['username'];?></em><br /><b>To'liq ism:</b> <em><?=$item['fullname'];?></em><br /><b>Vazifa:</b> <em><?=$item['role'];?></em><br /><b>Holat:</b> <em><?if($item['status']==1){echo'Aktivlangan';}else{echo'Aktivlanmagan';}?></em><br /><b>Huquqlar:</b> <em><?=$permissions;?></em><br />" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true">
                          <img class="img-sm rounded-circle" src="https://ui-avatars.com/api/?uppercase=false&name=<?=urlencode($item['username']);?>&background=<?=random_color();?>&color=fff" alt="profile">
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1"><?=$item['fullname'];?></h6>
                            <small class="text-muted mb-0"><i class="icon-user mr-1"></i><?=$item['username'];?></small>
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
                        <menu class="context-menu-user-<?=$item['user_id'];?>" type="context" style="display:none">
                          <command label="Batafsil ma'lumot" icon="fa-eye" ajax-modal="{base_url}manage/users/view/<?=$item['user_id'];?>">
                          <?
                            if ($item['role'] != 'Superadmin') {
                          ?>
                          <hr />
                          <command label="Tahrirlash" icon="edit" ajax-modal="{base_url}manage/users/edit/<?=$item['user_id'];?>">
                          <command label="<?if ($item['status']==1) {echo'Aktivlanmagan etib belgilash';}else{echo'Aktivlangan etib belgilash';}?>" icon="fa-magic" ajax-modal="{base_url}manage/users/status/<?=$item['user_id'];?>">
                          
                          <hr />
                          <command label="O'chirish" icon="delete" confirm-swal="{base_url}manage/users/delete/<?=$item['user_id'];?>">
                          <?
                          }
                          ?>
                        </menu>