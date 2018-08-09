  @if(!empty($clases))
  <ul class="list-group panel">
    <li>
      <a href="#li_clases" class="list-group-item " data-toggle="collapse"><i class="fa fa-group"></i>Clases  <span class="glyphicon glyphicon-chevron-right"></span></a>
        <li class="collapse" id="li_clases">
          @foreach($clases as $keyClase => $clase)
          <ul style="list-style:  none; margin-left: -30px;">
            <li>
              <a href="#li_{{ $keyClase }}" class="list-group-item " data-toggle="collapse">
                <i class=" @if(!empty($iconos[$nombres[$keyClase]])) fa {{ $iconos[$nombres[$keyClase]] }} @else fa fa-certificate @endif">
                </i>
                {{ $nombres[$keyClase] }}
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
              <li class="collapse" id="li_{{ $keyClase }}">
                <a href="{{ url('allClass') }}/{{ $keyClase }}" class="list-group-item">Todos</a>
                @foreach($clase as $keySub => $subclase)
                  <a href="{{ url('class') }}/{{ $keyClase }}/{{ $keySub }}" class="list-group-item">{{ $subclase['Subclase_nombre'] }}</a>
                @endforeach
              </li>
            </li>
          </ul>
          @endforeach
        </li>
    </li>
  </ul>
  @endif

