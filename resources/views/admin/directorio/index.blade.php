@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'directorio')
@section('tab_title', 'directorio | ' . config('app.name'))
@section('description', 'Lista de directorio.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Directorio
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $directories->count() }} elementos registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Directorio
            </h3>

            @if (! $directories->count())
                <p class="text-center py-1">
                    Por el momento no hay elementos registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $directories }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Correo</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="DirectoryItem in resourceList" class="table-resource__row" :key="DirectoryItem.id">
                                <td data-label="Nombre:">
                                    @{{ DirectoryItem.name }}
                                </td>
                                <td data-label="Puesto:">
                                    @{{ DirectoryItem.position }}
                                </td>
                                <td data-label="Correo electrónico:">
                                    @{{ DirectoryItem.email }}
                                </td>
                                

                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/directorio/' + DirectoryItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/directorio/eliminar/' + DirectoryItem.id"
                                        :resource-id="DirectoryItem.id"
                                        :options="{ onDelete: onResourceDelete }"
                                    >
                                        <img class="svg-icon" src="{{ url('img/svg/trash.svg')}}">
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
