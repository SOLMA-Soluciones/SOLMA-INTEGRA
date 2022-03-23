@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Productos y Tiempo de Ciclo</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a class="btn btn-warning" href="{{ route('productos.create') }}">Nuevo</a>        
                         
                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Numero</th>
                                  <th style="color:#fff;">Costo</th>
                                  <th style="color:#fff;">Max.Hora</th>
                                  <th style="color:#fff;">Unidad</th>
                                  <th style="color:#fff;">Linea</th>
                                  <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                                @foreach ($productos as $producto)
                                  <tr>
                                    <td style="display: none;">{{ $producto->id }}</td>
                                    <td>{{ $producto->numero }}</td>
                                    <td>{{ $producto->costo }}</td>
                                    <td>{{ $producto->max_hora }}</td>
                                    <td>{{$producto->unidad}}</td>
                                    <td>{{$producto->linea->nombre}}</td>	
                                   
                                    <td>                                  
                                      <a class="btn btn-info" href="{{ route('productos.edit',$producto->id) }}">Editar</a>
                                      @can('borrar-rol')


                                      {!! Form::open(['method' => 'DELETE','route' => ['productos.destroy', $producto->id],'style'=>'display:inline']) !!}
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
                            {!! $productos->links() !!}
                          </div>     
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection