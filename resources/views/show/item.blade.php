<!DOCTYPE html>
<html>
  <head>
    @includeif('basic.head')
  </head>
  <body>
    @includeif('basic.top_menu')
    
    <!--header-->
    <div class="container-fluid">
    <!--documents-->
      <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
          @includeif('basic.left_menu')
        </div>
        <div class="col-xs-12 col-sm-9 content"> 
          <!--CONTENIDO DE ALL ITEMS-->

          @if(!empty($array_fechas))
            <div class="panel panel-default" style="min-height: 550px">
              <div class="panel-heading">
                <ul class="nav nav-pills nav-justified">
                  @if(!empty($array_fechas[3]))
                  <li><a data-toggle="tab" href="#c3">Sin facción</a></li>
                  @endif
                  @if(!empty($array_fechas[0]))
                  <li><a data-toggle="tab" href="#c0">Alianza</a></li>
                  @endif
                  @if(!empty($array_fechas[1]))
                  <li><a data-toggle="tab" href="#c1">Horda</a></li>
                  @endif
                </ul>
              </div>
                <div class="tab-content">
                  @foreach($array_fechas as $keyFaccion => $fechas)
                  <div id="c{{ $keyFaccion }}" class="tab-pane fade" >
                    <canvas id="chart{{ $keyFaccion }}" width="400" height="200"></canvas>
                    <script>
                      var ctx = document.getElementById("chart{{ $keyFaccion }}");
                      var chart{{ $keyFaccion }} = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["<?php echo implode('","', $fechas);?>"],
                            datasets: [{
                                label: '{{ $itemSeleccionado['Nombre'] }}',
                                data: ["<?php echo implode('","', $array_maximos[$keyFaccion]);?>"],
                                backgroundColor: [
                                    '#ffce56'
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
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                  </div>
                  @endforeach
                </div>
                  <script>
                    $(document).ready( function () {
                        $('.table-items').DataTable({
                        "dom": 'ftip'
                        });
                    } );
                  </script>
            </div>
          @endif
          <!--      -->
        </div><!-- content -->
      </div>
    </div>
    <!--footer-->
    <div class="site-footer">
      @includeif('basic.footer')
    </div>
  </body>
</html>