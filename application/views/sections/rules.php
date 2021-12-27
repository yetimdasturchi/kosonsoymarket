<div class="col-md-4 col-xs-12 col-sm-12">
                     <!-- Sidebar Widgets -->
                     <div class="blog-sidebar">
                        <!-- Categories --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>{language=rules} </a></h4>
                           </div>

                           <div class="widget-content">
                              <ol>
                                 <?php
                                    $data = json_decode(setting_item('rules'), true);
                                    if (is_array($data)) {
                                       foreach ($data[getDefaultLang()] as $row) {
                                          echo '<li>'.$row.'</li>';
                                       }
                                    }
                                 ?>
                              </ol>
                           </div>
                        </div>
                        <!-- Latest News --> 
                     </div>
                     <!-- Sidebar Widgets End -->
                  </div>