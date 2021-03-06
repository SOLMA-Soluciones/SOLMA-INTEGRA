
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @can('ver-user')
    <a class="nav-link" href="{{ route('tab1') }}">
        <i class=" fas fa-building"></i><span>Panel OEE</span>
    </a>
    @endcan
    <a class="nav-link" href="{{route('orders.index')}}">
        <i class=" fas fa-plus-circle"></i><span>Orden de Produccion</span>
    </a>
    {{-- <a class="nav-link" href="/ordproces">
        <i class=" fas fa-clock"></i><span>Ordenes en proceso</span>
    </a> --}}
    
    <a class="nav-link" href="{{ route('timers.index') }}">
        <i class=" fas fa-clock"></i><span>Timer</span>
    </a>
    <a class="nav-link" href="{{ route('reportes.index') }}">
    <i class="fas fa-chart-line"></i><span>Reportes</span>
    </a>

    @can('ver-user')
    <a class="nav-link" href="{{ route('tab1') }}">
        <i class=" fas fa-cog"></i><span>Configuración </span>
    </a>
    @endcan
</li>
