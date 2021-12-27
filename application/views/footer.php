<!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
         <footer class="footer-area">
            <!--Footer Upper-->
            <div class="footer-content">
               <div class="container">
                  <div class="row clearfix">
                     <!--Two 4th column-->
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row clearfix">
                           <div class="col-lg-7 col-sm-6 col-xs-12 column">
                              <div class="footer-widget about-widget">
                                 <div class="logo">
                                    <a href="{base_url}"><img alt="" class="img-responsive" src="{setting=style_path}images/logo-1.png"></a>
                                 </div>
                                 <div class="text">
                                    <p>&nbsp;</p>
                                 </div>
                                 <ul class="contact-info">
                                    <li><span class="icon fa fa-map-marker"></span> {setting=contact_address}</li>
                                    <li><span class="icon fa fa-phone"></span> {setting=contact_number}</li>
                                    <li><span class="icon fa fa-envelope-o"></span> {setting=contact_email}</li>
                                    <li><span class="icon fa fa-telegram"></span> {setting=contact_telegram}</li>
                                 </ul>
                                 <div class="social-links-two clearfix"> 
                                    <?
                                       foreach (json_decode(setting_item('social_links')) as $key => $value) {
                                          echo '<a class="'.$key.' img-circle" href="'.$value.'" target="_blank"><span class="fa fa-'.$key.'"></span></a>';
                                       }
                                    ?>
                                 </div>
                              </div>
                           </div>
                           <!--Footer Column-->
                           <div class="col-lg-5 col-sm-6 col-xs-12 column">
                              <div class="heading-panel">
                                 <h3 class="main-title text-left">{language=mobile_applications}</h3>
                              </div>
                              <div class="footer-widget links-widget">
                                 <ul>
                                    <li><a href="<?=base_url('uploads/Kosonsoy Market_1_1.0.apk');?>"><img src="{setting=style_path}images/android.png"></a></li>
                                    <li><a href="<?=base_url('uploads/chrome.zip');?>"><img src="{setting=style_path}images/apple.png"></a></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--Two 4th column End-->
                     <!--Two 4th column-->
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row clearfix">
                           <!--Footer Column-->
                           <div class="col-lg-7 col-sm-6 col-xs-12 column">
                              <div class="footer-widget news-widget">
                                 <div class="heading-panel">
                                    <h3 class="main-title text-left"> {language=latest_news}</h3>
                                 </div>
                                 <?
                                    $news = $this->Model_core->news('', '2');
                                    if ($news->num_rows() > 0) {
                                       $news = $news->result_array();
                                       foreach ($news as $row) {
                                 ?>
                                 <div class="news-post">
                                    <div class="icon"></div>
                                    <div class="news-content">
                                       <figure class="image-thumb"><img alt="" src="<?=$row['photo'];?>"></figure>
                                       <a href="{base_url}p/news/view/<?=$row['news_id'];?>-<?=$row['slug'];?>"><?=$row['title'];?></a>
                                    </div>
                                    <div class="time"><?=dateformat($row['date'])?></div>
                                 </div>
                                 <?
                                       }
                                    }
                                 ?>
                              </div>
                           </div>
                           <!--Footer Column-->
                           <div class="col-lg-5 col-sm-6 col-xs-12 column">
                              <div class="footer-widget links-widget">
                                 <div class="heading-panel">
                                    <h3 class="main-title text-left"> {language=quick_links}</h3>
                                 </div>
                                 <ul>
                                    <li><a href="<?=base_url('p/about')?>">{language=about_us}</a></li>
                                    <li><a href="<?=base_url('p/about#advertising');?>">{language=advertising}</a></li>
                                    <li><a href="<?=base_url('p/faq');?>">{language=faq}</a></li>
                                    <li><a href="<?=base_url('p/contact');?>">{language=contact}</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--Two 4th column End-->
                  </div>
               </div>
            </div>
            <!--Footer Bottom-->
            <div class="footer-copyright">
               <div class="container clearfix">
                  {6a72bde84cd442d3922006b5df965100}
               </div>
            </div>
         </footer>
         <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
      </div>
      <!-- Main Content Area End --> 
