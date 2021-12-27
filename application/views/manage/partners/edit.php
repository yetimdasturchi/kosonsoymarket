<form class="forms-sample" autocomplete="off" method="post" action="{base_url}manage/partners/update/<?=$partner['partner_id'];?>" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Nomi</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Hamkor nomi..." value="<?=$partner['name'];?>" required="">
  </div>
  <div class="form-group">
    <label for="link">Manzil</label>
    <input type="text" class="form-control" id="link" name="url" placeholder="Manzil..." value="<?=$partner['url'];?>" required="">
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
  <a href="#" rel="modal:close"><button class="btn btn-light" type="button">Bekor qilish</button></a>
</form>