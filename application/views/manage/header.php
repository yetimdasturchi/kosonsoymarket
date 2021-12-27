<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex">
  {02bd92faa38aaa6cc0ea75e59937a1ef}
  <title>Boshqaruv paneli</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{setting=style_path}manage/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/simple-line-icons.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/flag-icon.min.css">
  <link rel="stylesheet" href="{setting=style_path}css/flaticon.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/jquery.modal.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/sweetalert2.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/select2.min.css" />
  <link rel="stylesheet" href="{setting=style_path}manage/css/jquery.tagsinput.min.css" />
  <link rel="stylesheet" href="{setting=style_path}manage/css/quill.snow.css" />
  <link rel="stylesheet" href="{setting=style_path}manage/css/jquery.contextMenu.min.css" />
  <link rel="stylesheet" href="{setting=style_path}manage/css/bootstrap-iconpicker.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/codemirror.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/ambiance.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/jquery-jvectormap.css">
  <link rel="stylesheet" href="{setting=style_path}manage/css/morris.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{setting=style_path}manage/css/font-awesome.min.css" />
  <link rel="stylesheet" href="{setting=style_path}manage/css/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{setting=style_path}manage/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{setting=style_path}images/favicon.png" />
</head>
<body class="sidebar-icon-only">

  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{base_url}manage"><img src="{setting=style_path}manage/images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{base_url}manage"><img src="{setting=style_path}manage/images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">
              <span class="btn">+ Qoʻshish</span>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
              <a class="dropdown-item" href="{base_url}manage/ads/add">
                <i class="icon-basket-loaded text-primary"></i>
                Eʼlon
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{base_url}manage/news/add">
                <i class="icon-note text-warning"></i>
                Xabar
              </a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-viewsite d-lg-none">
            <a class="nav-link" href="{base_url}manage/ads/add">
              <i class="icon-basket-loaded"></i>
            </a>
          </li>
          <li class="nav-item nav-viewsite d-lg-none">
            <a class="nav-link" href="{base_url}manage/news/add">
              <i class="icon-note"></i>
            </a>
          </li>
          <li class="nav-item nav-viewsite d-lg-none">
            <a class="nav-link" href="{base_url}manage/stats/map">
              <i class="icon-chart"></i>
            </a>
          </li>
          <!--<li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="icon-info mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="icon-speech mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="icon-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>-->
          <li class="nav-item nav-viewsite">
            <a class="nav-link" href="{base_url}" target="_blank">
              <i class="icon-globe"></i>
            </a>
          </li>
          <li class="nav-item dropdown nav-viewsite">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <i class="icon-user"></i>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              <a class="dropdown-item font-weight-medium pointer" ajax-modal="{base_url}manage/users/profile">
                <i class="icon-info"></i>
                &nbsp;Parolni oʻzgartirish
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="{base_url}manage/logout">
                <i class="icon-logout"></i>
                &nbsp;Chiqish
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Prepare for presentation
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Project review
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="{setting=style_path}manage/images/face1.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="{setting=style_path}manage/images/face2.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="{setting=style_path}manage/images/face3.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="{setting=style_path}manage/images/face4.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="{setting=style_path}manage/images/face5.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="{setting=style_path}manage/images/face6.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{base_url}manage">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Uskunalar paneli</span>
              </a>
            </li>
            <?
              if ($this->Model_manage->check_permissions('contacts')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="{base_url}manage/contacts">
                <i class="icon-phone menu-icon"></i>
                <span class="menu-title">Qayta aloqalar</span>
              </a>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('stats')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#stats" aria-expanded="false" aria-controls="posts">
                <i class="icon-chart menu-icon"></i>
                <span class="menu-title">Statistika</span>
              </a>
              <div class="collapse" id="stats">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/stats/map">Xarita</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/stats/list">Roʻyxat</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('posts')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="posts">
                <i class="icon-basket-loaded menu-icon"></i>
                <span class="menu-title">Eʼlonlar</span>
                <span class="badge badge-danger"><?=$this->db->where('status', 1)->count_all_results('posts');?></span>
              </a>
              <div class="collapse" id="posts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/ads/add">Qoʻshish</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/ads/list">Roʻyxat</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('news')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news">
                <i class="icon-note menu-icon"></i>
                <span class="menu-title">Xabarlar</span>
                <span class="badge badge-info"><?=$this->db->count_all_results('news');?></span>
              </a>
              <div class="collapse" id="news">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/news/add">Qoʻshish</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/news/list">Roʻyxat</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('partners')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#partners" aria-expanded="false" aria-controls="partners">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Hamkorlar</span>
                <span class="badge badge-info"><?=$this->db->count_all_results('partners');?></span>
              </a>
              <div class="collapse" id="partners">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/partners/add">Qoʻshish</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/partners/list">Roʻyxat</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('pricing')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#pricing" aria-expanded="false" aria-controls="pricing">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Narxlar jadvali</span>
                <span class="badge badge-info"><?=$this->db->count_all_results('pricing');?></span>
              </a>
              <div class="collapse" id="pricing">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/pricing/add">Qoʻshish</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/pricing/list">Roʻyxat</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('sections')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sections" aria-expanded="false" aria-controls="sections">
                <i class="icon-settings menu-icon"></i>
                <span class="menu-title">Bo'limlar</span>
              </a>
              <div class="collapse" id="sections">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/sections/filters">Filtrlar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/sections/posts">Eʼlonlar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/sections/news">Xabarlar</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('settings')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <i class="icon-settings menu-icon"></i>
                <span class="menu-title">Sozlamalar</span>
              </a>
              <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/settings/global">Umumiy sozlamalar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/settings/pages">Sahifalar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/settings/telegram">Telegram sozlamalar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/settings/language">Til sozlamalari</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{base_url}manage/settings/templates">Andozalar</a></li>
                </ul>
              </div>
            </li>
            <?
              } if ($this->Model_manage->check_permissions('users')) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="{base_url}manage/users/list">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">Foydalanuvchilar</span>
              </a>
            </li>
            <?
              }
            ?>
          </ul>
        </nav>