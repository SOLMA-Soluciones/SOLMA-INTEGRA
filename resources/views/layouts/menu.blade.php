
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @can('ver-user')
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Panel OEE</span>
    </a>
    <a class="nav-link" href="/">
        <i class=" fas fa-plus-circle"></i><span>Orden de Produccion</span>
    </a>
    @endcan
    <a class="nav-link" href="/motivos">
        <i class=" fas fa-clock"></i><span>Timer</span>
    </a>
    @can('ver-user')
    <a class="nav-link" href="/tab1">
        <i class=" fas fa-cog"></i><span>Configuración </span>
    </a>
    @endcan
   
   
</li>
