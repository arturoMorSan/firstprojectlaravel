@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Convocatorias')
@section('tab_title', 'Convocatorias | ' . config('app.name'))
@section('description', 'Lista de noticias publicadas.')
@section('class', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Convocatoria: {{ $call->title }}
        </h1>
    </div>
    <div class="fluid-container mb-16">
        @alert(['class' => 'alert--has-icon size-caption'])
        @endalert
        @foreach($call->projects as $project)
            <section class="db-panel">
                <h3 class="db-panel__title">
                    {{ $project->name }}
                </h3>
                <resource-table :breakpoint="800" :model="{{ $project->users }}" inline-template>
                    <table class="table table-resource table--striped"
                    >
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Correo electrónico</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="userItem in resourceList" class="table-resource__row" :key="userItem.id">
                                <td data-heading="Nombre:">
                                    @{{ userItem.name }} @{{ userItem.last_name }}
                                </td>
                                <td data-heading="Correo electrónico:">
                                    @{{ userItem.email }}
                                </td>
                                <td data-heading="Teléfono:">
                                    @{{ userItem.telephone }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </resource-table>

            </section>
        @endforeach
    </div>
@endsection
