@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ordenes de Produccion</h3>
        </div>
        <div class="section-body">
            <div class="container" style="padding-right: 0px !important; padding-left: 0px !important;">
                <div class="row">
                    <div class="col-lg-12" style="padding: 0px;">
                        <div class="card">
                            <div class="card-body">
                                <a href="#" class="btn btn-warning" role="button" aria-pressed="true" data-toggle="modal"
                                    data-target="#addTurn">Nueva Orden</a><br><br>
                                <div class="col-sm-12">
                                    <table id="tablaOrdenes" class="display responsive no-wrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <th>Id_Orden</th>
                                            <th class="all">Linea</th>
                                            <th class="all">Producto</th>
                                            <th class=" min-tablet">Cantidad</th>
                                            <th class="min-tablet">Ciclo</th>
                                            <th class="min-tablet">Tiempo Planificado</th>
                                            <th class="all">Estado</th>
                                            <th class="all">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->name_line }}</td>
                                                    <td>{{ $order->part_number }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->cycle }}</td>
                                                    <td>{{ $order->timeplanified }}</td>
                                                    <td>Programado</td>

                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmarEliminar({{ $order->id }},null,1)"><span
                                                                class="material-icons md-48">delete</span></a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id], 'style' => 'display:inline', 'id' => 'formEliminarOrden_' . $order->id]) !!}
                                                        {!! Form::close() !!}

                                                        <a href="javascript:void(0)"
                                                            onclick="editarOrden({{ $order->id }})"><span
                                                                class="material-icons md-48">edit</span></a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal agregar turno -->
    {{-- <a id="displayModalAddTurn" style="display:none" href="#" data-toggle="modal" data-target="#addTurn"></a> --}}

    <!-- Modal Agregar turno -->
    <div class="modal fade" id="addTurn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {!! Form::open(['route' => 'orders.store', 'method' => 'POST']) !!}
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectLines">Lineas de producción</label>
                                    <select class="form-control" id="selectLines" onchange="actualizarSelects(this)"
                                        name="productionline_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        @foreach ($lineas as $line)
                                            <option value="{{ $line->id }}">{{ $line->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectTurn">Turno</label>
                                    <select class="form-control" id="selectTurn" name="schedule_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectProducts">Productos</label>
                                    <select class="form-control" id="selectProducts" onchange="asignarTiempoCiclo(this)"
                                        name="product_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tiempo_ciclo">Tiempo de ciclo</label>
                                    <input type="number" class="form-control" id="tiempo_ciclo" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad"
                                        onchange="calcularTiempoPlanificado(this)" onkeyup="calcularTiempoPlanificado(this)"
                                        name="total" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tplanificado">Tiempo planificado(HH:MM)</label>
                                    <input type="text" class="form-control" id="tplanificado" disabled>
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
    </div>

    {{-- Modal editar ordenar --}}
    <div class="modal fade" id="modalEditarOrden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {!! Form::open(['route' => ['orders.update', 1], 'method' => 'PATCH']) !!}
                    <input type="hidden" name="id" value="" id="idOrderUpdate">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectLinesUpdate">Lineas de producción</label>
                                    <select class="form-control" id="selectLinesUpdate"
                                        onchange="actualizarSelectsUpdate(this)" name="productionline_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        @foreach ($lineas as $line)
                                            <option value="{{ $line->id }}">{{ $line->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectTurnUpdate">Turno</label>
                                    <select class="form-control" id="selectTurnUpdate" name="schedule_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="selectProductsUpdate">Productos</label>
                                    <select class="form-control" id="selectProductsUpdate"
                                        onchange="asignarTiempoCicloUpdate(this)" name="product_id" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tiempo_cicloUpdate">Tiempo de ciclo</label>
                                    <input type="number" class="form-control" id="tiempo_cicloUpdate" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cantidadUpdate">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidadUpdate"
                                        onchange="calcularTiempoPlanificadoUpdate(this)"
                                        onkeyup="calcularTiempoPlanificadoUpdate(this)" name="total" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tplanificadoUpdate">Tiempo planificado(HH:MM)</label>
                                    <input type="text" class="form-control" id="tplanificadoUpdate" disabled>
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
    </div>
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

    {{-- Modal eliminar --}}


    {{-- <a href="#" id="modalEliminar" role="button" style="display: none;" data-toggle="modal"
            data-target="#modalDelete"></a> --}}
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
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
                "next": ">",
                "previous": "<"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de forma ascendente",
                "sortDescending": ": Activar para ordenar la columna de forma descendente"
            }
        };
        $(document).ready(function() {
            $('#tablaOrdenes').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'frtip',
                "columnDefs": [{
                    "targets": [0],
                    "visible": false
                }]
            });



        });

        function buscarTurno(element) {
            var id = $(element).val();
            $.ajax({
                url: 'turns/' + id,
                // data: data,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    response.forEach(function(Turn) {
                        $('#selectTurn').append($('<option>', {
                            value: Turn.id,
                            text: Turn.turn
                        }));
                    });


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

        function buscarProductos(element) {
            var id = $(element).val();
            $.ajax({
                url: 'productsfiltered/' + id,
                // data: data,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    response.forEach(function(Product) {
                        $('#selectProducts').append($('<option>', {
                            value: Product.id,
                            text: Product.part_number,
                            cycle: Product.cycle
                        })).change();
                    });


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

        function buscarTurnoUpdate(element) {
            var id = $(element).val();
            $.ajax({
                url: 'turns/' + id,
                // data: data,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    response.forEach(function(Turn) {
                        $('#selectTurnUpdate').append($('<option>', {
                            value: Turn.id,
                            text: Turn.turn
                        }));
                    });


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

        function buscarProductosUpdate(element) {
            var id = $(element).val();
            $.ajax({
                url: 'productsfiltered/' + id,
                // data: data,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    response.forEach(function(Product) {
                        $('#selectProductsUpdate').append($('<option>', {
                            value: Product.id,
                            text: Product.part_number,
                            cycle: Product.cycle
                        })).change();
                    });


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

        function actualizarSelects(select) {
            buscarTurno(select);
            buscarProductos(select);
        }

        function actualizarSelectsUpdate(select) {
            buscarTurnoUpdate(select);
            buscarProductosUpdate(select);
        }

        function asignarTiempoCiclo(element) {
            var ciclo = $(element).find("option:selected").attr("cycle");
            // $( "#myselect option:selected" ).text();
            console.log(ciclo);
            $("#tiempo_ciclo").val(ciclo);
        }

        function asignarTiempoCicloUpdate(element) {
            var ciclo = $(element).find("option:selected").attr("cycle");
            // $( "#myselect option:selected" ).text();
            console.log(ciclo);
            $("#tiempo_cicloUpdate").val(ciclo);
        }

        function calcularTiempoPlanificado(element) {
            var cantidad = $(element).val();
            var tCiclo = $("#tiempo_ciclo").val();

            var tPlanificado = convertMinsToHrsMins((cantidad / tCiclo) * 60);
            console.log(tPlanificado);
            $("#tplanificado").val(tPlanificado);
        }

        function calcularTiempoPlanificadoUpdate(element) {
            var cantidad = $(element).val();
            var tCiclo = $("#tiempo_cicloUpdate").val();

            var tPlanificado = convertMinsToHrsMins((cantidad / tCiclo) * 60);
            console.log(tPlanificado);
            $("#tplanificadoUpdate").val(tPlanificado);
        }
        const convertMinsToHrsMins = (mins) => {
            let h = Math.floor(mins / 60);
            let m = Math.round(mins % 60);
            h = h < 10 ? '0' + h : h; // (or alternatively) h = String(h).padStart(2, '0')
            m = m < 10 ? '0' + m : m; // (or alternatively) m = String(m).padStart(2, '0')

            // h = String(h).padStart(2, '0');
            // m = String(m).padStart(2, '0');
            return `${h}:${m}`;
        }

        function confirmarEliminar(id, id_2, iTipoEliminar) {
            console.log(id);
            console.log(iTipoEliminar);
            $("#iTipoEliminar").val(iTipoEliminar);
            $("#idEliminar").val(id);
            // $("#idTurnoEliminar").val(turn);
            $('#modalDelete').modal('show');
        }

        function eliminarRegistro() {
            var iTipo = parseInt($("#iTipoEliminar").val());
            console.log(iTipo);
            $(".spinner-border").show();
            switch (iTipo) {

                case 1:
                    var id = $("#idEliminar").val();
                    document.getElementById('formEliminarOrden_' + id).submit();

                    break;

            }

            $('#modalDelete').modal('hide');
        }

        function editarOrden(id) {
            console.log(id);
            $.ajax({
                url: 'orders/' + id,
                type: 'get',
                // data: data,
                success: function(response) {
                    console.log(response);
                    $("#idOrderUpdate").val(response.id);
                    $("#selectLinesUpdate").val(response.productionline_id).change();
                    $("#selectTurnUpdate").val(response.schedule_id).change();
                    $("#selectProductsUpdate").val(response.product_id).change();

                    setTimeout(() => {
                        $("#cantidadUpdate").val(response.total).change();
                    }, 500);

                    // var tPlanificado = convertMinsToHrsMins((response.total / ) * 60);
                    // $("#tplanificadoUpdate").val(tPlanificado);
                    //selectTurnUpdate//cantidadUpdate
                    $('#modalEditarOrden').modal('show');
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }
    </script>
@endsection
