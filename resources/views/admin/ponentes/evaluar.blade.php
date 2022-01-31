@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('meta.title', 'Detalle de ponente' )
@section('meta.tab_title', 'Detalle de ponente | Panel de administración | ' . config('app.name'))
@section('css_classes', 'dashboard')

@section('content')

<section class="section mb-16">
    <div class="container">
        <h1 class="dashboard-title">
            Evaluar proyecto
        </h1>

        <p class="mb-12">
            @include('components.alert')

            <span class="color-link">«</span>
            <a href="{{ url('admin/proyecto/' . $project->folio) }}">Datos de proyecto</a>
        </p>

        <p>
            Con base en el análisis se emite el siguiente dictamen:
        </p>


        <base-form action="{{ url('admin/proyecto/' . $project->folio . '/evaluar') }}"
            method="put"
            inline-template
            enctype="multipart/form-data"
            v-cloak
        >
            <form>
                {{-- Status --}}
                <div class="form-control">
                    @foreach ($statuses as $status)
                        <div>
                            <label>
                                <input id="status-{{ $status->key_name }}"
                                    class="radio"
                                    type="radio"
                                    v-model="fields.status"
                                    value="{{ $status->key_name }}"
                                >
                                {{ $status->name }}
                            </label>
                        </div>
                    @endforeach

                    <field-errors name="status"></field-errors>
                </div>
                <div class="form-control">
                    <label for="document">
                        Rúbrica
                        <span class="description">
                            Opcional
                        </span>
                    </label>
                    <file-field name="document" v-model="fields.document" aria-describedby="document-specs"></file-field>
                    <field-errors name="document"></field-errors>
                    <ul id="document-specs" class="description color-gray-darken-1">
                        <li>Tamaño máximo: 5 MB.</li>
                        <li>Sólo archivos con extensión pdf.</li>
                    </ul>
                </div>
                {{-- Observations --}}
                <div class="form-control">
                    <label for="observations">Observaciones
                        <span class="description"
                        > Opcional
                        </span>
                    </label>

                    <text-area name="observations" v-model="fields.observations" rows="15"></text-area>

                    <field-errors name="observations"></field-errors>

                    <p class="description">
                        Las observaciones se enviarán al ponente y quedarán guardadas en el panel de administración.
                    </p>
                </div>

                <form-button class="btn--primary btn--wide mt-4">
                    Enviar
                </form-button>
            </form>
        </base-form>

    </div>
</section>

@endsection
