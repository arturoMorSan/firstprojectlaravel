@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
    <section class="section section--bordered " id="registro">
    <div class="container">
        <h1 class="h2 text-center mb-12">Iniciar sesión</h1>

        @include('components.alert')
        <div class="login-form">
                <base-form action="{{ url('iniciar-sesion') }}"
                    inline-template
                    v-cloak
                >
                    <form class="form-boxed form-w-300">
                        <div class="form-control">
                            <label for="email">Correo electrónico</label>
                            <text-field name="email" type="email" v-model="fields.email" maxlength="60" placeholder="" initial=""></text-field>
                            <field-errors name="email"></field-errors>
                        </div>
                        <div class="form-control">
                            <label for="password">Contraseña</label>
                            <text-field name="password" type="password" v-model="fields.password" maxlength="60" placeholder="" initial=""></text-field>
                            <field-errors name="password"></field-errors>
                        </div>

                        <div class="text-center">
                            <form-button class="btn--success w-full">
                                Enviar
                            </form-button>
                        </div>
                    </form>
                </base-form>
            </div>
    </div>
</section>
@endsection
