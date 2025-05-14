@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Servicios')
@section('tab_title', 'Servicios | ' . config('app.name'))
@section('description', 'Lista de servicios.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Servicios
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $services->count() }} elementos registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Servicios
            </h3>

            @if (! $services->count())
                <p class="text-center py-1">
                    Por el momento no hay elementos registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $services }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="descriptionItem in resourceList" class="table-resource__row" :key="descriptionItem.id">
                                <td data-label="Titulo:">
                                    @{{ descriptionItem.name }}
                                </td>
                                
                                <td data-label="Descripción:" v-html="descriptionItem.description">
                                    
                                </td>
                                <td data-label="Imagen:">
                                    <img style="height:40px;" :src="$root.path +'/'+ descriptionItem.image_url" v-if="descriptionItem.image_url">
                                </td>

                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/servicios/' + descriptionItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/servicios/eliminar/' + descriptionItem.id"
                                        :resource-id="descriptionItem.id"
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
