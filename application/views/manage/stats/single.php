<div class="wrapper d-flex align-items-center py-2 border-bottom pointer" data-toggle="popover" title="" data-content="" data-placement="top" data-custom-class="popover-danger" data-trigger="hover" data-html="true" ajax-modal="{base_url}manage/stats/view/<?=$item['visitor_id'];?>">

                          <button type="button" class="btn social-btn btn-success btn-rounded" style="border-color: unset;background-color: #<?=random_color();?>;color: #fff;">
                            <?
                              if ($item['platform_type']=='application') {
                                echo '<i class="icon-grid"></i>';
                              }else if ($item['os_name'] == 'Windows') {
                                echo '<i class="fa fa-windows"></i>';
                              }else if ($item['os_name']=='iOS') {
                                echo '<i class="fa fa-apple"></i>';
                              }else if ($item['os_name'] == 'Android') {
                                echo '<i class="fa fa-android"></i>';
                              }else if ($item['platform_type']=='os') {
                                echo '<i class="icon-screen-desktop"></i>';
                              }else if ($item['platform_type']=='device') {
                                echo '<i class="icon-screen-smartphone"></i>';
                              }else{
                                echo '<i class="icon-user-unfollow"></i>';
                              }
                            ?>
                          </button>
                          <div class="wrapper ml-3">
                            <h6 class="ml-1 mb-1">
                              <?
                                if ($item['device_brand']!='') {
                                  if ($item['device_model']!='') {
                                    echo $item['device_brand'].''.$item['device_model'];
                                  }else{
                                    echo $item['device_brand'];
                                  }
                                }else if ($item['platform_type']=='os') {
                                  echo $item['os'];
                                }else if ($item['browser']!='') {
                                  echo $item['browser'];
                                }else{
                                  echo "Aniqlanmagan";
                                }
                              ?>
                            </h6>
                            <small class="text-muted mb-0">
                              <?
                                if ($item['ip']!='') {
                                  echo '<i class="icon-layers mr-1"></i> '.$item['ip'].' | <i class="icon-clock mr-1"></i>'.date("Y-m-d H:i:s", $item['date']);
                                }else{
                                  echo '<i class="icon-layers mr-1"></i> Aniqlanmagan';
                                }
                              ?>
                            </small>
                          </div>
                        </div>