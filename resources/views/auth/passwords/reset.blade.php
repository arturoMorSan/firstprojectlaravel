@extends('layout.master')

{{-- Metadata --}}
@section('title', 'Restablecer contraseña')
@section('tab_title', 'Restablecer contraseña | ' . config('app.name'))
@section('description', 'Restablecer contraseña.')
@section('canonical', config('app.url') . '/contrasena/restablecer')
@section('indexed', 'false')


@section('content')
    <section class=" container section">

        <h1 class="h2 text-center">
            Restablecer contraseña
        </h1>
         @alert(['class' => 'alert--has-icon size-caption'])
        @endalert

        <div class="login-form ">
            <base-form action="{{ url('contrasena/restablecer') }}"
                inline-template
                v-cloak
            >
               <form class="form-boxed">
                        <text-field name="token" type="hidden" v-model="fields.token" maxlength="60" placeholder="" initial="{{ $token}}"></text-field>
                        <div class="form-control">
                            <label for="email">Correo electrónico</label>
                            <text-field name="email" type="email" v-model="fields.email" maxlength="60" placeholder="" initial=""></text-field>
                            <field-errors name="email"></field-errors>
                        </div>
                        <div class="form-control">
                            <label for="password">Nueva contraseña</label>
                            <text-field name="password" type="password" v-model="fields.password" maxlength="60" placeholder="" initial=""></text-field>
                            <field-errors name="password"></field-errors>
                        </div>
                        <div class="form-control">
                            <label for="password_confirmation">Confirmar nueva contraseña</label>
                            <text-field name="password_confirmation" type="password" v-model="fields.password_confirmation" maxlength="60" placeholder="" initial=""></text-field>
                            <field-errors name="password_confirmation"></field-errors>
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
