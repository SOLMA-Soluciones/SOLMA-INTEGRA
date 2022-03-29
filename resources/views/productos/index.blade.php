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
                                @foreach ($products as $product)
                                  <tr>
                                    <td style="display: none;">{{ $product->id }}</td>
                                    <td>{{ $product->part_number }}</td>
                                    <td>{{ $product->cost }}</td>
                                    <td>{{ $product->cycle }}</td>
                                    <td>{{$product->unit}}</td>
                                    <td>{{$product->line->name}}</td>	

                                    <td>                                  
                                      <a class="btn btn-info" href="{{ route('productos.edit',$product->id) }}">Editar</a>
                                      @can('borrar-rol')


                                      {!! Form::open(['method' => 'DELETE','route' => ['productos.destroy', $product->id],'style'=>'display:inline']) !!}
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
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection