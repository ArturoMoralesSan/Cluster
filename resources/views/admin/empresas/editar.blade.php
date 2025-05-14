@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar empresa')
@section('tab_title', 'Editar empresa | ' . config('app.name'))
@section('description', 'Editar empresa.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar empresa
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/empresas/') }}">Ver todas las empresas</a>
        </p>

            <base-form action="{{ url('admin/empresas/'. $company->id .'/actualizar') }}"
                method="put"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos de la empresa
                        </h3>

                        <div class="md:row">
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="80" initial="{{ $company->name }}"></text-field>
                                    <field-errors name="name"></field-errors>

                                </div>
                            </div>
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="type">Tipo</label>
                                    <select-field
                                        name="type"
                                        v-model="fields.type"
                                        :options="{ 'Empresa': 'Empresa', 'Proveedor': 'Proveedor'}"
                                        initial="{{ $company->type }}"
                                    >
                                    </select-field>                                    
                                    <field-errors name="type"></field-errors>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Portada
                        </h3>
                        <div class="md:row">
                            <div class="preview-aside">
                                <figure class="preview-aside__box preview-box">

                                    <img class="preview-box__img" src="{{ url($company->image_url) }}" alt="" ref="thumb">                                  
                                    <figcaption class="preview-box__caption">
                                        Imagen actual
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="md:col-2/3">
                                {{-- Avatar --}}
                                <div class="form-control">
                                    <label for="cover" v-text="hasAvatar ? 'Reemplazar imagen' : 'Agregar imagen'"></label>

                                    <file-field name="cover" v-model="fields.cover"></file-field>

                                    <field-errors name="cover"></field-errors>
                                    <ul id="cover-specs" class="description color-gray-darken-1">
                                        <li>
                                            Tamaño máximo: 1 MB.
                                        </li>
                                        <li>
                                            Sólo archivos con extensión jpeg, gif, png.
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="text-center">
                        <form-button class="btn--blue--dashboard btn--wide">
                            Actualizar
                        </form-button>
                    </div>
                </form>
            </user-form>
    </div>
</section>

@endsection