<!-- Post Ad Sticky -->
      <a href="{base_url}post-ad" class="sticky-post-button hidden-xs">
         <span class="sell-icons">
         <i class="icon-tools"></i>
         </span>
      </a>
      <!-- Back To Top -->
      <a href="#0" class="cd-top">Top</a>
      <!-- =-=-=-=-=-=-= Quote Modal =-=-=-=-=-=-= -->
      <script src="{base_url}language.js"></script>
      <script src="{setting=style_path}js/script.js"></script>
      <?
         if (1==2) {
         
      ?>
      <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
      <script src="{setting=style_path}js/jquery.min.js"></script>
      <!-- Bootstrap Core Css  -->
      <script src="{setting=style_path}js/bootstrap.min.js"></script>
      <!-- Jquery Easing -->
      <script src="{setting=style_path}js/easing.js"></script>
      <!-- Language -->
      <script src="{base_url}language.js"></script>
      <!-- Menu Hover  -->
      <script src="{setting=style_path}js/forest-megamenu.js"></script>
      <!-- Jquery Appear Plugin -->
      <script src="{setting=style_path}js/jquery.appear.min.js"></script>
      <!-- Numbers Animation   -->
      <script src="{setting=style_path}js/jquery.countTo.js"></script>
      <!-- Jquery Parallex -->
      <script src="{setting=style_path}js/jquery.smoothscroll.js"></script>
      <!-- Jquery Select Options  -->
      <script src="{setting=style_path}js/select2.min.js"></script>
      <!-- noUiSlider -->
      <script src="{setting=style_path}js/nouislider.all.min.js"></script>
      <!-- Carousel Slider  -->
      <script src="{setting=style_path}js/carousel.min.js"></script>
      <script src="{setting=style_path}js/slide.js"></script>
      <!-- Image Loaded  -->
      <script src="{setting=style_path}js/imagesloaded.js"></script>
      <script src="{setting=style_path}js/isotope.min.js"></script>
      <!-- CheckBoxes  -->
      <script src="{setting=style_path}js/icheck.min.js"></script>
      <!-- Jquery Migration  -->
      <script src="{setting=style_path}js/jquery-migrate.min.js"></script>
      <!-- Sticky Bar  -->
      <script src="{setting=style_path}js/theia-sticky-sidebar.js"></script>
      <!-- Wait me  -->
      <script src="{setting=style_path}plugins/waitme/waitMe.min.js"></script>
      <!-- dragscroll  -->
      <script src="{setting=style_path}js/dragscroll.js"></script>
      <?
         }
      ?>
      

      <?
         if ($this->uri->segment(1) == 'post-ad') {
      ?>
         <!-- Ckeditor  -->
         <script src="{setting=style_path}js/ckeditor/ckeditor.js" ></script>
         <!-- DROPZONE JS  -->
         <script src="{setting=style_path}js/dropzone.js" ></script>
         <script type="text/javascript">
         "use strict";
         
         /*--------- Textarea Ck Editor --------*/
         CKEDITOR.replace( 'editor1' );
         
         Dropzone.autoDiscover = false;
         Dropzone.prototype.defaultOptions.dictDefaultMessage = get_phrase('post_ad_photos_dropzone');
         Dropzone.prototype.defaultOptions.dictRemoveFile = get_phrase('post_ad_photos_dropzone_remove_file');
         var acceptedFileTypes = "image/*";
         var Uploader = (function (window, document, Uploader) {

         var $form, $btn, obj, myDropzone;
         $form = $(".post-ad-data");
         $btn = $("#postsubmit");
         obj = {};
         
         function initializeDropZone() {
    
            myDropzone = new Dropzone('div#imageUpload', {
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 20,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            acceptedFiles: acceptedFileTypes,
            dictMaxFilesExceeded: get_phrase('post_ad_photos_dropzone_maximum'),
            dictInvalidFileType: get_phrase('post_ad_photos_dropzone_invalidfile'),
            paramName: 'files',
            clickable: true,
            url: '/post/postad',
            init: function () {

               var myDropzone = this;
               $btn.click(function (e) {
                  e.preventDefault();
                  $('.waitme').waitMe({
                     effect : 'ios',
                     text : get_phrase('loading'),
                     bg : 'rgba(255,255,255,0.7)',
                     color : '#000'
                  });
                  if (myDropzone.getQueuedFiles().length == 0 && myDropzone.getUploadingFiles().length == 0) {
                     $('.waitme').waitMe('hide');
                     $('.alert .message').html(get_phrase('fields_not_filled'));
                     $('.alert').show();
                     $('.cd-top').trigger( "click" );
                  }else{
                     $('.alert .message').empty();
                     $('.alert').hide();
                  }
                  myDropzone.processQueue();
                  return true;
                });

               this.on('sending', function (file, xhr, formData) {
                 var data = $form.serializeArray();
                  $.each(data, function (key, el) {
                     if (el.name == 'content') {
                        var data = CKEDITOR.instances.editor1.getData();
                        formData.append(el.name, data);
                     }else{
                        formData.append(el.name, el.value);
                     }
                  });
               });
            },
            error: function (file, response){
                try {
                    var res = JSON.parse(response);
                    if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
                        $("#success-icon").attr("class", "fas fa-thumbs-down");
                        $("#success-text").html(res.message);
                        $modal.modal("show");
                    } else {
                        if ($.type(response) === "string")
                            var message = response; //dropzone sends it's own error messages in string
                        else
                            var message = response.message;
                        file.previewElement.classList.add("dz-error");
                        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            node = _ref[_i];
                            _results.push(node.textContent = message);
                        }
                        return _results;
                    }
                } catch (error) {
                  $('.waitme').waitMe('hide');
                }
                
            },
            successmultiple: function (file, response) {
               response = JSON.parse(response);
               if (response.status == 'error') {
                  $('.waitme').waitMe('hide');
                  $('.alert .message').html(response.message);
                  $('.alert').show();
                  $('.cd-top').trigger( "click" );
               }else{
                  $.redirectPost(base_url+'sc', {type: 'postad'});
               }
            },
            completemultiple: function (file, response) {
               $('.waitme').waitMe('hide');
            },
            reset: function () {
                console.log("resetFiles");
                this.removeAllFiles(true);
            }
            });
         }
    
         obj.init = function() {
            initializeDropZone();
         };
    
         Uploader = obj;
         return Uploader;
      })(window, document, Uploader);


      $(function(){
         Uploader.init();
      });

         (jQuery);
         </script>
      <?   
         }
      ?>
      <?
         if (1==2) {
         
      ?>
      <!-- Template Core JS -->
      <script src="{setting=style_path}js/custom.js"></script>
      <?
      }
      ?>
   </body>
</html>