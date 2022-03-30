@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Maquinas</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a class="btn btn-warning" href="{{ route('machines.create') }}">Nuevo</a>        
                         
                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre</th>
                                  <th style="color:#fff;">Descripcion</th>
                                  
                                  <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                                @foreach ($machines as $machine)
                                  <tr>
                                    <td style="display: none;">{{ $machine->id }}</td>
                                    <td>{{ $machine->name }}</td>
                                    <td>{{ $machine->description }}</td>
                                    

                                    <td>                                  
                                      <a class="btn btn-info" href="{{ route('machines.edit',$machine->id) }}">Editar</a>
                                      @can('borrar-rol')


                                      {!! Form::open(['method' => 'DELETE','route' => ['machines.destroy', $machine->id],'style'=>'display:inline']) !!}
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
                          </div>     
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection