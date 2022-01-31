@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar convocatorias')
@section('tab_title', 'Agregar convocatorias | ' . config('app.name'))
@section('description', 'Agregar convocatorias.')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Agregar convocatorias
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/convocatorias/') }}">Ver todas las convocatorias</a>
        </p>

        <call-form class="form-registration"
        action="{{ url('admin/convocatorias/crear') }}"
        filesurl="{{ url('admin/tipos-archivos/data') }}"
        enctype="multipart/form-data"

        :call_types="{{ $call_types }}"
        :call="{}"
    >
    </call-form>

    </div>
</section>

@endsection
