          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              {7937d481747ecb09106cac82c1388c5a}
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{setting=style_path}manage/js/vendor.bundle.base.js"></script>
  <!-- Language -->
  <script src="{base_url}language.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{setting=style_path}manage/js/jquery.barrating.min.js"></script>
  <script src="{setting=style_path}manage/js/Chart.min.js"></script>
  <script src="{setting=style_path}manage/js/jquery-jvectormap.min.js"></script>
  <script src="{setting=style_path}manage/js/jquery-jvectormap-world-mill-en.js"></script>
  <script src="{setting=style_path}manage/js/raphael.min.js"></script>
  <script src="{setting=style_path}manage/js/morris.min.js"></script>
  <script src="{setting=style_path}manage/js/jquery.sparkline.min.js"></script>   
  <script src="{setting=style_path}manage/js/jquery.modal.min.js"></script>  
  <script src="{setting=style_path}manage/js/sweetalert2.min.js"></script>  
  <script src="{setting=style_path}manage/js/bootstrap-datepicker.min.js"></script> 
  <script src="{setting=style_path}manage/js/select2.min.js"></script> 
  <script src="{setting=style_path}manage/js/jquery.tagsinput.min.js"></script> 
  <script src="{setting=style_path}manage/js/quill.min.js"></script> 
  <script src="{setting=style_path}manage/js/jquery.contextMenu.min.js"></script> 
  <script src="{setting=style_path}manage/js/bootstrap-iconpicker.bundle.min.js"></script> 
  <script src="{setting=style_path}manage/js/owl.carousel.min.js"></script> 

  <?
    if ($this->uri->segment(3) == 'language' || $this->uri->segment(3) == 'templates') {
  ?>
      <script src="{setting=style_path}manage/ace/src-noconflict/ace.js"></script> 
      <script>
        var editor = ace.edit("language_editor");
        editor.setTheme("ace/theme/monokai");
        <?
          if ($this->uri->segment(3) == 'language') {
        ?>
        editor.session.setMode("ace/mode/json");
        <?    
          }else{
            $data_name = $this->input->get('data');
            if ($data_name != '') {
              $data_ext = array('php' => 'php', 'js' => 'javascript', 'html' => 'html', 'json' => 'json', 'css' => 'css', 'scss' => 'scss', 'ruby' => 'ruby', 'perl' => 'perl', 'coffee' => 'coffee');
              $data_parts = pathinfo($data_name);
              if (array_key_exists($data_parts['extension'], $data_ext)) {
        ?>
                editor.session.setMode("ace/mode/<?=$data_ext[$data_parts['extension']];?>");
        <?        
              }else{
        ?>
                editor.session.setMode("ace/mode/json");
        <?
              }
            }else{
        ?>
              editor.session.setMode("ace/mode/json");
        <?
            }    
          }
        ?>
        editor.setOption("maxLines", 30);
        editor.setAutoScrollEditorIntoView(true);
        editor.session.setUseWorker(false);
        <?
          if ($this->uri->segment(3) == 'language') {
        ?>
          editor.session.on('change', function(delta) {
            $('#language_data').val(editor.getValue());
          });
        <?    
          }
        ?>
        <?
          if ($this->uri->segment(3) == 'templates') {
        ?>
          editor.setReadOnly(true);
        <?    
          }
        ?>
       
        //editor.session.setUseWrapMode(true);
        //editor.setReadOnly(true);
      </script>
  <?    
    }
  ?>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{setting=style_path}manage/js/off-canvas.js"></script>
  <script src="{setting=style_path}manage/js/hoverable-collapse.js"></script>
  <script src="{setting=style_path}manage/js/misc.js"></script>
  <script src="{setting=style_path}manage/js/settings.js"></script>
  <script src="{setting=style_path}manage/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{setting=style_path}manage/js/dashboard.js"></script>
  <!-- End custom js for this page-->

</body>

</html>
