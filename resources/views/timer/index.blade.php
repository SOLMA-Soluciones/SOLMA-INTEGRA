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
                                                    <div class="col-12 header-info">
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
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- paros produccion --}}
                                            <div class="collapse-header" id="headingParos" data-toggle="collapse"
                                                data-target="#collapseParos" aria-expanded="true"
                                                aria-controls="collapseParos">
                                                <h6>Paros de producción</h6>
                                            </div>
                                            <div id="collapseParos" class="collapse show" aria-labelledby="headingParos"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($stoppages as $stoppage)
                                                            @if ($stoppage->iEstatus == '1')
                                                                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                                    <button class="btn btn-success stoppage"
                                                                        style="width: 100%" onclick="ejecutarParo(this)"
                                                                        data="{{ $stoppage->id }}">{{ $stoppage->name }}</button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- Acciones --}}
                                            <div class="collapse-header" id="headingAcciones" data-toggle="collapse"
                                                data-target="#collapseAcciones" aria-expanded="true"
                                                aria-controls="collapseAcciones">
                                                <h6>Acciones</h6>
                                            </div>
                                            <div id="collapseAcciones" class="collapse show"
                                                aria-labelledby="headingAcciones" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="col-12">
                                                        <button class="btn btn-success"
                                                            onclick="iniciarProceso(this)">Iniciar</button>
                                                        <button class="btn btn-danger"
                                                            onclick="finalizarProceso(this)">Finalizar</button>
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
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div>Hora de Inicio: <span id="horaInicioCron"></span></div>
                        <div id="cronometro">
                            <span id="Horas">00</span>
                            <span id="Minutos">:00</span>
                            <span id="Segundos">:00</span>
                            <span id="Centesimas">:00</span>
                            {{-- <div class="reloj" id="Horas">00</div>
                            <div class="reloj" id="Minutos">:00</div>
                            <div class="reloj" id="Segundos">:00</div>
                            <div class="reloj" id="Centesimas">:00</div> --}}
                            {{-- <input type="button" class="boton" id="inicio" value="Start &#9658;"
                                onclick="inicio();">
                            <input type="button" class="boton" id="parar" value="Stop &#8718;" onclick="parar();"
                                disabled>
                            <input type="button" class="boton" id="continuar" value="Resume &#8634;"
                                onclick="inicio();" disabled>
                            <input type="button" class="boton" id="reinicio" value="Reset &#8635;"
                                onclick="reinicio();" disabled> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ocultar</button>
                    <button onclick="parar()" class="btn btn-primary">Detener</button>
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
        });

        function iniciarProceso(element) {
            console.log("click");

            $("#ContainerParosProduccion").show();

        }

        function finalizarProceso(element) {
            console.log("click");
            $("#ContainerParosProduccion").hide();
        }

        function ejecutarParo(element) {
            if ($(element).hasClass("btn-success")) {
                $(element).removeClass("btn-success");
                $(element).addClass("btn-danger");

                $("#modalStoppageTitle").html($(element).html());
                // $('#modalStoppage').modal('show');
                $('#modalStoppage').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modalStoppage').modal('show');
                $("#horaInicioCron").html(new Date().toString());
                // $('#modalStoppage').modal({
                //     backdrop: 'static'
                // })
                inicio();

            } else {
                $(element).removeClass("btn-danger");
                $(element).addClass("btn-success");
            }
        }

        var centesimas = 0;
        var segundos = 0;
        var minutos = 0;
        var horas = 0;

        function inicio() {
            control = setInterval(cronometro, 10);
            // document.getElementById("inicio").disabled = true;
            // document.getElementById("parar").disabled = false;
            // document.getElementById("continuar").disabled = true;
            // document.getElementById("reinicio").disabled = false;
        }

        function parar() {
            clearInterval(control);
            // document.getElementById("parar").disabled = true;
            // document.getElementById("continuar").disabled = false;
        }

        function reinicio() {
            clearInterval(control);
            centesimas = 0;
            segundos = 0;
            minutos = 0;
            horas = 0;
            Centesimas.innerHTML = ":00";
            Segundos.innerHTML = ":00";
            Minutos.innerHTML = ":00";
            Horas.innerHTML = "00";
            document.getElementById("inicio").disabled = false;
            document.getElementById("parar").disabled = true;
            document.getElementById("continuar").disabled = true;
            document.getElementById("reinicio").disabled = true;
        }

        function cronometro() {
            if (centesimas < 99) {
                centesimas++;
                if (centesimas < 10) {
                    centesimas = "0" + centesimas
                }
                Centesimas.innerHTML = ":" + centesimas;
            }
            if (centesimas == 99) {
                centesimas = -1;
            }
            if (centesimas == 0) {
                segundos++;
                if (segundos < 10) {
                    segundos = "0" + segundos
                }
                Segundos.innerHTML = ":" + segundos;
            }
            if (segundos == 59) {
                segundos = -1;
            }
            if ((centesimas == 0) && (segundos == 0)) {
                minutos++;
                if (minutos < 10) {
                    minutos = "0" + minutos
                }
                Minutos.innerHTML = ":" + minutos;
            }
            if (minutos == 59) {
                minutos = -1;
            }
            if ((centesimas == 0) && (segundos == 0) && (minutos == 0)) {
                horas++;
                if (horas < 10) {
                    horas = "0" + horas
                }
                Horas.innerHTML = horas;
            }
        }
    </script>
@endsection
