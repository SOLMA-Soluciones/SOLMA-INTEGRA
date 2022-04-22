@extends('layouts.app')

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
                                    href="{{ route('tab1') }}" role="tab">1 Datos Basicos</a>
                                <a class="nav-item nav-link {{ request()->is('tab2') ? 'active' : null }}"
                                    href="{{ route('tab2') }}" role="tab">2 Productos y Tiempo de Ciclo</a>
                                <a class="nav-item nav-link {{ request()->is('tab3') ? 'active' : null }}"
                                    href="{{ route('tab3') }}" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">3 Calendario</a>
                                <a class="nav-item nav-link {{ request()->is('tab4') ? 'active' : null }}"
                                    href="{{ route('tab4') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">4 Motivos de Detención</a>
                                <a class="nav-item nav-link {{ request()->is('tab5') ? 'active' : null }}"
                                    href="{{ route('tab5') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">5 Agregar Usuarios</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
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

                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>

                                    </div>

                                    {!! Form::close() !!}

                                    <table class="table table-striped mt-2">
                                        <tbody>
                                            @foreach ($lineas as $line)
                                                <tr>

                                                    <td>{{ $line->name }}</td>
                                                    <td>

                                                        {!! Form::open(['route' => 'lineas.store', 'method' => 'POST']) !!}

                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td>

                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lineas.destroy', $line->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger ']) !!}
                                                        {!! Form::close() !!}
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
                            <div class="tab-pane {{ request()->is('tab2') ? 'active' : null }}"
                                id="{{ route('tab2') }}" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <a class="btn btn-warning" href="{{ route('products.create') }}">Nuevo</a>

                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">

                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">Num. Parte</th>
                                        <th style="color:#fff;">Descripción</th>
                                        <th style="color:#fff;">Costo ($)</th>
                                        <th style="color:#fff;">Max.Hora</th>
                                        <th style="color:#fff;">Unidad</th>
                                        <th style="color:#fff;">Linea</th>
                                        <th style="color:#fff;">Acciones</th>

                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td style="display: none;">{{ $product->id }}</td>
                                                <td>{{ $product->part_number }}</td>
                                                <td>{{ $product->description}}</td>
                                                <td>{{ $product->cost }}</td>
                                                <td>{{ $product->cycle }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->line->name }}</td>

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('products.edit', $product->id) }}">Editar</a>
                                                    @can('borrar-rol')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
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
                                    <a href="{{ route('tab3') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>

                            </div>
                            <div class="tab-pane {{ request()->is('tab3') ? 'active' : null }}"
                                id="{{ route('tab3') }}" role="tabpanel" aria-labelledby="nav-contact-tab">

                                <div class="container">
                                    <br>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary" role="button" aria-pressed="true"
                                            data-toggle="modal" data-target="#addTurn">Agregar
                                            turno</a>
                                    </div>
                                    <table id="tablaCalendario" class="table table-striped mt-2">
                                        <tr>
                                            <th>Linea</th>
                                            <th>Turno</th>
                                            <th>Dia</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Acciones</th>
                                        </tr>
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
                                                    <td>
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

                            <div class="tab-pane {{ request()->is('tab4') ? 'active' : null }}"
                                id="{{ route('tab4') }}" role="tabpanel" aria-labelledby="nav-about-tab">
                                <div class="col-md-9" class="text-center">
                                    <table class="table table-striped mt-2">
                                        <thead style="background-color:#6777ef">

                                        </thead>
                                        <tbody>
                                            @foreach ($motivos as $stop)
                                                <tr>
                                                    <td style="display: none;">{{ $stop->id }}</td>
                                                    <td>{{ $stop->name }}</td>
                                                    <td id="resp{{ $stop->id }}">
                                                        <br>
                                                        @if ($stop->status == 1)
                                                            <button type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-success">Activa</button>
                                                        @else
                                                            <button type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-danger">Inactiva</button>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <br>
                                                        <label class="switch">

                                                            <input onchange="actualizarEstatus(this)"
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
                                    <a href="{{ route('tab5') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>
                            <div class="tab-pane {{ request()->is('tab5') ? 'active' : null }}"
                                id="{{ route('tab5') }}" role="tabpanel" aria-labelledby="nav-about-tab">

                                <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>

                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">E-mail</th>
                                        <th style="color:#fff;">Rol</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                            <tr>
                                                <td style="display: none;">{{ $user->id }}</td>
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

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
                                                    @can('borrar-rol')
                                                        <form id="formEliminarUsuario_{{$user->id}}" action="{{ route('usuarios.destroy', $user->id) }}"
                                                            class="d-inline" method="POST" >

                                                            @method('DELETE')
                                                            @csrf
                                                            <a class="btn btn-danger btn-eliminar"
                                                            onclick="confirmarEliminar({{$user->id}},0,2)" >Delete</a>
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
                                    <a href="{{'orders'}}" class="btn btn-primary" role="button" style="margin-right: 10px;"
                                        aria-pressed="true">Finalizar</a>
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

    <!-- Modal -->
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
                                <input type="hidden" value="" id="productionline_id" name="productionline_id">
                                <input type="hidden" value="" id="turn" name="productionline_id">
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
                                <br>
                                <label for="name">Hora Inicio</label>
                                {!! Form::time('start_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'start_time']) !!}

                                <label for="name">Hora Fin</label>
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
                                <br>
                                <label for="start_time_turn">Hora Inicio</label>
                                {!! Form::time('start_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'start_time_turn']) !!}

                                <label for="end_time_turn">Hora Fin</label>
                                {!! Form::time('end_time', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'end_time_turn']) !!}
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
                    // var id = $("#idEliminar").val();
                    // var turno = $("#idTurnoEliminar").val();
                    // borrarCalendario(id, turno);
                    // console.log(form);
                    // console.log($(form));
                    // var form = $(form.parent());
                    // form.submit();
                    var id = $("#idEliminar").val();
                    document.getElementById('formEliminarUsuario_'+id).submit();
                    
                    break;
            }

            $('#modalDelete').modal('hide')
        }

        function editarCalendario(id, turn) {
            $("#productionline_id").val(id);
            $("#turn").val(turn);

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
                        $("#start_time").val(oSchedule.start_time);
                        $("#start_time").change();
                        $("#end_time").val(oSchedule.end_time);
                        $("#end_time").change();
                        $("#cLineaEditar").html("Linea: " + oSchedule.name);
                        $("#cTurnoEditar").html("Turno: " + oSchedule.turn);

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
            var data = {
                id: id,
                status: status
            };
            if (status == 1) {
                $(".stoppage" + id).removeClass("btn-danger");
                $(".stoppage" + id).addClass("btn-success");
                $(".stoppage" + id).html("Activa");
                // $(".slider.round:before").css("background-color: #47c363;");
            } else {
                $(".stoppage" + id).removeClass("btn-success");
                $(".stoppage" + id).addClass("btn-danger");
                $(".stoppage" + id).html("Inactiva");
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
    </script>
@endsection
