@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Convocatorias')
@section('tab_title', 'Convocatorias | ' . config('app.name'))
@section('description', 'Lista de noticias publicadas.')
@section('class', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Convocatorias
        </h1>
        <p class="dashboard-heading__caption">
            Hay {{ $calls->count() }} Convocatorias registradas.
        </p>
    </div>
    <div class="fluid-container mb-16">
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de convocatorias
            </h3>
            @if (! $calls->count())
                <p class="text-center py-1">
                    Por el momento no hay convocatorias publicadas.
                </p>
            @else
                <resource-table :breakpoint="800" :model="{{ $calls }}" inline-template>
                    <table class="table table-resource table--header-primary table--full-width table--striped"
                        :class="{ 'table-resource--wide' : wideView }"
                    >
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de termino</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="callItem in resourceList" class="table-resource__row" :key="callItem.id">
                                <td data-heading="Nombre:">
                                    <a class="" :href="$root.path + '/admin/detalle-convocatoria/' + callItem.id">
                                       @{{ callItem.title }}
                                    </a>
                                </td>
                                <td data-heading="fecha de inicio:">
                                    @{{ callItem.fecha_inicio }}
                                </td>
                                <td data-heading="fecha de termino:">
                                    @{{ callItem.fecha_termino }}
                                </td>
                                <td class="table-resource__actions" data-heading="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--edit mr-2" :href="$root.path + '/admin/convocatorias/' + callItem.id + '/editar' ">
                                        @svg('edit')
                                        Editar
                                    </a>

                                    <delete-button :url="$root.path + '/admin/convocatorias/eliminar/' + callItem.id"
                                        :resource-id="callItem.id"
                                        :options="{ onDelete: onResourceDelete }"
                                    >
                                        @svg('trash')
                                        Eliminar
                                    </delete-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </resource-table>
            @endif
        </section>
    </div>
@endsection
