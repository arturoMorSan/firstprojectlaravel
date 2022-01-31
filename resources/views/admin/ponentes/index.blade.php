@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('meta.title', 'Proyectos' )
@section('meta.tab_title', 'Ponentes | Panel de administración | ' . config('app.name'))
@section('css_classes', 'dashboard')

@section('content')
    <section class="section mb-16">
        <div class="container">
            <h1 class="dashboard-title">
                Proyectos
            </h1>

            <tabs-component class="tabs--sm"
                :breakpoint="1160"
                :tabs="{{ json_encode($statusesWithCount) }}"
                :options="{{ json_encode($statuses) }}"
                :accepts-html="true"
            >

                @foreach ($statuses as $status => $tabContent)

                    <template slot="panel-{{ $status }}">

                        @if ($attendees = $attendeesByStatus->get($status))
                            <resource-table
                                :breakpoint="800"
                                :model="{{ $attendees }}"
                                inline-template
                            >
                                <table
                                    class="table table-resource table--header-primary table--full-width table--striped"
                                    :class="{ 'table-resource--wide' : wideView }"
                                    >
                                    <thead>
                                        <tr>
                                            <th>
                                                Nombre
                                            </th>
                                            <th>
                                                Nombre del proyecto
                                            </th>
                                            <th>
                                                Correo electrónico
                                            </th>
                                            <th>
                                                Carrera
                                            </th>
                                            <th>
                                                Cuatrimestre
                                            </th>
                                            <th>
                                                Tipo de asistente
                                            </th>
                                            @if (Gate::allows('assign.project'))
                                                <th>
                                                    Acciones
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="attendeeItem in resourceList" class="table-resource__row" :key="attendeeItem.id">
                                            <td data-heading="Nombre:">
                                                <a :href="$root.path + '/admin/ponente/' + attendeeItem.id">
                                                    @{{ attendeeItem.full_name }}
                                                </a>
                                            </td>
                                            <td data-heading="Nombre del proyecto:">
                                                @{{ attendeeItem.project_name }}
                                            </td>
                                             <td data-heading="correo electrónico:">
                                                @{{ attendeeItem.email }}
                                            </td>
                                            <td data-heading="Carrera:">
                                                @{{ attendeeItem.career }}
                                            </td>
                                            <td data-heading="Cuatrimestre:">
                                                @{{ attendeeItem.quarter }}
                                            </td>
                                            <td data-heading="Tipo de asistente:">
                                                <span v-if="attendeeItem.type_assistant == 'alumno'">Alumno</span>
                                                <span v-if="attendeeItem.type_assistant == 'docente'">Docente</span>
                                            </td>
                                            @if (Gate::allows('assign.project'))
                                                <td data-heading="Acciones:">
                                                    <delete-button :url="$root.path + '/admin/participantes/eliminar/' + attendeeItem.id"
                                                        :resource-id="attendeeItem.id"
                                                        :options="{ onDelete: onResourceDelete }"
                                                    >
                                                        @svg('trash')
                                                        Eliminar
                                                    </delete-button>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </resource-table>
                        @else
                            <p class="text-center color-gray-darken-1">
                                No hay ponentes con el estado “{{ trans_choice('status.' . $status, 2) }}”.
                            </p>
                        @endif

                    </template>

                @endforeach
            </tabs-component>

        </div>
    </section>
@endsection