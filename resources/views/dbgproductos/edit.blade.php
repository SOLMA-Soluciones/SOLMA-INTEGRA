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
                            <label for="mes" >Mes</label>
                            {!! Form::text('mes',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Mes'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="empleado" >Descripcion</label>
                            {!! Form::text('empleado',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Empleado'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="vendedor" >Descripcion</label>
                            {!! Form::text('vendedor',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'vendedor'
                            ))
                            !!}

                        </div>
                        <label for="categoria_id" >Linea</label>
                            {!! Form::select('categoria_id', $categorias,null, ['class' => 'form-control'])
                            !!}
                            <br>
                        <div class="form-group">
                            <label for="producto" >Descripcion</label>
                            {!! Form::text('producto',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'producto'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="CANTIDAD" >Max.Hora</label>
                            {!! Form::number('CANTIDAD',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Cantidad'
                            ))
                            !!}
                        </div>
                        <div class="form-group">
                            <label for="precio" >Precio</label>
                            {!! Form::number('precio', null, ['class' => 'form-control','step' => '0.02']) !!}


                        </div>
                        <div class="form-group">
                            <label for="cliente" >Descripcion</label>
                            {!! Form::text('cliente',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Cliente'
                            ))
                            !!}

                        </div>
                       

                       

                        

                        <div class="form-group">
                            {!! Form::submit('Actualizar',array('class'=>'btn btn-primary'))!!}
                        </div>
                            
                        {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
