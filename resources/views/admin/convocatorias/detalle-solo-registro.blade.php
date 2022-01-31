@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Convocatorias')
@section('tab_title', 'Convocatorias | ' . config('app.name'))
@section('description', 'Lista de usuarios registrado.')
@section('class', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Convocatoria: {{ $call->title }}
        </h1>
        <p class="dashboard-heading__caption">
            Hay {{ $call->UsersCall->count() }} usuarios registrados.
        </p>
    </div>


    <div class="fluid-container mb-16">
        @alert(['class' => 'alert--has-icon size-caption'])
        @endalert 
        <div class="row mb-8">
            <div class="container">
                <a class="btn btn--success btn--xs" href="{{ url('admin/descarga-excel/'. $call->id) }}">Descargar en excel</a>
            </div>
        </div>
        <section class="db-panel">
            <h3 class="db-panel__title">
                Usuarios registrados
            </h3>
            <table-accordion :users="{{ $call->UsersCall }}">

            </table-accordion>

        </section>
    </div>
@endsection
