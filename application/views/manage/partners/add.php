
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
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
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Hamkor qo'shish</h4>
                  <form class="forms-sample" autocomplete="off" method="post" action="{base_url}manage/partners/insert" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Nomi</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Hamkor nomi..." required="">
                    </div>
                    <div class="form-group">
                      <label for="link">Manzil</label>
                      <input type="text" class="form-control" id="link" name="url" placeholder="Manzil..." required="">
                    </div>
                    <div class="form-group">
                      <label>Rasm</label>
                      <input type="file" name="photo" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Rasm yuklash">
                        <div class="input-group-append">
                          <button class="file-upload-browse btn btn-danger" type="button">Tanlash</button>                          
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Saqlash</button>
                    <a href="{base_url}manage/partners/list"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
          </div>
          