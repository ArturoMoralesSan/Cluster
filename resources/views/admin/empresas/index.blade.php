@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'empresas')
@section('tab_title', 'empresas | ' . config('app.name'))
@section('description', 'Lista de empresas.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Empresas
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $companies->count() }} empresas registradas.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de empresas
            </h3>

            @if (! $companies->count())
                <p class="text-center py-1">
                    Por el momento no hay empresas registradas.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $companies }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Portada</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="companyItem in resourceList" class="table-resource__row" :key="companyItem.id">
                                <td data-label="Nombre:">
                                    @{{ companyItem.name }}
                                </td>
                                <td data-label="Tipo:">
                                    @{{ companyItem.type }}
                                </td>
                                <td data-label="Foto:">
                                    <img style="height:40px;" :src="$root.path +'/'+ companyItem.image_url" v-if="companyItem.image_url">
                                </td>
                                
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/empresas/' + companyItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/empresas/eliminar/' + companyItem.id"
                                        :resource-id="companyItem.id"
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
