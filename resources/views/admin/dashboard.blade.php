@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('meta.title', 'Panel de administración' )
@section('meta.tab_title', 'Panel de administración | ' . config('app.name'))
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Panel de administración
        </h1>
    </div>

    <div class="fluid-container">
        <p class="size-xl">
            <strong>Bienvenida(o)</strong>
        </p>

        <p>
            Utiliza el menú para acceder a las áreas del sitio en donde puedes realizar cambios o consultar información.
        </p>

        <p>
            No olvides <strong>cerrar la sesión</strong> (en la parte superior derecha de esta pantalla) antes de cerrar la pestaña o si vas a estar alejado de tu computadora o dispositivo.
        </p>
    </div>

@endsection
