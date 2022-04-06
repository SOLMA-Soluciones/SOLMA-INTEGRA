@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Ordenes de Produccion</h3>
    </div>
      <div class="section-body">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a href="#" class="btn btn-warning" role="button" aria-pressed="true"
                                            data-toggle="modal" data-target="#addTurn">Nueva Orden</a>        
                          <div class="table-responsive">
                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="color:#fff;">Id_Orden</th>
                                  <th style="color:#fff;">Linea</th>
                                  <th style="color:#fff;">Producto</th>
                                  <th style="color:#fff;">Cantidad</th>
                                  <th style="color:#fff;">Tiempo de produccion Planificado</th>
                                  <th style="color:#fff;">Estado</th> 
                                  <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
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
                {{-- {!! Form::open(['route' => 'schedules.update', 'method' => 'POST']) !!} --}}
                <div class="modal-body">

                    <div class="row">
                        
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group ">
                                {{-- @foreach ($lineas as $line) --}}
                                <label for="select_line">Linea de producción</label>
                                <select id="select_line" class="selectpicker " required>
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($lineas as $line)
                                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="hidden" value="" id="status_id">
                                <label for="selectScheduleTurn">Estado</label>
                                <select id="selectScheduleTurn" class="selectpicker" multiple
                                    required>
                                    {{-- <option selected disabled>Seleccione una opción</option> --}}
                                    <option value="1">Programado</option>
                                    <option value="2">Desactivado</option>
                                    <option value="3">Activo</option>
                                 
                                </select>
                                <label for="">Tiempo Planificado</label>
                                    {!! Form::text('', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group ">
                                    {{-- @foreach ($products as $product) --}}
                                    <label for="select_product">Producto</label>
                                    <select id="select_product" class="selectpicker" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->part_number }}</option>
                                        @endforeach
                                    </select>
                                 <br>
                                 <label for="cycle">Cantidad</label>
                                    {!! Form::number('cycle', null, array('class' => 'form-control')) !!}
                          
                            </div>
                         
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCalendarioTurno()">Guardar</button>
                </div>
                {{-- {!! Form::close() !!} --}}

            </div>
        </div>
    </div>
@endsection