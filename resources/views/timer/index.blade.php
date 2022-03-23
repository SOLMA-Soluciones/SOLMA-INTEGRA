@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Timer</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                    <div class="panel-body">
                                   
                                       
                                        <table class="table table-striped mt-2">
                                        <thead style="background-color:#6777ef">                                     
                                                                                                              
                                        </thead>
                                        <tbody>
                                            @foreach ($motivos as $motivo)
                                            <tr>
                                                <td style="display: none;">{{ $motivo->id }}</td>
                                                <td id="resp{{ $motivo->id }}">
                                                <br>
                                                    @if($motivo->estatus == 1)
                                                    <button type="button" class="btn btn-sm btn-success">{{ $motivo->nombre }}</button>
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                            
                                    </div>                                                              
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

