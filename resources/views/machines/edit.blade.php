@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Maquina</h3>
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

                        {!! Form::model($machines, ['route'=>['machines.update',$machines->id]]) !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name" >Nombre</label>
                            {!! Form::text('name',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Nombre'
                            ))
                            !!}

                        </div>
                     
                        <div class="form-group">
                            <label for="description" >Descripcion</label>
                            {!! Form::text('description',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'descripcion...'
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
