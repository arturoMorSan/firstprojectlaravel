@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Evaluar proyecto')
@section('tab_title', 'Evaluar proyecto | ' . config('app.name'))
@section('description', 'Evaluación de proyecto.')

@section('content')

<section class="section mb-16">
    <div class="container">
        <h1 class="dashboard-title">
            Evaluar periodo: {{ $reviewDocument->callPeriod->description }}
        </h1>

        <p class="mb-12">
            @include('components.alert')

            <span class="color-link">«</span>
            <a href="{{ url('admin/proyecto/' . $reviewDocument->project->folio) }}">Datos de proyecto</a>
        </p>

        <p>
            Con base en el análisis se emite el siguiente dictamen:
        </p>


        <base-form action="{{ url('admin/archivo/' . $reviewDocument->project->folio . '/evaluar') }}"
            inline-template
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
