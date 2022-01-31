@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar tipo de convocatoria')
@section('tab_title', 'Agregar tipo de convocatoria | ' . config('app.name'))
@section('description', 'Agregar tipo de convocatoria.')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Crear tipo de convocatoria
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/tipos-convocatorias/') }}">Ver todos los tipos de convocatorias</a>
        </p>

            <base-form action="{{ url('admin/tipos-convocatorias/crear') }}"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Nuevo tipo de convocatoria
                        </h3>

                        <div class="md:row">
                            <div class="md:col-2/3">

                                {{-- matricula --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="60" initial=""></text-field>

                                    <field-errors name="name"></field-errors>
                                </div>
                            </div>

                        </div>
                    </section>
                    <div class="text-center">
                        <form-button class="btn--dashboard btn--wide">
                            Crear
                        </form-button>
                    </div>
                </form>
            </base-form>
    </div>
</section>

@endsection
