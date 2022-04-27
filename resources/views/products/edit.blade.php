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

                        {!! Form::model($products, ['route'=>['products.update',$products->id]]) !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="part_number" >Numero</label>
                            {!! Form::text('part_number',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Numero'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="description" >Descripcion</label>
                            {!! Form::text('description',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Descripcion'
                            ))
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="cost" >Costo</label>
                            {!! Form::number('cost', null, ['class' => 'form-control','step' => '0.02']) !!}


                        </div>
                        <div class="form-group">
                            <label for="cycle" >Max.Hora</label>
                            {!! Form::number('cycle',null,array(
                            'class'=>'form-control',
                            'required'=>'required',
                            'placeholder'=>'Max.Hora'
                            ))
                            !!}
                        </div>

                        <div class="form-group">
                            <label for="unit" >Unidad</label>
                            {{Form::select('unit', ['Toneladas' => 'Toneladas', 'Piezas' => 'Piezas', 'Metros' => 'Metros', 'Kilogramos' => 'Kilogramos'], null, array('class' => 'form-control', 'placeholder' => 'Elige la Unidad...'))}}

                                   

                        </div>

                        <label for="productionline_id" >Linea</label>
                            {!! Form::select('productionline_id', $lineas,null, ['class' => 'form-control'])
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
