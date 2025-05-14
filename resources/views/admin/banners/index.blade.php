@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Banners')
@section('tab_title', 'Banners | ' . config('app.name'))
@section('description', 'Lista de banners.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Banners
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $banners->count() }} Banners registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de banners
            </h3>

            @if (! $banners->count())
                <p class="text-center py-1">
                    Por el momento no hay banners registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $banners }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Titulo</th>
                                <th>Enlace</th>
                                <th>Descripción</th>
                                <th>Portada</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="bannerItem in resourceList" class="table-resource__row" :key="bannerItem.id">
                                <td data-label="Titulo:">
                                    @{{ bannerItem.title }}
                                </td>
                                <td data-label="Enlace:">
                                    @{{ bannerItem.link }}
                                </td>
                                <td data-label="Descripción:" v-html="bannerItem.description">
                                </td>
                                <td data-label="Foto:">
                                    <img style="height:40px;" :src="$root.path +'/'+ bannerItem.image_url" v-if="bannerItem.image_url">
                                </td>
                                
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/banners/' + bannerItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/banners/eliminar/' + bannerItem.id"
                                        :resource-id="bannerItem.id"
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
