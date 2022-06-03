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
                                                    <td>{{ $order->status_name }}</td>

                                                    <td>
                                                        <a href="timers/{{ $order->id }}">
                                                            <span class="material-icons md-48">play_arrow</span></a>
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

        

        

       

        

    </script>
@endsection
