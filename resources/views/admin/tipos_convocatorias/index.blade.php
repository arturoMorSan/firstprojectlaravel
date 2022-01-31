@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'tipos de convocatorias')
@section('tab_title', 'tipos de convocatorias | ' . config('app.name'))
@section('description', 'Lista de tipos de convocatorias.')
@section('class', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
             Tipos de convocatorias
        </h1>
        <p class="dashboard-heading__caption">
            Hay {{ $types->count() }} tipos de convocatorias registrados.
        </p>
    </div>
    <div class="fluid-container mb-16">
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de tipos de convocatorias
            </h3>
            @if (! $types->count())
                <p class="text-center py-1">
                    Por el momento no hay tipos de convocatorias publicados.
                </p>
            @else
                <resource-table :breakpoint="800" :model="{{ $types }}" inline-template>
                    <table class="table table-resource table--header-primary table--full-width table--striped"
                        :class="{ 'table-resource--wide' : wideView }"
                    >
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="typeItem in resourceList" class="table-resource__row" :key="typeItem.id">
                                <td data-heading="Nombre:">
                                    <a class="" :href="$root.path + '/admin/tipos-convocatorias/' + typeItem.id + '/editar'">
                                       @{{ typeItem.name }}
                                    </a>
                                </td>
                                <td class="table-resource__actions" data-heading="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--edit mr-2" :href="$root.path + '/admin/tipos-convocatorias/' + typeItem.id + '/editar' ">
                                        @svg('edit')
                                        Editar
                                    </a>

                                    <delete-button :url="$root.path + '/admin/tipos-convocatorias/eliminar/' + typeItem.id"
                                        :resource-id="typeItem.id"
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
