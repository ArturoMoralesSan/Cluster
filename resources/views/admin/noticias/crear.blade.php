@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar una noticia')
@section('tab_title', 'Agregar una noticia | ' . config('app.name'))
@section('description', 'Agregar una noticia.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Agregar una noticia
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/noticias/') }}">Ver todas las noticias</a>
        </p>

            <base-form action="{{ url('admin/noticias/crear') }}"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos generales
                        </h3>

                        <div class="md:row mb-4">
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="title">Titulo</label>
                                    <text-field name="title" v-model="fields.title" maxlength="80" initial=""></text-field>
                                    <field-errors name="title"></field-errors>

                                </div>
                            </div>
                        </div>
                        <div class="md:row"> 
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="description">Descripción</label>
                                    <text-area-tiny 
                                        name="description" 
                                        v-model="fields.description">
                                    </text-area-tiny>
                                    <field-errors name="description"></field-errors>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Imagen
                        </h3>
                        <div class="md:row">
                            <div class="md:col-2/3">
                                <div class="form-control">
                                    <label for="cover"> Agregar imagen</label>

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
                        <form-button class="btn--success btn--wide">
                            Crear
                        </form-button>
                    </div>
                </form>
            </base-form>
    </div>
</section>

@endsection
