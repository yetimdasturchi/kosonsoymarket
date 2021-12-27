
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
  <link rel="stylesheet" href="{setting=style_path}manage/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{setting=style_path}manage/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{setting=style_path}images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <?
                if ($this->session->flashdata('message') != '') {
              ?>
                  <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                      <?=$this->session->flashdata('message');?>
                  </div>
              <?
                }
              ?>
              
              <div class="auth-form-dark text-left p-5">
                <h2>Tizimga kirish</h2>
                <h4 class="font-weight-light"><?=ucwords(base_host());?></h4>
                <form class="pt-5" method="post" action="" autocomplete="off">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Login" name="username">
                    <i class="mdi mdi-account"></i>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Parol</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Parol" name="password">
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="mt-5">
                    <button class="btn btn-block btn-warning btn-lg font-weight-medium" type="submit">Kirish</button>
                  </div>              
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{setting=style_path}manage/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{setting=style_path}manage/js/off-canvas.js"></script>
  <script src="{setting=style_path}manage/js/hoverable-collapse.js"></script>
  <script src="{setting=style_path}manage/js/misc.js"></script>
  <script src="{setting=style_path}manage/js/settings.js"></script>
  <script src="{setting=style_path}manage/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>