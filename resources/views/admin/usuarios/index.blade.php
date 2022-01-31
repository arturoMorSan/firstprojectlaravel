@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Usuarios')
@section('tab_title', 'Usuarios | ' . config('app.name'))
@section('description', 'Lista de noticias publicadas.')
@section('class', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Usuarios
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $users->count() }} usuarios registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @alert(['class' => 'alert--has-icon size-caption'])
        @endalert

        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de usuarios
            </h3>

            @if (! $users->count())
                <p class="text-center py-1">
                    Por el momento no hay usuarios registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $users }}" inline-template>

                    <table class="table table-resource table--striped"
                        :class="{ 'table-resource--wide' : wideView }"
                    >
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Folio</th>
                                <th>Matricula</th>
                                <th>Nombre completo</th>
                                <th>Correo Electrónico</th>
                                <th>Roles</th>
                                <th>Activo</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="userItem in resourceList" class="table-resource__row" :key="userItem.id">
                                <td data-heading="Folio:">
                                    <a class="" :href="$root.path + '/admin/usuarios/' + userItem.id + '/editar'">
                                        <span v-if="userItem.folio != null">
                                            @{{ userItem.folio }}
                                        </span>
                                        <span v-else>
                                             -
                                        </span>
                                    </a>
                                </td>

                                <td data-heading="Matricula:">
                                    <span v-if="userItem.matricula != null">
                                        @{{ userItem.matricula }}
                                    </span>
                                    <span v-else>
                                        -
                                    </span>
                                </td>

                                <td data-heading="Nombre completo:">
                                    @{{ userItem.full_name }}
                                </td>
                                <td data-heading="Correo electrónico:">
                                    @{{ userItem.email }}
                                </td>
                                <td data-heading="Roles:">
                                    @{{ userItem.all_roles }}
                                </td>
                                <td data-heading="Roles:">
                                    <span v-if="userItem.is_active">
                                        Activo
                                    </span>
                                    <span v-else>
                                        No activo
                                    </span>
                                </td>

                                <td class="table-resource__actions" data-heading="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--edit mr-2" :href="$root.path + '/admin/usuarios/' + userItem.id + '/editar' ">
                                        @svg('edit')
                                        Editar
                                    </a>

                                    <delete-button v-if="userItem.id != {{ Auth::user()->id }}" :url="$root.path + '/admin/usuarios/eliminar/' + userItem.id"
                                        :resource-id="userItem.id"
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
