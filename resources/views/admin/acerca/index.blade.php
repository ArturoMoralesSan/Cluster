@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Acerca')
@section('tab_title', 'Acerca | ' . config('app.name'))
@section('description', 'Lista de acerca.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Acerca
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $abouts->count() }} elementos registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Acerca
            </h3>

            @if (! $abouts->count())
                <p class="text-center py-1">
                    Por el momento no hay elementos registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $abouts }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Titulo</th>
                                <th>Tipo</th>
                                <th>Acerca</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="aboutItem in resourceList" class="table-resource__row" :key="aboutItem.id">
                                <td data-label="Titulo:">
                                    @{{ aboutItem.title }}
                                </td>
                                <td data-label="Tipo:">
                                    @{{ aboutItem.type_about.name }}
                                </td>
                                <td data-label="Descripción:" v-html="aboutItem.content">
                                    
                                </td>

                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/acerca/' + aboutItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/acerca/eliminar/' + aboutItem.id"
                                        :resource-id="aboutItem.id"
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
