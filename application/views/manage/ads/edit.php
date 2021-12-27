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
                  <h4 class="card-title">E'lonni tahrirlash</h4>
                  <form class="forms-sample" method="post" autocomplete="off" action="{base_url}manage/ads/update/<?=$item['post_id'];?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-4 col-sm-12 col-lg-4">
                        <label for="title">Sarlavha</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="E'lon sarlavhasi..." value="<?=$item['title'];?>" required="">
                      </div>
                      <div class="form-group col-md-4 col-sm-6 col-lg-4">
                        <label for="status">Holat</label>
                        <select class="js-example-basic-single" name="status" id="status" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <option value="3" <?if($item['status']=='3'){echo 'selected';}?>>Sotilgan</option>
                          <option value="2" <?if($item['status']=='2'){echo 'selected';}?>>Aktivlangan</option>
                          <option value="1" <?if($item['status']=='1'){echo 'selected';}?>>Jarayonda</option>
                          <option value="0" <?if($item['status']=='0'){echo 'selected';}?>>Aktivlanmagan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-6 col-lg-4">
                        <label for="category">Rukn</label>
                        <select class="js-example-basic-single category-select" name="category" id="category" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <?
                              $categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
                              if ($categories->num_rows() > 0) {
                                 $categories = $categories->result_array();
                                 foreach ($categories as $category) {
                                    if ($item['category_id'] == $category['category_id']) {
                                       $selected = 'selected=""';
                                    }else{
                                       $selected = '';
                                    }
                                    $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                                    $category['name'] = json_decode($category['name'], true);
                                    if ($subcategories->num_rows() > 0) {
                                       $subcategories = $subcategories->result_array();
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][setting_item('default_language')].'</option>';
                                       echo '<optgroup>';
                                       foreach ($subcategories as $subcategory) {
                                          $subcategory['name'] = json_decode($subcategory['name'], true);
                                          echo '<option value="'.$subcategory['category_id'].'" '.$selected.'>- '.$subcategory['name'][setting_item('default_language')].'</option>';
                                       }
                                       echo "</optgroup>";
                                    }else{
                                       echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'][setting_item('default_language')].'</option>';
                                    }
                                 }
                              }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="filters-content" style="display: none;">
                      <hr>
                      <p class="card-description">
                        Filtrlar
                      </p>
                      <div class="filters row">

                        
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-4">
                        <label for="price">Narx</label>
                        <input type="number" min="0" class="form-control" id="price" name="price" value="<?=$item['price'];?>" placeholder="Narx...">
                      </div>
                      <?

                        $price_options = json_decode($item['price_options'], true);
                      ?>
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="currency">Valyuta</label>
                        <select class="js-example-basic-single" name="currency" id="currency" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="sum" <?if($price_options['currency']=='sum'){echo 'selected';}?>>So'm</option>
                          <option value="usd" <?if($price_options['currency']=='usd'){echo 'selected';}?>>$</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-4">
                        <label for="covenant">Kelishuv</label>
                        <select class="js-example-basic-single" name="covenant" id="covenant" style="width:100%">
                          <option value="">Tanlash</option>
                          <option value="0" <?if($price_options['covenant']=='0'){echo 'selected';}?>>Odatiy</option>
                          <option value="1" <?if($price_options['covenant']=='1'){echo 'selected';}?>>Kelishilgan</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="exampleTextarea1">Matn</label>
                        <textarea class="quil-fake-data" name="content" style="display: none;"><?=$item['content'];?></textarea>
                        <div class="quill-container quill-editor">
                          <?=$item['content'];?>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label>Rasmlar</label>
                        <input type="file" name="images[]" class="file-upload-default" accept="image/*" multiple="">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Yuklash">
                          <div class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Tanlash</button>                          
                          </div>
                        </div>
                      </div>
                      <?
                        $images = $this->Model_core->getPostImages($item['post_id'], 100);
                      ?>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <div class="owl-carousel owl-theme rtl-carousel">
                        <?
                          if (is_array($images)) {
                            foreach ($images as $image) {
                              $path = parse_url($image, PHP_URL_PATH);
                              $image_id =  basename($path);
                        ?>
                              <div class="item">
                                <button type="button" class="btn btn-danger btn-xs remove-image" data-image="<?=$image_id;?>" style="position: absolute;top: 0px;z-index: 100001;right: 0; background-color: #dc4a38; border-color: #dc4a38;"><i class="mdi mdi-delete"></i>O'chirish</button>
                                <img src="<?=$image;?>" alt=""/>
                              </div>
                          <?
                              }
                            }else{
                          ?>
                            <div class="item">
                            <img src="<?=$images;?>" alt="" />
                          </div>
                        <?    
                          }
                        ?>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="pricing">Narxnoma</label>
                        <select class="js-example-basic-single" name="pricing_id" id="pricing" style="width:100%" required="">
                          <option value="null">Tanlash</option>
                          <?php
                            $pricing = $this->Model_core->pricing();
                            if ($pricing->num_rows() > 0) {
                              $pricing = $pricing->result_array();
                              foreach ($pricing as $row) {
                                $pricing_name = json_decode($row['name'], true);
                                if (is_array($pricing_name)) {
                                  $pricing_name = $pricing_name[setting_item('default_language')];
                                }else{
                                  $pricing_name = '';
                                }
                                if ($item['pricing_id']==$row['price_id']) {
                                  echo '<option value="'.$row['price_id'].'" selected>'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }else{
                                  echo '<option value="'.$row['price_id'].'">'.$pricing_name.' ('.number_format($row['price']).')</option>';
                                }
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position">Joylashuv</label>
                        <select class="js-example-basic-single" name="position" id="position" style="width:100%" required="">
                          <option value="">Tanlash</option>
                          <option value="default" <?if($item['position']=='default'){echo 'selected';}?>>Odatiy</option>
                          <option value="featured" <?if($item['position']=='featured'){echo 'selected';}?>>Turbo</option>
                          <option value="main" <?if($item['position']=='main'){echo 'selected';}?>>Premium</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_period_date">Joylashuv amal qilish sanasi</label>
                        <input type="date" name="position_period_date" class="form-control" id="position_period_date" placeholder="To'liq ism..." required="" value="<?=date("Y-m-d", strtotime($item['position_period']));?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-3">
                        <label for="position_period_time">Joylashuv amal qilish vaqti</label>
                        <input type="time" name="position_period_time" class="form-control" id="position_period_time" placeholder="To'liq ism..." required="" value="<?=date("H:i:s", strtotime($item['position_period']));?>">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_name">Ism</label>
                        <input type="text" class="form-control" id="onwer_name" name="onwer_name" placeholder="Ism..." value="<?=$item['contact_name'];?>" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_phone">Telefon raqam</label>
                        <input type="tel" class="form-control" id="onwer_phone" name="onwer_phone" placeholder="Telefon raqam..." value="<?=$item['phone'];?>" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_email">Email yoki telegram</label>
                        <input type="text" class="form-control" id="onwer_email" name="onwer_email" placeholder="Email yoki telegram..." value="<?=$item['email'];?>">
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-lg-3">
                        <label for="onwer_address">Manzil</label>
                        <input type="text" class="form-control" id="onwer_address" name="onwer_address" placeholder="Manzil..." value="<?=$item['address'];?>" required="">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Saqlash</button>
                    <a href="{base_url}manage/ads/list"><button class="btn btn-light" type="button">Bekor qilish</button></a>
                  </form>
                </div>
              </div>
            </div>
  </div>
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) { 
        $('.rtl-carousel .owl-item').each( function( index ) {
          $(this).attr( 'data-index', index );
        });

        $(document).on('click', ".remove-image", function(el) {
          var image_id = $(this).data('image');
          //console.log(image_id)
          var index = $(this).parent().parent().data('index');

          swal({
            title: 'Harakatni tasdiqlang!',
            text: "Siz rostdan ham ushbu harakatni bajarmoqchimisiz?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ha',
            cancelButtonText: 'Yo\'q',
            //showLoaderOnConfirm: true,
            preConfirm: function() {
              return new Promise(function(resolve) {
                $.get('{base_url}manage/ads/delete_image?image='+image_id, function(html) {
                  if (html == "success") {
                    swal('', 'harakat muvaffaqiyatli amalga oshirildi', 'success');
                    $(".rtl-carousel").trigger('remove.owl.carousel', index).trigger('refresh.owl.carousel');
                  }else if (html == "error") {
                    swal('', 'Harakatni bajarishda xatolik yuzberdi!', 'error');
                  }else{
                    swal(html);
                  }
                });
              });
            },
            allowOutsideClick: false     
          }); 
        });
        <?
          if ($item['filter'] != '') {
        ?>
            $.get( '{base_url}manage/ads/filters/<?=$item['category_id'];?>?post=<?=$item['post_id'];?>' , function(html) {
              if (html !== "error") {
                if (html.length > 2){
                  $('.filters-content').show();
                  $('.filters-content .filters').html(html);
                  if($(".filters-content .filters .js-example-basic-single").length){
                    $(".filters-content .filters .js-example-basic-single").select2({placeholder: "Tanlash"});
                  }
                }else{
                  $('.filters-content').hide();
                  $('.filters-content .filters').empty();
                }
              }else{
                $('.filters-content').hide();
                $('.filters-content .filters').empty();
              }
            });  
        <?
          }
        ?>
        
      $(document).on('change', ".category-select", function(el) {
        $.get( '{base_url}manage/ads/filters/'+$(el.target).val() , function(html) {
          if (html !== "error") {
            if (html.length > 2){
              $('.filters-content').show();
              $('.filters-content .filters').html(html);
              if($(".filters-content .filters .js-example-basic-single").length){
                $(".filters-content .filters .js-example-basic-single").select2({placeholder: "Tanlash"});
              }
            }else{
              $('.filters-content').hide();
              $('.filters-content .filters').empty();
            }
          }else{
            $('.filters-content').hide();
            $('.filters-content .filters').empty();
          }
        });
      });
    });
  </script>