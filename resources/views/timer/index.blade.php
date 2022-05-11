@extends('layouts.app')

@section('css')
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

        /* .chip img {
                    float: left;
                    margin: 0 10px 0 -25px;
                    height: 50px;
                    width: 50px;
                    border-radius: 50%;
                } */
        /* span.material-icons.start{
                    font-size: 48px;
                } */

        .stoppage {
            margin-top: 15px;
        }

        .chips>.chip {
            margin-top: 15px;
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
                                <div class="panel-body">
                                    <div class="col-12">
                                        <h3>Datos generales</h3>
                                    </div>
                                    <div class="col-sm-12 chips">
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

                                    </div>

                                    {{-- <div class="col-sm-12">
                                        <br><br>
                                        <span>
                                            <button class="btn btn-success">Iniciar orden</button>
                                            <button class="btn btn-danger">Detener</button>
                                        </span>
                                    </div> --}}
                                    <br>
                                    <div class="col-12" id="ContainerParosProduccion" style="display: none">
                                        <div class="row">

                                            <div class="col-12">
                                                <h3>Paros de producción</h3>
                                            </div>
                                            @foreach ($stoppages as $stoppage)
                                                @if ($stoppage->iEstatus == '1')
                                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                        <button class="btn btn-success stoppage"
                                                            style="width: 100%">{{ $stoppage->name }}</button>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        <h3>Acciones</h3>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success" onclick="iniciarProceso(this)">Iniciar</button>
                                        <button class="btn btn-danger">Finalizar</button>
                                    </div>
                                    <br>
                                    <div class="col-12">
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
                                    </div>
                                    <br>
                                    {{-- <div class="col-12">
                                        <div >
                                            <button class="btn btn-info float-right">Finalizar</button>
                                        </div>
                                    </div> --}}





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function iniciarProceso(element) {
            console.log("click");
            $("#ContainerParosProduccion").show();
        }
    </script>
@endsection
