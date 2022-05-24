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
        }

        .chips>.chip {
            margin-top: 15px;
        }


        .header-info {
            border: 2px solid gray;
            border-radius: 5px;
            padding: 5px;
            padding-top: 10px;
        }

        .header-item {
            border: 1px solid gray;
            padding: 5px;
            font-size: 16px;
            /* padding-top: 10px !important; */
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                                    <div class="col-sm-12">

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
                                        <div class="card">


                                            <div class="collapse-header" id="headingGeneric" data-toggle="collapse"
                                                data-target="#collapseGeneric" aria-expanded="true"
                                                aria-controls="collapseGeneric">
                                                <h6>Datos Generales</h6>
                                            </div>
                                            <div id="collapseGeneric" class="collapse show"
                                                aria-labelledby="headingGeneric" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="col-12 header-info" id="header-info">
                                                        <span
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Linea:</b> {{ $order->name_line }}</label>
                                                        </span>
                                                        <span
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Turno:</b> {{ $order->turn }}</label>
                                                        </span>
                                                        <span
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Producto:</b> {{ $order->part_number }}</label>
                                                        </span>
                                                        <span
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Estatus:</b> Programado</label>
                                                        </span>
                                                        <span style="display: none" id="spanHoraInicio"
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Hora inicio:</b> <span
                                                                    id="lblHoraInicio">00:00:00</span></label>
                                                        </span>
                                                        <span style="display: none" id="spanHoraFin"
                                                            class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 header-item">
                                                            <label><b>Hora fin:</b><span id="lblHoraFin">00:00:00</span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- paros produccion --}}
                                            <div class="collapse-header paro-container" id="headingParos" data-toggle="collapse"
                                                data-target="#collapseParos" aria-expanded="true"
                                                aria-controls="collapseParos">
                                                <h6>Paros de producción</h6>
                                            </div>
                                            <div id="collapseParos" class="collapse show paro-container" aria-labelledby="headingParos"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                            <button id="btnIniciarOrden" class="btn btn-success stoppage"
                                                                onclick="iniciarDetenerProceso(this)"
                                                                style="width: 100%">Iniciar</button>
                                                        </div>
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($stoppages as $stoppage)
                                                            @if ($stoppage->iEstatus == '1')
                                                                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
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
                                                            <tr>
                                                                <td>Falta de material</td>
                                                                <td>09:40 am</td>
                                                                <td>10:30 am</td>
                                                                <td>00:50:00</td>
                                                            </tr>
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
                        <div class="col-12">
                            <p>Hora de Inicio: <b id="horaInicioCron"></b></p>
                        </div>
                        <div class="col-12">
                            <p>Tiempo transcurrido: <b id="cronometro">></b></p>
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
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        var iEstatusStoppage = 0;
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
            $('#tablaParos').DataTable({
                responsive: true,
                language: aLanguageDataTable,
                dom: 'rtip',
            });

            setInterval(() => {
                var date = new Date();
                datetext = date.toTimeString();
                datetext = datetext.split(' ')[0];
                $(".hora_actual").html(datetext);
            }, 1000);
        });

        function iniciarDetenerProceso(element) {
            if ($(element).hasClass("btn-success")) {
                $("#modalConfirmarInicioOrden").modal("show");
            } else {
                $("#modalConfirmarFinOrden").modal("show");
            }
        }
        
        function getNowTime(){
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
            $("#lblHoraInicio").html(getNowTime);
            $("#spanHoraInicio").show();
        }

        function registrarFinOrden() {
            $(".stoppage").attr("disabled", true);
            $("#modalConfirmarFinOrden").modal("hide");
            $("#lblHoraFin").html(getNowTime);
            $("#spanHoraFin").show();
            $(".paro-container").hide();
        }

        // function finalizarProceso(element) {
        //     console.log("click");
        //     $("#ContainerParosProduccion").hide();
        // }

        function detenerParo(element) {

            $(".stoppage").attr("disabled", false);
            iEstatusStoppage = 0;
            $('#modalStoppage').modal('hide');
            $("#modalStoppageTitle").html("");
            $("#horaInicioCron").html("");
            $(".stoppage").attr("status", "stopped");
        }

        function iniciarParo(element) {
            var data = $(element).attr("status");
            console.log(data);
            if (data == "stopped") {
                iEstatusStoppage = 1;
                $(element).attr("status", "started");
                $("#btnIniciarOrden").prop("disabled", true);
                $("#modalStoppageTitle").html($(element).html());
                $('#modalStoppage').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modalStoppage').modal('show');
                var date = new Date();
                datetext = date.toTimeString();
                datetext = datetext.split(' ')[0];
                $("#horaInicioCron").html(datetext);
                tiempoTranscurrido(date);
                $(".stoppage").prop("disabled", true);
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
    </script>
@endsection
