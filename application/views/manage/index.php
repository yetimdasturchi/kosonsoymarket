
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
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-basket-loaded icon-lg text-success"></i>
                    <div class="ml-3">
                      <p class="mb-0">Umumiy e'lonlar</p>
                      <h6><?=$this->db->count_all_results('posts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-bag icon-lg text-info"></i>
                    <div class="ml-3">
                      <p class="mb-0">Tasdiqlangan e'lonlar</p>
                      <h6><?=$this->db->where('status', 2)->count_all_results('posts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-clock icon-lg text-warning"></i>
                    <div class="ml-3">
                      <p class="mb-0">Jarayondagi e'lonlar</p>
                      <h6><?=$this->db->where('status', 1)->count_all_results('posts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="icon-close icon-lg text-danger"></i>
                    <div class="ml-3">
                      <p class="mb-0">Bekor qilingan e'lonlar</p>
                      <h6><?=$this->db->where('status', 0)->count_all_results('posts');?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <canvas id="browserChart" style="height:250px"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <canvas id="platformChart" style="height:250px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div id="viewsChart"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div id="visitsMap" class="vector-map" style="width: 100%; height:300px"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?
              $count = 0;
              if ($this->Model_manage->check_permissions('posts')==true) {
                $count++;
              }
              if ($this->Model_manage->check_permissions('contacts')==true) {
                $count++;
              }
              if ($this->Model_manage->check_permissions('news')==true) {
                $count++;
              }
              if ($count==1) {
                $col_md = 'col-md-12'; 
              }else if ($count==2) {
                $col_md = 'col-md-6'; 
              }else if ($count==3) {
                $col_md = 'col-md-4'; 
              }
              
            ?>
            <?
              if ($this->Model_manage->check_permissions('posts')==true) {
            ?>
            <div class="<?=$col_md;?> grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">So'nggi e'lonlar</h4>
                  <?
                    $posts = $this->db->order_by('created_at', 'desc')->limit(5)->get_where('posts');
                    if ($posts->num_rows() > 0) {
                      foreach ($posts->result_array() as $post) {
                        $this->load->view('manage/ads/single', array('post' => $post));
                      }
                    }else{
                  ?>
                    <div class="wrapper d-flex align-items-center py-2 border-bottom text-center">
                      <h6 class="ml-1 mb-1 text-center">Ma'lumotlar mavjud emas</h6>
                    </div>
                  <?
                    }
                  ?>
                </div>
              </div>
            </div>
            <?
              } if ($this->Model_manage->check_permissions('news')==true) {
            ?>
            <div class="<?=$col_md;?> grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">So'nggi xabarlar</h4>
                  <?
                    $news = $this->db->order_by('date', 'desc')->limit(5)->get_where('news');
                    if ($news->num_rows() > 0) {
                      foreach ($news->result_array() as $item) {
                        $this->load->view('manage/news/single', array('item' => $item));
                      }
                    }else{
                  ?>
                    <div class="wrapper d-flex align-items-center py-2 border-bottom text-center">
                      <h6 class="ml-1 mb-1 text-center">Ma'lumotlar mavjud emas</h6>
                    </div>
                  <?
                    }
                  ?>
                </div>
              </div>
            </div>
            <?
              } if ($this->Model_manage->check_permissions('contacts')==true) {
            ?>
            <div class="<?=$col_md;?> grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Aloqa xatlari</h4>
                  <?
                    $contacts = $this->db->order_by('date', 'desc')->limit(5)->get_where('contacts');
                    if ($contacts->num_rows() > 0) {
                      foreach ($contacts->result_array() as $contact) {
                        $this->load->view('manage/contacts/single', array('contact' => $contact));
                      }
                    }else{
                  ?>
                    <div class="wrapper d-flex align-items-center py-2 border-bottom text-center">
                      <h6 class="ml-1 mb-1 text-center">Ma'lumotlar mavjud emas</h6>
                    </div>
                  <?
                    }
                  ?>
                </div>
              </div>
            </div>
            <?
              }
            ?>
          </div>
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
              var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
              };
              
              var platformChartData = {
                datasets: [{
                  data: <?=json_encode($this->Model_core->visit_platform('count'));?>,
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                  ],
                  borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                  ],
                }],

                labels: <?=json_encode($this->Model_core->visit_platform());?>
              };
              var browserChartData = {
                labels: <?=json_encode($this->Model_core->visit_browser());?>,
                datasets: [{
                  data: <?=json_encode($this->Model_core->visit_browser('count'));?>,
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
                }]
              };
              var platformChartOptions = {
                responsive: true,
                animation: {
                  animateScale: true,
                  animateRotate: true
                }
              };
              var browserChartOptions = {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                },
                legend: {
                  display: false
                },
                elements: {
                  point: {
                    radius: 0
                  }
                }
              };
              if ($("#platformChart").length) {
                var platformChartCanvas = $("#platformChart").get(0).getContext("2d");
                var platformChart = new Chart(platformChartCanvas, {
                  type: 'doughnut',
                  data: platformChartData,
                  options: platformChartOptions
                });
              }
              if ($("#browserChart").length) {
                var browserChartCanvas = $("#browserChart").get(0).getContext("2d");
                var browserChart = new Chart(browserChartCanvas, {
                  type: 'bar',
                  data: browserChartData,
                  options: browserChartOptions
                });
              }
              if($('#viewsChart').length) {
                Morris.Line({
                  element: 'viewsChart',
                  lineColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66'],
                  data: <?=json_encode($this->Model_core->visit_lastdays());?>,
                  xkey: 'date',
                  ykeys: ['views', 'visits'],
                  labels: ['Ko\'rishlar', 'Tashriflar']
                });
              }
              if($('#visitsMap').length) {
                var visitsMapData = <?=json_encode($this->Model_core->visit_map());?>;
                var regions_visitsMapData = {};
                for (var i in visitsMapData) {
                  regions_visitsMapData[i] = visitsMapData[i]['visits'];
                }
                $('#visitsMap').vectorMap({
                  map: 'world_mill_en',
                  backgroundColor: "#FFFFFF",
                  regionStyle: {
                    initial: {
                      fill: '#DDDDDD',
                      "fill-opacity": 1,
                      stroke: 'none',
                      "stroke-width": 0,
                      "stroke-opacity": 1
                    }
                  },
                  series: {
                    regions: [{
                      values: regions_visitsMapData,
                      scale: ["#F44336", "#2196F3", "#009688", "#8BC34A", "#FFC107" , "#FF5722", "#CDDC39"],
                      normalizeFunction: 'polynomial'
                    }]
                  },
                  onRegionTipShow: function(e, el, code){
                    if (visitsMapData.hasOwnProperty(code)!=false) {
                      var data = visitsMapData[code];
                      if (data.hasOwnProperty("views")) {
                        var views = data['views'];
                      }else{
                        var views = 0;
                      }
                      if (data.hasOwnProperty("visits")) {
                        var visits = data['visits'];
                      }else{
                        var visits = 0;
                      }
                      el.html(el.html()+' : '+visits+' tashriflar, '+views+' ko\'rishlar');
                    }else{
                      el.html(el.html()+' : 0 tashriflar, 0 ko\'rishlar');
                    }
                  }
                });
              }
            });
          </script>