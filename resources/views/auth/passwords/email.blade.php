@extends('layout.master')

{{-- Metadata --}}
@section('meta.title', 'Recuperar contaseña')
@section('meta.tab_title', 'Recuperar contaseña | ' . config('app.name'))
@section('meta.description', 'Acceso al panel de administración.')
@section('meta.canonical', config('app.url') . '/admin')
@section('meta.indexed', 'false')
@section('css_classes', 'login')


@section('content')
    <section class=" container section">

        <h1 class="h2 text-center">
            Recuperar contraseña
        </h1>
         @alert(['class' => 'alert--has-icon size-caption'])
        @endalert

        <p class="text-center mb-4">Escribe tu correo electrónico para recibir un enlace que te permitirá restablecer tu contraseña.</p>

        <div class="login-form ">
            <base-form action="{{ url('contrasena') }}"
                inline-template
                v-cloak
            >
                <form class="form-boxed centered">
                    <div class="form-control">
                        <label for="email">Correo electrónico</label>
                        <text-field name="email" type="email" v-model="fields.email" maxlength="60" placeholder="" initial=""></text-field>
                        <field-errors name="email"></field-errors>
                    </div>
                    <div class="text-center">
                        <form-button class="btn--success w-full">
                            Enviar
                        </form-button>
                    </div>
                </form>
            </base-form>
        </div>
    </section>
@endsection
