@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Productos y Tiempo de Ciclo</h3>
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

                        {!! Form::open(array('route' => 'products.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="part_number">Numero de Parte</label>
                                    {!! Form::text('part_number', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="description">Descripcion</label>
                                    {!! Form::text('description', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cost">Costo</label>
                                    {!! Form::number('cost', null, ['class' => 'form-control','step' => '0.02']) !!}

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cycle">Max. Hora</label>
                                    {!! Form::number('cycle', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                <label for="unit">Unidad</label>
                                    {{Form::select('unit', ['Toneladas' => 'Toneladas', 'Piezas' => 'Piezas', 'Metros' => 'Metros', 'Kilogramos' => 'Kilogramos'], null, array('class' => 'form-control', 'placeholder' => 'Elige la Unidad...'))}}
                                   
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="productionline_id">Linea</label>
                                    {{ Form::select('productionline_id', $lineas , $product->productionline_id, ['class'=>'form-control' . ($errors->has('productionline_id') ? 'is-invalid' : ''), 'placeholder' => 'Seleccione la linea de produccion...']) }}

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
