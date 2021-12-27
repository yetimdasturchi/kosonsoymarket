<?
  if ($this->input->get('b') != '' && $this->input->get('e') != '') {
    $begin = strtotime($this->input->get('b').' 00:00:00');
    $end = strtotime($this->input->get('e').' 23:59:59');
  }else{
    $begin = strtotime(date('Y-m-d').' 00:00:00');
    $end = strtotime(date('Y-m-d').' 23:59:59');
  }
?>
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample form-autosubmit" method="get" action="{current_url}" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="begin">Boshlanish sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="b" class="form-control" value="<?=$this->input->get('b');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label for="end">Tugash sanasi</label>
                        <div class="input-group date datepicker datepicker-popup">
                          <input type="text" name="e" class="form-control" value="<?=$this->input->get('e');?>">
                          <div class="input-group-addon input-group-text">
                            <span class="mdi mdi-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <canvas id="browserChart" style="height:180px"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <canvas id="platformChart" style="height:180px"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div id="viewsChart" style="height:180px"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div id="visitsMap" class="vector-map" style="width: 100%; height:500px"></div>
                </div>
              </div>
            </div>
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
                  data: <?=json_encode($this->Model_core->visit_platform('count', $begin, $end));?>,
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

                labels: <?=json_encode($this->Model_core->visit_platform('', $begin, $end));?>
              };
              var browserChartData = {
                labels: <?=json_encode($this->Model_core->visit_browser('', $begin, $end));?>,
                datasets: [{
                  data: <?=json_encode($this->Model_core->visit_browser('count', $begin, $end));?>,
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
                  <?
                    if ($this->input->get('b') != '' && $this->input->get('e') != '') {
                      $begin = strtotime($this->input->get('b').' 00:00:00');
                      $end = strtotime($this->input->get('e').' 23:59:59');
                  ?>
                      data: <?=json_encode($this->Model_core->visit_lastdays($begin, $end));?>,
                  <?
                    }else{
                  ?>
                      data: <?=json_encode($this->Model_core->visit_lastdays());?>,
                  <?
                    }
                  ?>
                  xkey: 'date',
                  ykeys: ['views', 'visits'],
                  labels: ['Ko\'rishlar', 'Tashriflar']
                });
              }
              if($('#visitsMap').length) {
                var visitsMapData = <?=json_encode($this->Model_core->visit_map($begin, $end));?>;
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