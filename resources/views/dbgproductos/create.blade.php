@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Catalogo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">    

                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::open(array('route' => 'productos.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="mes">Mes</label>
                                    {!! Form::text('mes', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="empleado">Empleado</label>
                                    {!! Form::text('empleado', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="vendedor">Vendedor</label>
                                    {!! Form::text('vendedor', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="categoria_id">Linea</label>
                                    {{ Form::select('categoria_id', $categorias , $productos->categoria_id, ['class'=>'form-control' . ($errors->has('categoria_id') ? 'is-invalid' : ''), 'placeholder' => 'Seleccione la linea de produccion...']) }}

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="producto">propucto</label>
                                    {!! Form::text('producto', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    {!! Form::number('cantidad', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    {!! Form::number('precio', null, ['class' => 'form-control','step' => '0.02']) !!}

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    {!! Form::text('cliente', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary float-right" style="margin-left:8px">Guardar</button>
                                <a href="{{ route('tab2') }}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Cancelar</a>
                            </div>
                        </div>
                        {!! Form::close() !!} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
