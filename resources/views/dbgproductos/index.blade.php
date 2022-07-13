@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Productos</h3>
  </div>
      <div class="section-body">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a class="btn btn-warning" href="{{ route('productos.create') }}">Nuevo</a>        
                          <div class="table-responsive">

                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Fecha</th>
                                  <th style="color:#fff;">Mes</th>
                                  <th style="color:#fff;">Empleado</th>
                                  <th style="color:#fff;">Vendedor</th>
                                  <th style="color:#fff;">categoria</th>
                                  <th style="color:#fff;">Producto</th>
                                  <th style="color:#fff;">Cantidad</th>
                                  <th style="color:#fff;">Precio</th>
                                  <th style="color:#fff;">Cliente</th>
                                  <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                                @foreach ($productos as $product)
                                  <tr>
                                    <td style="display: none;">{{ $product->id }}</td>
                                    <td>{{ $product->created_at}}</td>
                                    <td>{{ $product->mes }}</td>
                                    <td>{{ $product->empleado }}</td>
                                    <td>{{$product->vendedor}}</td>
                                    <td>{{$product->categoria->nombre}}</td>
                                    <td>{{ $product->producto }}</td>
                                    <td>{{$product->cantidad}}</td>
                                    <td>{{$product->precio}}</td>
                                    <td>{{$product->cliente}}</td>

                                    <td>                                  
                                      <a class="btn btn-info" href="{{ route('productos.edit',$product->id) }}">Editar</a>
                                     


                                      {!! Form::open(['method' => 'DELETE','route' => ['productos.destroy', $product->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                      {!! Form::close() !!}
                                      
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            </div>
                            <!-- Centramos la paginacion a la derecha -->
                          <div class="pagination justify-content-end">
                          </div>     
                            
                      </div>
                  </div>
              </div>
              </div>
          </div>
      </div>
    </section>
@endsection