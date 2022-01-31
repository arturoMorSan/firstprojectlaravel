@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('meta.title', 'Ponentes' )
@section('meta.tab_title', 'Ponentes | Panel de administración | ' . config('app.name'))
@section('css_classes', 'dashboard')

@section('content')
    <section class="section mb-16">
        <div class="container">
            <h1 class="dashboard-title mb-16">
                Asistentes
            </h1>
            @if($attendees->count())
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
                                    Correo electrónico
                                </th>
                                <th>
                                    Escuela
                                </th>
                                <th>
                                    Carrera
                                </th>
                                <th>
                                    Semestre
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
                                    @{{ attendeeItem.full_name }}
                                </td>
                                <td data-heading="Correo electrónico:">
                                    @{{ attendeeItem.email }}
                                </td>
                                <td data-heading="Escuela:">
                                    @{{ attendeeItem.school }}
                                </td>
                                <td data-heading="Carrera:">
                                    @{{ attendeeItem.career }}
                                </td>
                                <td data-heading="Semestre:">
                                    @{{ attendeeItem.semester }}
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
                <p class="text-center">No se encontraron asistentes registrados</p>
            @endif
        </div>
    </section>
@endsection