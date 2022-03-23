@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Producto</h3>
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

                        {!! Form::model($productos, ['route'=>['productos.update',$productos->id]]) !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="numero" >Numero</label>
                            {!! Form::text('numero',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Numero'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="costo" >Costo</label>
                            {!! Form::number('costo', null, ['class' => 'form-control','step' => '0.02']) !!}


                        </div>
                        <div class="form-group">
                            <label for="max_hora" >Max.Hora</label>
                            {!! Form::number('max_hora',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Max.Hora'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="unidad" >Unidad</label>
                            {!! Form::text('unidad',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Unidad...'
                            ))
                            !!}

                        </div>

                        <label for="linea-id" >Linea</label>
                            {!! Form::select('linea_id', $lineas,null, ['class' => 'form-control'])
                            !!}
                            <br>

                        

                        <div class="form-group">
                            {!! Form::submit('Actualizar Producto',array('class'=>'btn btn-primary'))!!}
                        </div>
                            
                        {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
