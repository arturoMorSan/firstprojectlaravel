@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar convocatorias')
@section('tab_title', 'Editar convocatorias | ' . config('app.name'))
@section('description', 'Editar convocatorias.')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar convocatorias
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/convocatorias/') }}">Ver todas las convocatorias</a>
        </p>

        <call-form class="form-registration"
        method="put"
        action="{{ url('admin/convocatorias/'.$call->id.'/actualizar') }}"
        enctype="multipart/form-data"
        :call_types="{{ $call_types }}"
        :call="{{ $call }}"
    >
    </call-form>

    </div>
</section>

@endsection
