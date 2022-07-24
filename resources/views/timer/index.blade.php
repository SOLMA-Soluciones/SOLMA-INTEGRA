@extends('layouts.app')



@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .chip {
            display: inline-block;
            padding: 0 25px;
            height: 50px;
            font-size: 16px;
            line-height: 50px;
            border-radius: 25px;
            /* background-color: #f1f1f1; */
        }


        .stoppage {
            margin-top: 15px;
            border-radius: 40px;
            ;
        }

        .chips>.chip {
            margin-top: 15px;
        }


        .header-info {
            /* border: 2px solid gray;
                border-radius: 5px;
                padding: 5px;
                padding-top: 10px; */

        }

        .header-item {
            /* border: 1px solid gray;
                padding: 5px;
                font-size: 16px; */
            /* padding-top: 10px !important; */
            background-color: #00838f;
            border-radius: 20px;
            padding: 5px;
            margin: 2px;
            color: #ffffff;
        }

        .card-header {
            background-color: gray !important;
        }

        .collapse-header {
            /* padding: 10px; */
            padding-left: 10px;
            padding-top: 5px;
            background-color: #6777ef;
            color: #ffffff;

        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Timer</h3>
        </div>




        <div class="section-body">
        <div class="container" style="padding-right: 0px !important; padding-left: 0px !important;"  >

            <div class="row">
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="card">
                        <div class="card-body"style="padding: 0px !important;">
                            <div class="row">
                                <div class="panel-body col-12">
                                    {{-- <div class="col-sm-12 chips">
                                        <div class="chip btn-info">
                                            <span><b>Linea:</b> {{ $order->name_line }}<span>
                                        </div>
                                        <div class="chip btn-info">
                                            <span><b>Turno:</b>{{ $order->turn }}<span>
                                        </div>
                                        <div class="chip btn-info">
                                            <span><b>Producto:</b> {{ $order->part_number }}<span>
                                        </div>
                                        <div class="chip btn-success">
                                            <span><b>Estatus:</b> Programado<span>
                                        </div>

                                    </div> --}}

                                    {{-- <div class="col-12">
                                        <h3>Infomación</h3>
                                    </div>
                                     {{-- <div class="col-sm-12">

                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Total:</b>100 piezas</li>
                                            <li class="list-group-item"><b>Scrap:</b>100 piezas</li>
                                            <li class="list-group-item"><b>Tiempo esperado:</b>22:00:00</li>
                                            <li class="list-group-item"><b>Tiempo total:</b>21:00:00</li>
                                            <li class="list-group-item"><b>Tiempo total de detención:</b>01:00:00</li>
                                        </ul>
                                    </div> --}}

                                    {{-- <div class="col-12">
                                        <div >
                                            <button class="btn btn-info float-right">Finalizar</button>
                                        </div>
                                    </div> --}}



                                    <div id="accordion">
                                            <div class="col-12" id="capturarScrap" style="display: none">
                                                <button type="button" class="btn btn-success"
                                                    onclick="capturarTotalScrap()">Total & Scrap</button>
                                            </div><br>

                                            <div class="collapse-header" id="headingGeneric" data-toggle="collapse"
                                                data-target="#collapseGeneric" aria-expanded="true"
                                                aria-controls="collapseGeneric">
                                                <h6>Datos Generales</h6>
                                            </div>
                                            <div id="collapseGeneric" class="collapse show"
                                                aria-labelledby="headingGeneric" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                            <span
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Linea:</b> {{ $order->name_line }}</label>
                                                                <input type="hidden" id="order_id" name="order_id"
                                                                    value="{{ $id }}">
                                                            </span>
                                                            <span
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Turno:</b> {{ $order->turn }}</label>
                                                            </span>
                                                            <span
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Producto:</b> {{ $order->part_number }}</label>
                                                            </span>
                                                            <span
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Estatus:</b> Programado</label>
                                                            </span>
                                                            <span style="display: none" id="spanHoraInicio"
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Hora inicio:</b> <span
                                                                        id="lblHoraInicio">00:00:00</span></label>
                                                            </span>
                                                            <span style="display: none" id="spanHoraFin"
                                                                class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                <label><b>Hora fin:</b><span id="lblHoraFin">00:00:00</span>
                                                                </label>
                                                            </span>
                                                            @if ($order->scrap != null || $order->scrap != 0)
                                                                <span
                                                                    class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                    <label><b>Scrap:</b><span>{{ $order->scrap }}</span>
                                                                    </label>
                                                                </span>
                                                            @endif
                                                            @if ($order->total_produced != null || $order->total_produced != 0)
                                                                <span
                                                                    class="col-xs-12 col-sm-6 col-md-3 col-lg-4 col-xl-3 header-item">
                                                                    <label><b>Total
                                                                            producido:</b><span>{{ $order->total_produced }}</span>
                                                                    </label>
                                                                </span>
                                                            @endif
                                                        </div>
                                                </div>
                                            </div>
                                            {{-- paros produccion --}}
                                            <div class="collapse-header paro-container" id="headingParos"
                                                data-toggle="collapse" data-target="#collapseParos" aria-expanded="true"
                                                aria-controls="collapseParos">
                                                <h6>Paros de producción</h6>
                                            </div>
                                            <div id="collapseParos" class="collapse show paro-container"
                                                aria-labelledby="headingParos" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                                                            @if ($order->productionorderstatus_id == 1)
                                                                <button id="btnIniciarOrden"
                                                                    class="btn btn-success stoppage"
                                                                    onclick="iniciarDetenerProceso(this)"
                                                                    style="width: 100%">Iniciar</button>
                                                            @elseif($order->productionorderstatus_id == 2)
                                                                <button id="btnIniciarOrden" class="btn btn-danger stoppage"
                                                                    onclick="iniciarDetenerProceso(this)"
                                                                    style="width: 100%">Finalizar</button>
                                                            @endif


                                                        </div>
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($stoppages as $stoppage)
                                                            @if ($stoppage->iEstatus == '1')
                                                                <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                                                                    <button class="btn stoppage"
                                                                        style="width: 100%; background-color: {{ $colors[$index] }}"
                                                                        onclick="iniciarParo(this)"
                                                                        data="{{ $stoppage->id }}" status="stopped"
                                                                        disabled>{{ $stoppage->name }}</button>
                                                                </div>
                                                                @php
                                                                    $index++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="collapse-header" id="headingOne" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h6>Historial</h6>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <table id="tablaParos" class="display responsive no-wrap"
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <th>Nombre</th>
                                                            <th>Hora Inicio</th>
                                                            <th>Hora Fin</th>
                                                            <th>Tiempo</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($StoppagesExecuted as $SE)
                                                                <tr>
                                                                    <td>{{ $SE->name_stoppage }}</td>
                                                                    <td>{{ $SE->start_time }}</td>
                                                                    <td>{{ $SE->end_time }}</td>
                                                                    <td>---</td>
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
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <div class="modal fade" id="modalStoppage" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-light" id="modalStoppageTitle"></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="productionstoppage_id" id="productionstoppage_id" value="">
                        <div class="col-12">
                            <p>Hora de Inicio: <b id="horaInicioCron"></b></p>
                        </div>
                        <div class="col-12">
                            <p>Tiempo transcurrido: <b id="cronometro"></b></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="detenerParo(this)" class="btn btn-primary">Detener</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirmarInicioOrden" tabindex="-1" role="dialog" aria-labelledby=""
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6777ef">
                    <h5 class="modal-title text-light">Iniciar</h5>
                </div>

                <div class="modal-body">
                    <p>Confirma si desea iniciar la orden de producción, una vez realizada esta acción, solo se podrá
                        generar un paro de producción o finalizar la orden.</p>
                    <p>Hora actual: <b class="hora_actual"></b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button onclick="registrarInicioOrden();" class="btn btn-primary">Iniciar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirmarFinOrden" tabindex="-1" role="dialog" aria-labelledby=""
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6777ef">
                    <h5 class="modal-title text-light">Finalizar</h5>
                </div>

                <div class="modal-body">
                    <p>Confirma si desea finalizar la orden de producción, una vez realizada esta acción ya no se podrá
                        reiniciar.</p>
                    <p>Hora actual: <b class="hora_actual"></b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button onclick="registrarFinOrden();" class="btn btn-danger">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTotalScrap" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6777ef">
                    <h5 class="modal-title text-light">Capturar datos finales</h5>
                </div>

                {!! Form::open(['route' => ['savetotalscrap', [$id]], 'method' => 'POST']) !!}
                <div class="modal-body">

                    <label for="total_finish">Total producido</label>
                    {!! Form::number('total_finish', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'total_finish', 'min'=>'0',
                                    'required'=>'required',
                                    'placeholder'=>'Agregar Total producido']) !!}


                    <label for="scrap_finish">Scrap</label>
                    {!! Form::number('scrap_finish', null, ['class' => 'form-control col-xs-6 col-sm-6 col-md-6', 'id' => 'scrap_finish', 'min'=>'0',
                                    'required'=>'required',
                                    'placeholder'=>'Agregar Scrap']) !!}


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTotalScrapUp" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6777ef">
                    <h5 class="modal-title text-light">Capturar datos finales</h5>
                </div>

                {!! Form::model($order, ['route'=>['timers.update',$order->id]]) !!}
                            <input type="hidden" name="_method" value="PUT">
                                <div class="modal-body">
                                    <label for="total_produced" >Total producido</label>
                                    {!! Form::number('total_produced',null,array(
                                    'class'=>'form-control col-xs-6 col-sm-6 col-md-6', 'min'=>'0',
                                    'required'=>'required',
                                    'placeholder'=>'Agregar Total producido'
                                    ))
                                    !!}
                                    <label for="scrap" >Scrap</label>
                                    {!! Form::number('scrap',null,array(
                                    'class'=>'form-control col-xs-6 col-sm-6 col-md-6', 'min'=>'0',
                                    'required'=>'required',
                                    'placeholder'=>'Agregar Scrap'
                                    ))
                                    !!}
                                </div>

                                <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                </div>
                                
                            {!! Form::close()!!}
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js"
        integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var iEstatusStoppage = 0;
        var tblParos = null;
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
            tblParos = $('#tablaParos').DataTable({
                responsive: true,
                order: [
                    [1, "desc"]
                ],
                dom: 'frtip',
                language: aLanguageDataTable,
                columns: [{
                        "data": "name_stoppage"
                    },
                    {
                        "data": "start_time"
                    },

                    {
                        "data": "end_time"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            var start_time = row.start_time;
                            var end_time = row.end_time;
                            var date_start = new Date(start_time).getTime();
                            var date_end = new Date(end_time).getTime();
                            var diff = date_end - date_start;
                            return msToTime(diff);
                        }
                    },

                ]
            });

            setInterval(() => {
                var date = new Date();
                datetext = date.toTimeString();
                datetext = datetext.split(' ')[0];
                $(".hora_actual").html(datetext);
            }, 1000);
            @if ($order->productionorderstatus_id == 2)
                $(".stoppage").attr("disabled", false);
                $("#spanHoraInicio").show();
                $("#lblHoraInicio").html("{{ $order->start_time }}");
            @endif
            @if ($order->productionorderstatus_id == 3)
                $("#spanHoraInicio").show();
                $("#lblHoraInicio").html("{{ $order->start_time }}");
                $("#spanHoraFin").show();
                $("#lblHoraFin").html("{{ $order->end_time }}");
                $(".paro-container").hide();
            @endif

            @foreach ($StoppagesExecuted as $SE)
                @if ($SE->end_time == null)
                    var start_time = "{{ $SE->start_time }}";
                    start_time = new Date(start_time);
                    $("#modalStoppageTitle").html("{{ $SE->name_stoppage }}");
                    $('#modalStoppage').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#horaInicioCron").html(moment(start_time, moment.HTML5_FMT.DATETIME_LOCAL).format(
                        "YYYY-MM-DD HH:mm:ss"), );
                    iEstatusStoppage = 1;
                    tiempoTranscurrido(start_time);
                    $(".stoppage").prop("disabled", true);
                    $("#productionstoppage_id").val("{{ $SE->productionstoppage_id }}");
                @endif
            @endforeach
            @if ($order->productionorderstatus_id == 3)
            $("#capturarScrap").show();
            @endif
        });

        function msToTime(s) {
            function pad(n, z) {
                z = z || 2;
                return ('00' + n).slice(-z);
            }

            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;

            return pad(hrs) + ':' + pad(mins) + ':' + pad(secs);
        }

        function iniciarDetenerProceso(element) {
            if ($(element).hasClass("btn-success")) {
                $("#modalConfirmarInicioOrden").modal("show");
            } else {
                $("#modalConfirmarFinOrden").modal("show");
            }
        }

        function getNowTime() {
            var date = new Date();
            datetext = date.toTimeString();
            datetext = datetext.split(' ')[0];
            return datetext;
        }

        function registrarInicioOrden() {
            $(".stoppage").attr("disabled", false);
            $("#modalConfirmarInicioOrden").modal("hide");
            $("#btnIniciarOrden").removeClass("btn-success");
            $("#btnIniciarOrden").text("Finalizar");
            $("#btnIniciarOrden").addClass("btn-danger");

            $("#spanHoraInicio").show();
            var id = $("#order_id").val();
            var date = new Date();

            var data = {
                "id": id,
                "start_time": moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("YYYY-MM-DD HH:mm:ss"),
            }
            $.ajax({
                //route('profile', ['id' => 1]);
                url: "{{ route('startOrder') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    $("#lblHoraInicio").html(response.start_time)
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }

        function registrarFinOrden() {
            $(".stoppage").attr("disabled", true);
            $("#modalConfirmarFinOrden").modal("hide");
            // $("#lblHoraFin").html(getNowTime);
            $("#spanHoraFin").show();
            $(".paro-container").hide();
            var id = $("#order_id").val();
            var date = new Date();
            var data = {
                "id": id,
                "end_time": moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("YYYY-MM-DD HH:mm:ss"),
            }
            $.ajax({
                //route('profile', ['id' => 1]);
                url: "{{ route('endOrder') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    $("#lblHoraFin").html(response.end_time);
                    $("#capturarScrap").show();
                    $("#modalTotalScrap").modal("show");

                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }

        function detenerParo(element) {

            $(".stoppage").attr("disabled", false);
            iEstatusStoppage = 0;
            $('#modalStoppage').modal('hide');
            $("#modalStoppageTitle").html("");
            $("#horaInicioCron").html("");
            $(".stoppage").attr("status", "stopped");
            var productionstoppage_id = $("#productionstoppage_id").val();
            var productionorder_id = $("#order_id").val();
            var date = new Date();
            var mysqldate = moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("YYYY-MM-DD HH:mm:ss");
            var dataPost = {
                productionorder_id: productionorder_id,
                productionstoppage_id: productionstoppage_id,
                end_time: mysqldate
            }
            console.log(dataPost);
            $.ajax({
                //route('profile', ['id' => 1]);
                url: "{{ route('stopStoppage') }}",
                type: 'POST',
                data: dataPost,
                success: function(response) {
                    console.log(response);
                    $("#lblHoraFin").html(response.end_time);
                    // location.reload();
                    updateTable(productionorder_id);
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }

        function iniciarParo(element) {
            var data = $(element).attr("status");
            // var date = new Date();
            // console.log(moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("YYYY-MM-DD HH:mm:ss"));

            if (data == "stopped") {
                iEstatusStoppage = 1;
                $(element).attr("status", "started");
                $("#btnIniciarOrden").prop("disabled", true);
                $("#modalStoppageTitle").html($(element).html());
                $('#modalStoppage').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                // $('#modalStoppage').modal('show');
                var date = new Date();
                // console.log(date.toLocaleString());
                // datetext = date.toTimeString();
                // datetext = datetext.split(' ')[0];
                $("#horaInicioCron").html(moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("HH:mm:ss"));
                tiempoTranscurrido(date);
                $(".stoppage").prop("disabled", true);
                var productionstoppage_id = $(element).attr("data");
                $("#productionstoppage_id").val(productionstoppage_id);
                var productionorder_id = $("#order_id").val();
                var mysqldate = moment(date, moment.HTML5_FMT.DATETIME_LOCAL).format("YYYY-MM-DD HH:mm:ss");
                var dataPost = {
                    productionorder_id: productionorder_id,
                    productionstoppage_id: productionstoppage_id,
                    start_time: mysqldate
                }
                $.ajax({
                    //route('profile', ['id' => 1]);
                    url: "{{ route('startStoppage') }}",
                    type: 'POST',
                    data: dataPost,
                    success: function(response) {
                        console.log(response);
                        $("#lblHoraFin").html(response.end_time);
                        updateTable(productionorder_id);
                    },
                    statusCode: {},
                    error: function(x, xs, xt) {}
                });
            } else {
                $(".stoppage").attr("disabled", false);
                iEstatusStoppage = 0;
            }
        }

        function tiempoTranscurrido(date) {
            if (iEstatusStoppage == 0) {
                return;
            }
            var now = new Date();
            var difference = date.getTime() - now.getTime();
            console.log(difference);
            $("#cronometro").html(msToTime(Math.abs(difference)));
            setTimeout(() => {
                tiempoTranscurrido(date);
            }, 1000);
        }

        function msToTime(s) {
            function pad(n, z) {
                z = z || 2;
                return ('00' + n).slice(-z);
            }
            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;

            return pad(hrs) + ':' + pad(mins) + ':' + pad(secs);
        }

        function updateTable(id) {
            $.ajax({
                url: "{{ route('stoppages_executed', [$id]) }}",
                type: 'get',
                success: function(dataset) {
                    console.log(dataset);
                    tblParos.clear();
                    tblParos.rows.add(dataset);
                    tblParos.draw();
                },
                statusCode: {},
                error: function(x, xs, xt) {}
            });
        }

        function capturarTotalScrap() {
            $('#modalTotalScrapUp').modal('show');
        }
    </script>
@endsection
