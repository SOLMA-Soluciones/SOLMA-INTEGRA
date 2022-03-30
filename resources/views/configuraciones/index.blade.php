@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Configuracion</h3>
        </div>
        <div class="section-body">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 ">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link {{ request()->is('tab1') ? 'active' : null }}"
                                    href="{{ route('tab1') }}" role="tab">1 Datos Basicos</a>
                                <a class="nav-item nav-link {{ request()->is('tab2') ? 'active' : null }}"
                                    href="{{ route('tab2') }}" role="tab">2 Productos y Tiempo de Ciclo</a>
                                <a class="nav-item nav-link {{ request()->is('tab3') ? 'active' : null }}"
                                    href="{{ route('tab3') }}" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">3 Calendario</a>
                                <a class="nav-item nav-link {{ request()->is('tab4') ? 'active' : null }}"
                                    href="{{ route('tab4') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">4 Motivos de Detención</a>
                                <a class="nav-item nav-link {{ request()->is('tab5') ? 'active' : null }}"
                                    href="{{ route('tab5') }}" role="tab" aria-controls="nav-about"
                                    aria-selected="false">5 Agregar Usuarios</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane {{ request()->is('tab1') ? 'active' : null }}"
                                id="{{ route('tab1') }}" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card-body">
                                    <!--   {!! Form::open(['route' => 'lineas.store', 'method' => 'POST']) !!}
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="name">Nombre de la Organizacion</label>
                                                                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                    
                                                                </div>
                                                              
                                                                {!! Form::close() !!}
                                                                -->

                                    {!! Form::open(['route' => 'lineas.store', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Agregue Lineas de Fabricacion</label>
                                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>

                                    </div>

                                    {!! Form::close() !!}

                                    <table class="table table-striped mt-2">
                                        <tbody>
                                            @foreach ($lineas as $line)
                                                <tr>

                                                    <td>{{ $line->name }}</td>
                                                    <td>

                                                        {!! Form::open(['route' => 'lineas.store', 'method' => 'POST']) !!}

                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td>

                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lineas.destroy', $line->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger ']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="text-right">
                                    <a href="{{ route('tab2') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>
                            <div class="tab-pane {{ request()->is('tab2') ? 'active' : null }}"
                                id="{{ route('tab2') }}" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <a class="btn btn-warning" href="{{ route('products.create') }}">Nuevo</a>

                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">Num. Parte</th>
                                        <th style="color:#fff;">Costo ($)</th>
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
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->line->name }}</td>

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('products.edit', $product->id) }}">Editar</a>
                                                    @can('borrar-rol')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'style' => 'display:inline']) !!}
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

                                <div class="text-right">
                                    <a href="{{ route('tab3') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>

                            </div>
                            <div class="tab-pane {{ request()->is('tab3') ? 'active' : null }}"
                                id="{{ route('tab3') }}" role="tabpanel" aria-labelledby="nav-contact-tab">

                                <div class="container">
                                    <div class="text-center">
                                        <a class="btn btn-warning" href="">Linea 1</a>
                                    </div>
                                    <div class="row" class="text-center">



                                    </div>

                                </div>

                                <div class="text-right">
                                    <a href="{{ route('tab4') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>

                            <div class="tab-pane {{ request()->is('tab4') ? 'active' : null }}"
                                id="{{ route('tab4') }}" role="tabpanel" aria-labelledby="nav-about-tab">
                                <div class="col-md-9" class="text-center">
                                    <table class="table table-striped mt-2">
                                        <thead style="background-color:#6777ef">

                                        </thead>
                                        <tbody>
                                            @foreach ($motivos as $stop)
                                                <tr>
                                                    <td style="display: none;">{{ $stop->id }}</td>
                                                    <td>{{ $stop->nombre}}</td>
                                                    <td id="resp{{ $stop->id }}">
                                                        <br>
                                                        @if ($stop->estatus == 1)
                                                            <button  type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-success">Activa</button>
                                                        @else
                                                            <button  type="button"
                                                                class="stoppage{{ $stop->id }} btn btn-sm btn-danger">Inactiva</button>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <br>
                                                        <label class="switch">

                                                            <input onchange="actualizarEstatus(this)"
                                                                data-id="{{ $stop->id }}" class="mi_checkbox"
                                                                type="checkbox" data-onstyle="success"
                                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                                data-off="InActive"
                                                                {{ $stop->estatus ? 'checked' : '' }}>
                                                            <span class="slider round"></span>



                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('tab5') }}" class="btn btn-primary" role="button"
                                        aria-pressed="true">Siguiente</a>
                                </div>
                            </div>
                            <div class="tab-pane {{ request()->is('tab5') ? 'active' : null }}"
                                id="{{ route('tab5') }}" role="tabpanel" aria-labelledby="nav-about-tab">

                                <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>

                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">E-mail</th>
                                        <th style="color:#fff;">Rol</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                            <tr>
                                                <td style="display: none;">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $rolNombre)
                                                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
                                                    @can('borrar-rol')
                                                        <form action="{{ route('usuarios.destroy', $user->id) }}"
                                                            class="d-inline" method="POST">

                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-eliminar">Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Centramos la paginacion a la derecha -->
                                <div class="pagination justify-content-end">
                                    {!! $usuarios->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El usuario ha sido eliminado.',
                'con exito'
            )
        </script>
    @endif
    <script>
        const panel = document.querySelector('#panel-control');

        panel.addEventListener('click', eliminarItem);

        function eliminarItem(e) {

            if (e.target.classList.contains('btn-eliminar')) {
                e.preventDefault();
                const itemName = e.target.dataset.name;
                const itemId = e.target.dataset.id;


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                        if (result.isConfirmed) {
                            /*Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            */
                            this.submit();
                        }
                    }
                });
        }
        }
    </script>
@endsection
<script type="text/javascript">
    function actualizarEstatus(element) {
        let id = $(element).attr("data-id");
        let estatus = ($(element).is(':checked')) ? 1 : 0;
        var data = {
            id: id,
            estatus: estatus
        };

        if(estatus==1){
            $(".stoppage"+id).removeClass("btn-danger");
            $(".stoppage"+id).addClass("btn-success");
            $(".stoppage"+id).html("Activa");
            // $(".slider.round:before").css("background-color: #47c363;");
        }else{
            $(".stoppage"+id).removeClass("btn-success");
            $(".stoppage"+id).addClass("btn-danger");
            $(".stoppage"+id).html("Inactiva");
            // $(".slider.round:before").css("background-color: #FFFFFF;");
        }


        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            url: 'motivos',
            data: data,
            type: 'post',
            success: function(response) {
                // alert(response);
                console.log(response);
            },
            statusCode: {
                // 404: function() {
                //     alert('web not found');
                // }
            },
            error: function(x, xs, xt) {
                // window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    }
</script>
