<style>
    .main-content{
        padding-top: 50px !important;
        padding-right: 0px !important;
        padding-left: 250px !important;
    }
    .section .section-header{
        margin-bottom: 0px !important;
    }
</style>
@extends('layouts.app')

@section('content')
    <section class="section section-report">
        {{-- <div class="section-header">
            <h3 class="page__heading">Reportes OEE</h3>
        </div> --}}
        <iframe style="width: 100%; height: 680px;"  src="https://datastudio.google.com/embed/reporting/3919acc5-8be3-45ad-8659-7e666518bfd5/page/p_3h7tvrc4vc" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
@endsection
