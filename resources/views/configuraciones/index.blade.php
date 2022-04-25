@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <style>
        .chip {
            display: inline-block;
            padding: 0 25px;
            height: 50px;
            font-size: 16px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #f1f1f1;
        }

        .chip img {
            float: left;
            margin: 0 10px 0 -25px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        .tab-pane {
            margin: 15px;
        }

        .tab-content {
            padding: 0 !important;
            /* width: 100% !important; */
        }

        

    </style>
    @php
    function replaceDay($string)
    {
        $string = str_replace('1', 'Lunes', $string);
        $string = str_replace('2', 'Martes', $string);
        $string = str_replace('3', 'Miercoles', $string);
        $string = str_replace('4', 'Jueves', $string);
        $string = str_replace('5', 'Viernes', $string);
        $string = str_replace('6', 'Sabado', $string);
        $string = str_replace('7', 'Domingo', $string);
        return $string;
    }
    @endphp

    <section class="section">

        <div class="section-header">
            <h3 class="page__heading">Configuracion</h3>
            &nbsp;&nbsp;&nbsp;
            <div style="display: none;" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="section-body">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 ">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link {{ request()->is('tab1') ? 'active' : null }}"
                                    href="{{ route('tab1') }}" role="tab">Datos Basicos</a>
                                <a class="nav-item nav-link {{ request()->is('tab3') ? 'active' : null }}"
                                    href="{{ route('tab3') }}" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Calendario</a>
                                <a class="nav-item nav-link {{ request()->is('tab4') ? 'active' : null }}"
                                    href="{{ route('tab4') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">Motivos de Detención</a>
                                <a class="nav-item nav-link {{ request()->is('tab2') ? 'active' : null }}"
                                    href="{{ route('tab2') }}" role="tab">Productos y Tiempo de Ciclo</a>
                                <a class="nav-item nav-link {{ request()->is('tab5') ? 'active' : null }}"
                                    href="{{ route('tab5') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">Agregar Usuarios</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            {{-- lineas de produccion --}}
                            <div class="tab-pane {{ request()->is('tab1') ? 'active' : null }}"
                                id="{{ route('tab1') }}" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card-body">
                                    {!! Form::open(['route' => 'lineas.store', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Agregue Lineas de Fabricacion</label>
                                                {!! Form::text('name', null, ['class' => 'form-control']) !!}

                                            </div>

                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        {{-- <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div> --}}

                                    </div>

                                    {!! Form::close() !!}

                                    <table id="tablaLineas" class="display responsive no-wrap" cellspacing="0" width="100%">
                                        <thead>

                                            <th>Nombre</th>
                                            <th >Acciones</th>

                                        </thead>
                                        <tbody>
                                            @foreach ($lineas as $line)
                                                <tr>

                                                    <td>{{ $line->name }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmarEliminar({{ $line->id }},null,4)"><span
                                                                class="material-icons md-48">delete</span></a>

                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lineas.destroy', $line->id], 'style' => 'display:inline', 'id' => 'formeliminarlinea_' . $line->id]) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="text-right">
                                    <a href="{{ route('tab3') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>
                            {{-- productos --}}
                            <div class="tab-pane {{ request()->is('tab2') ? 'active' : null }}"
                                id="{{ route('tab2') }}" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <a class="btn btn-warning" href="{{ route('products.create') }}">Nuevo</a>
                                <br><br>

                                <table id="example" class="display responsive no-wrap" cellspacing="0" width="100%">
                                    <thead>

                                        <th>ID</th>
                                        <th>Num. Parte</th>
                                        <th>Descripción</th>
                                        <th>Costo ($)</th>
                                        <th>Max.Hora</th>
                                        <th>Unidad</th>
                                        <th>Linea</th>
                                        <th>Acciones</th>

                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td> {{ $product->id }}</td>
                                                <td>{{ $product->part_number }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->cost }}</td>
                                                <td>{{ $product->cycle }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->line->name }}</td>
                                                <td >
                                                    <a class=""
                                                        href="{{ route('products.edit', $product->id) }}"><span
                                                            class="material-icons md-48">edit</span></a>

                                                    <a href="javascript:void(0)"
                                                        onclick="confirmarEliminar({{ $product->id }},null,3)"><span
                                                            class="material-icons md-48">delete</span></a>

                                                    @can('borrar-rol')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'style' => 'display:inline', 'id' => 'formeliminarproducto_' . $product->id]) !!}
                                                        {{-- {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!} --}}

                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Centramos la paginacion a la derecha -->
                                <div class="pagination justify-content-end">
                                    {!! $products->links() !!}
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('tab5') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>

                            </div>
                            {{-- calendario --}}
                            <div class="tab-pane {{ request()->is('tab3') ? 'active' : null }}"
                                id="{{ route('tab3') }}" role="tabpanel" aria-labelledby="nav-contact-tab">

                                <div >
                                    <br>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary" role="button" aria-pressed="true"
                                            data-toggle="modal" data-target="#addTurn">Agregar
                                            turno</a>
                                    </div>
                                    <br>
                                    <table id="tablaCalendario" class="display responsive" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <th>Linea</th>
                                            <th>Turno</th>
                                            <th>Dia</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr>
                                                    <td>{{ $schedule->line }}</td>
                                                    <td>{{ $schedule->turn }}</td>
                                                    <td>
                                                        @if ($schedule->day != null)
                                                            {{ replaceDay($schedule->day) }}
                                                        @else
                                                            Sin datos
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($schedule->start_time != null)
                                                            {{ $schedule->start_time }}
                                                        @else
                                                            No hay Datos
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($schedule->end_time != null)
                                                            {{ $schedule->end_time }}
                                                        @else
                                                            No hay Datos
                                                        @endif
                                                    </td>
                                                    <td >
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmarEliminar({{ $schedule->productionline_id }},{{ $schedule->turn }},1)"><span
                                                                class="material-icons md-48">delete</span></a>

                                                        <a href="javascript:void(0)"
                                                            onclick="editarCalendario({{ $schedule->productionline_id }},{{ $schedule->turn }})"><span
                                                                class="material-icons md-48">edit</span></a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-right">
                                        <a href="{{ route('tab4') }}" class="btn btn-primary" role="button"
                                            aria-pressed="true">Siguiente</a>
                                    </div>
                                </div>

                            </div>
                            {{-- paros de produccion --}}
                            <div class="tab-pane {{ request()->is('tab4') ? 'active' : null }}"
                                id="{{ route('tab4') }}" role="tabpanel" aria-labelledby="nav-about-tab">
                                <div class="col-md-9" class="text-center">
                                    <div class="col-md-6">
                                        <label for="stoppage_productionline_id">Linea de producción</label>
                                        <select id="stoppage_productionline_id" name="stoppage_productionline_id"
                                            class="selectpicker col-xs-12 col-sm-12 col-md-12"
                                            onchange="actualizarParosProduccion(this)" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            @foreach ($lineas as $line)
                                                <option value="{{ $line->id }}">{{ $line->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <table id="tableStoppage" class="table table-striped mt-2" style="display: none">
                                        <thead style="background-color:#6777ef">

                                        </thead>
                                        <tbody>
                                            @foreach ($motivos as $stop)
                                                <tr>
                                                    <td style="display: none;">{{ $stop->id }}</td>
                                                    <td>{{ $stop->name }}</td>
                                                    <td id="resp{{ $stop->id }}">
                                                        <br>
                                                        <button id="btnstoppagetext_{{ $stop->id }}" type="button"
                                                            class="stoppage{{ $stop->id }} btn btn-sm btn-danger">Inactiva</button>
                                                        {{-- @if ($stop->status == 1)
                                                            <button type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-success">Activa</button>
                                                        @else
                                                            <button type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-danger">Inactiva</button>
                                                        @endif --}}

                                                    </td>
                                                    <td>
                                                        <br>
                                                        <label class="switch">

                                                            <input id="btnstoppage_{{ $stop->id }}"
                                                                onchange="actualizarEstatus(this)"
                                                                data-id="{{ $stop->id }}" class="mi_checkbox"
                                                                type="checkbox" data-onstyle="success"
                                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                                data-off="InActive" {{ $stop->status ? 'checked' : '' }}>
                                                            <span class="slider round"></span>



                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('tab2') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>
                            {{-- usuarios --}}
                            <div class="tab-pane {{ request()->is('tab5') ? 'active' : null }}"
                                id="{{ route('tab5') }}" role="tabpanel" aria-labelledby="nav-about-tab">

                                <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>

                                <table id="tablaUsuarios" class="display responsive no-wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>E-mail</th>
                                        <th>Rol</th>
                                        <th >Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $rolNombre)
                                                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td >
                                                    <a href="{{ route('usuarios.edit', $user->id) }}"><span
                                                            class="material-icons md-48">edit</span></a>
                                                    @can('borrar-rol')
                                                        <form id="formEliminarUsuario_{{ $user->id }}"
                                                            action="{{ route('usuarios.destroy', $user->id) }}"
                                                            class="d-inline" method="POST">

                                                            @method('DELETE')
                                                            @csrf
                                                            <a href="javascrip:void(0);" class="btn-eliminar"
                                                                onclick="confirmarEliminar({{ $user->id }},0,2)"><span
                                                                    class="material-icons md-48">delete</span></a>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Centramos la paginacion a la derecha -->
                                <div class="pagination justify-content-end">
                                    {!! $usuarios->links() !!}
                                </div>
                                <div class="text-right">
                                    <a href="{{ 'orders' }}" class="btn btn-primary" role="button"
                                        style="margin-right: 10px;" aria-pressed="true">Finalizar</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
    </section>

    <!-- Button trigger modal -->
    <a id="displayModalEditSchedule" style="display:none" href="#" data-toggle="modal" data-target="#exampleModal"></a>

    <!-- Modal editar turno-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => ['schedules.update', 1], 'method' => 'PATCH']) !!}
                <div class="modal-body">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group ">
                                <input type="hidden" value="" id="productionline_id_edit" name="productionline_id">
                                <input type="hidden" value="" id="turn_edit" name="turn">
                                {{-- <input type="hidden" value="" id="productionline_id" name="productionline_id"> --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="chip" id="cLineaEditar">

                                    </div>
                                    <div class="chip" id="cTurnoEditar">

                                    </div>
                                </div>
                                <br>
                                <label for="selectSchedule">Frecuencia semanal</label>
                                <select id="selectSchedule" name="selectSchedule[]"
                                    class="selectpicker col-xs-12 col-sm-12 col-md-12" multiple>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                </select>
                                <br><br>
                                <div class="form-check col-xs-6">
                                    <input type="checkbox" class="form-check-input" id="fulltime_edit" name="fulltime"
                                        onchange="updateTimeFieldsEdit(this)">
                                    <label class="form-check-label" for="fulltime_edit">24 Horas</label>
                                </div>
                                <br>
                                <label for="start_time">Hora Inicio</label>
                                {!! Form::time('start_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'start_time']) !!}

                                <label for="end_time">Hora Fin</label>
                                {!! Form::time('end_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'end_time']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <!-- Button trigger modal agregar turno -->
    {{-- <a id="displayModalAddTurn" style="display:none" href="#" data-toggle="modal" data-target="#addTurn"></a> --}}

    <!-- Modal Agregar turno -->
    <div class="modal fade" id="addTurn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar turno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'schedules.store', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group ">
                                {{-- @foreach ($lineas as $line) --}}
                                <label for="productionline_id">Linea de producción</label>
                                <select id="productionline_id" name="productionline_id"
                                    class="selectpicker col-xs-12 col-sm-12 col-md-12" required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($lineas as $line)
                                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                {{-- <input type="hidden" value="" id="productionline_id"> --}}
                                <label for="days">Frecuencia semanal</label>
                                <select id="days" name="days[]" class="selectpicker col-xs-12 col-sm-12 col-md-12" multiple
                                    required>
                                    {{-- <option selected disabled>Seleccione una opción</option> --}}
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                </select>
                                <br><br>
                                <div class="form-check col-xs-6">
                                    <input type="checkbox" class="form-check-input" id="checkbox_24hrs" name="fulltime"
                                        onchange="updateTimeFields(this)" checked>
                                    <label class="form-check-label" for="checkbox_24hrs">24 Horas</label>
                                </div>
                                <br>
                                <div class="col-xs-6">
                                    <label for="start_time_turn">Hora Inicio</label>
                                    {!! Form::time('start_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'start_time_turn']) !!}
                                </div>


                                <div class="col-xs-6">
                                    <label for="end_time_turn">Hora Fin</label>
                                    {!! Form::time('end_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'end_time_turn']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    {{-- Modal eliminar --}}

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Advertencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <p>¿Desea eliminar el registro?</p>
                        <input type="hidden" id="idEliminar" value="">
                        <input type="hidden" id="idTurnoEliminar" value="">
                        <input type="hidden" id="iTipoEliminar" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button onclick="eliminarRegistro()" class="btn btn-primary">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="modalEliminar" role="button" style="display: none;" data-toggle="modal" data-target="#modalDelete"></a>
@endsection
@section('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El usuario ha sido eliminado.',
                'con exito'
            )
        </script>
    @endif

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        var aLanguageDataTable = {
            "decimal": ".",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando del 0 al 0 de 0 registros",
            "infoFiltered": "(Filtrados desde _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de forma ascendente",
                "sortDescending": ": Activar para ordenar la columna de forma descendente"
            }
        };

        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'frtip',
            });
            $('#tablaCalendario').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'frtip',
            });
            $('#tablaUsuarios').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'frtip',
                "columnDefs": [{
                    "targets": [0],
                    "visible": false
                }]
            });
            $('#tablaLineas').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'frtip',
            });
        });
    </script>
    <script type="text/javascript">
        var form = null;

        function eliminarRegistro() {
            var iTipo = parseInt($("#iTipoEliminar").val());
            $(".spinner-border").show();
            switch (iTipo) {
                case 1:
                    var id = $("#idEliminar").val();
                    var turno = $("#idTurnoEliminar").val();
                    borrarCalendario(id, turno);
                    break;
                case 2:
                    var id = $("#idEliminar").val();
                    document.getElementById('formEliminarUsuario_' + id).submit();

                    break;
                case 3:
                    var id = $("#idEliminar").val();
                    document.getElementById('formeliminarproducto_' + id).submit();
                    break;
                case 4:
                    var id = $("#idEliminar").val();
                    document.getElementById('formeliminarlinea_' + id).submit();
                    break;
            }

            $('#modalDelete').modal('hide')
        }

        function editarCalendario(id, turn) {
            $("#productionline_id_edit").val(id);
            $("#turn_edit").val(turn);

            var data = {
                turn: turn,
                id: id
            }
            var b64 = btoa(JSON.stringify(data));
            $.ajax({
                url: 'schedules/' + b64,
                type: 'get',
                // data: data,
                success: function(response) {
                    var arr = [];
                    response.forEach(function(oSchedule) {
                        arr.push(oSchedule.day);
                    });
                    $("#selectSchedule").val(arr);
                    $("#selectSchedule").change();
                    if (response.length > 0) {
                        let oSchedule = response[0];
                        // console.log(oSchedule.start_time);

                        $("#cLineaEditar").html("Linea: " + oSchedule.name);
                        $("#cTurnoEditar").html("Turno: " + oSchedule.turn);
                        if (oSchedule.fulltime == 1) {
                            $("#fulltime_edit").prop("checked", true);
                            updateTimeFieldsEdit($("#fulltime_edit"));
                            // $("#start_time").val(null).change();
                            // $("#end_time").val(null).change();
                        } else {
                            $("#start_time").val(oSchedule.start_time);
                            $("#start_time").change();
                            $("#end_time").val(oSchedule.end_time);
                            $("#end_time").change();
                        }

                    }
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
            $("#displayModalEditSchedule").click();
            var data = $("#selectSchedule").val();
            // console.log(data);
        }

        function confirmarEliminar(id, turn, iTipoEliminar) {
            $("#iTipoEliminar").val(iTipoEliminar);
            $("#idEliminar").val(id);
            $("#idTurnoEliminar").val(turn);
            $("#modalEliminar").click();
        }

        function borrarCalendario(id, turn) {
            var data = {
                turn: turn,
                id: id
            }
            var b64 = btoa(JSON.stringify(data));
            $.ajax({
                url: 'schedules/' + b64,
                type: 'delete',
                // data: data,
                success: function(response) {
                    $(".spinner-border").hide();
                    location.reload();
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }




        function actualizarEstatus(element) {
            let id = $(element).attr("data-id");
            let status = ($(element).is(':checked')) ? 1 : 0;
            let productionline_id = $("#stoppage_productionline_id").val();

            var data = {
                id: id,
                status: status,
                productionline_id: productionline_id
            };
            if (status == 1) {
                $(".stoppage" + id).removeClass("btn-danger");
                $(".stoppage" + id).addClass("btn-success");
                $(".stoppage" + id).html("Activo");
                // $(".slider.round:before").css("background-color: #47c363;");
            } else {
                $(".stoppage" + id).removeClass("btn-success");
                $(".stoppage" + id).addClass("btn-danger");
                $(".stoppage" + id).html("Inactivo");
                // $(".slider.round:before").css("background-color: #FFFFFF;");
            }
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                url: 'motivos',
                data: data,
                type: 'post',
                success: function(response) {
                    // alert(response);
                    console.log(response);
                },
                statusCode: {
                    // 404: function() {
                    //     alert('web not found');
                    // }
                },
                error: function(x, xs, xt) {
                    // window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

        function actualizarParosProduccion(select) {
            console.log($(select).val());
            var id = $(select).val();
            $.ajax({
                url: 'motivos/' + id,
                // data: data,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    console.log(response);

                    response.forEach(function(oStop) {
                        if (oStop.iEstatus == 1) {
                            $("#btnstoppage_" + oStop.id).attr("checked", true);
                            $("#btnstoppagetext_" + oStop.id).removeClass("btn-danger");
                            $("#btnstoppagetext_" + oStop.id).addClass("btn-success");
                            $("#btnstoppagetext_" + oStop.id).html("Activo");
                            console.log(true);
                        } else {
                            $("#btnstoppage_" + oStop.id).attr("checked", false);
                            $("#btnstoppagetext_" + oStop.id).removeClass("btn-success");
                            $("#btnstoppagetext_" + oStop.id).addClass("btn-danger");
                            $("#btnstoppagetext_" + oStop.id).html("Inactivo");
                            console.log(false);
                        }
                    });
                    $("#tableStoppage").show();
                },
                statusCode: {
                    // 404: function() {
                    //     alert('web not found');
                    // }
                },
                error: function(x, xs, xt) {
                    // window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

        function updateTimeFields(check) {
            console.log($(check).prop("checked"));
            if ($(check).prop("checked")) {
                $("#start_time_turn").prop("disabled", true);
                $("#end_time_turn").prop("disabled", true);
                $("#start_time_turn").val(null).change();
                $("#end_time_turn").val(null).change();
            } else {
                $("#start_time_turn").prop("disabled", false);
                $("#end_time_turn").prop("disabled", false);

                $("#start_time_turn").prop("required", true);
                $("#end_time_turn").prop("required", true);
            }
        }

        function updateTimeFieldsEdit(check) {
            console.log($(check).prop("checked"));
            if ($(check).prop("checked")) {
                $("#start_time").prop("disabled", true);
                $("#end_time").prop("disabled", true);
                $("#start_time").val(null).change();
                $("#end_time").val(null).change();
            } else {
                $("#start_time").prop("disabled", false);
                
                $("#end_time").prop("disabled", false);
                
                $("#start_time").prop("required", true);
                $("#end_time").prop("required", true);
            }
        }
    </script>
@endsection