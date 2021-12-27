 <?
  $languages = $this->config->item('languages_list');
 ?>
 <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
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
                  <h4 class="card-title">Narx jadvali qo'shish</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/pricing/insert" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="price">Narx</label>
                        <input type="number" min="0" class="form-control" id="price" name="price" placeholder="Narx..." required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="featured">Turi</label>
                        <select class="js-example-basic-single" name="featured" id="featured" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="notfeatured">Belgilanmagan</option>
                          <option value="featured">Maxsus</option>
                        </select>
                      </div>
                    </div>
                    <hr />
                    <p class="card-description">
                        Nomi:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="name_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" min="0" class="form-control" id="name_<?=$key;?>" name="name[<?=$key;?>]" placeholder="<?=$value;?>..." required="">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <p class="card-description">
                        Sarlavha:
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="subtitle_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <input type="text" min="0" class="form-control" id="subtitle_<?=$key;?>" name="subtitle[<?=$key;?>]" placeholder="<?=$value;?>..." required="">
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <hr />
                    <p class="card-description">
                        Tarkib (Har bir qator yangi punktni belgilaydi):
                    </p>
                    <div class="row">
                      <?
                        foreach ($languages as $key => $value) {
                      ?>
                          <div class="form-group col-md-6 col-sm-6 col-lg-6">
                            <label for="subtitle_<?=$key;?>" class="text-primary"><?=$value;?></label>
                            <textarea class="form-control" id="subtitle_<?=$key;?>" rows="5" name="content[<?=$key;?>]" placeholder="<?=$value;?>..." required=""></textarea>
                          </div>
                      <?
                        }
                      ?>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Kiritish</button>
                    <a href="{base_url}manage/pricing/list"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>