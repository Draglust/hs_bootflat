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

          @if(!empty($items))
            <div class="panel panel-default" style="min-height: 550px">
              <div class="panel-heading">
                <ul class="nav nav-pills nav-justified">
                  @if(!empty($items[3]))
                  <li><a data-toggle="tab" href="#ac3">Sin facción</a></li>
                  @endif
                  @if(!empty($items[0]))
                  <li><a data-toggle="tab" href="#ac0">Alianza</a></li>
                  @endif
                  @if(!empty($items[1]))
                  <li><a data-toggle="tab" href="#ac1">Horda</a></li>
                  @endif
                </ul>
              </div>
                <div class="tab-content">
                  @foreach($items as $keyFaccion => $itemsFaccion)
                  <div id="ac{{ $keyFaccion }}" class="tab-pane fade" >
                    <table class="table table-condensed table-items">
                      <caption>
                        @if($keyFaccion == 0) 
                            <span>Subastas Alianza</span>
                          @elseif($keyFaccion == 1)
                            <span>Subastas Horda</span>
                          @else
                            <span>Subastas sin facción</span>
                          @endif
                      </caption>
                      <thead>
                        <tr>
                          <th>Icono</th>
                          <th>Nombre</th>
                          <th>Clase</th>
                          <th>Expansion</th>
                          <th>Precio medio</th>
                          <th>Precio minimo</th>
                          <th>Precio maximo</th>
                          <th>Fecha</th>
                          <th>Total objetos</th>
                          <th>Compra</th>
                          <th>Tiempo restante</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($itemsFaccion as $item)
                      <tr>
                        <!-- <td><img src="http://media.blizzard.com/wow/icons/18/{{ $item['Icono'] }}.jpg"></td> -->
                        <td><a href="http://es.wowhead.com/item={{ $item['Id'] }}" target="_blank"><img src="http://wow.zamimg.com/images/wow/icons/small/{{ $item['Icono'] }}.jpg"></a></td>
                        <td><a href="{{ url('item') }}/{{ $item['Id'] }}">{{ $item['Nombre'] }}</a></td>
                        <td>{{ $item['Clase_nombre'] }} ({{ $item['Subclase_nombre'] }})</td>
                        <td>{{ $item['Expansion'] }}</td>
                        <td>
                          @if($item['Precio_medio']['oros']>0)
                          <span>{{ $item['Precio_medio']['oros'] }}</span><img src="http://wow.zamimg.com/images/icons/money-gold.gif">
                          @endif
                          @if($item['Precio_medio']['platas']>0)
                          <span>{{ $item['Precio_medio']['platas'] }}</span><img src="http://wow.zamimg.com/images/icons/money-silver.gif">
                          @endif
                          @if($item['Precio_medio']['bronces']>0)
                          <span>{{ $item['Precio_medio']['bronces'] }}</span><img src="http://wow.zamimg.com/images/icons/money-copper.gif">
                          @endif
                        </td>
                        <td>
                          @if($item['Precio_minimo']['oros']>0)
                          <span>{{ $item['Precio_minimo']['oros'] }}</span><img src="http://wow.zamimg.com/images/icons/money-gold.gif">
                          @endif
                          @if($item['Precio_minimo']['platas']>0)
                          <span>{{ $item['Precio_minimo']['platas'] }}</span><img src="http://wow.zamimg.com/images/icons/money-silver.gif">
                          @endif
                          @if($item['Precio_minimo']['bronces']>0)
                          <span>{{ $item['Precio_minimo']['bronces'] }}</span><img src="http://wow.zamimg.com/images/icons/money-copper.gif">
                          @endif
                        </td>
                        <td>
                          @if($item['Precio_maximo']['oros']>0)
                          <span>{{ $item['Precio_maximo']['oros'] }}</span><img src="http://wow.zamimg.com/images/icons/money-gold.gif">
                          @endif
                          @if($item['Precio_maximo']['platas']>0)
                          <span>{{ $item['Precio_maximo']['platas'] }}</span><img src="http://wow.zamimg.com/images/icons/money-silver.gif">
                          @endif
                          @if($item['Precio_maximo']['bronces']>0)
                          <span>{{ $item['Precio_maximo']['bronces'] }}</span><img src="http://wow.zamimg.com/images/icons/money-copper.gif">
                          @endif
                        </td>
                        <td>{{ $item['Fecha'] }}</td>
                        <td>{{ $item['Total_objetos'] }}</td>
                        <td>{{ $item['Compra'] }}</td>
                        <td data-sort="{{ $item['Tiempo_restante'] }}">@if($item['Tiempo_restante'] == 'VERY_LONG')
                              <i class="fa fa-clock-o"></i><i class="fa fa-clock-o"></i><i class="fa fa-clock-o"></i>
                            @elseif($item['Tiempo_restante'] == 'LONG')
                              <i class="fa fa-clock-o"></i><i class="fa fa-clock-o"></i>
                            @elseif($item['Tiempo_restante'] == 'MEDIUM')
                              <i class="fa fa-clock-o"></i>
                            @else

                            @endif
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
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