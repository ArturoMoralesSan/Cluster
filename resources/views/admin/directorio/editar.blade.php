@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar elemento del directorio')
@section('tab_title', 'Editar elemento del directorio | ' . config('app.name'))
@section('description', 'Editar elemento del directorio.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar elemento del directorio
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/directorio/') }}">Ver todo el directorio</a>
        </p>

            <base-form action="{{ url('admin/directorio/'. $directory->id .'/actualizar') }}"
                method="put"
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
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="100" initial="{{ $directory->name }}"></text-field>
                                    <field-errors name="name"></field-errors>
                                </div>
                            </div>
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="position">Puesto</label>
                                    <text-field name="position" v-model="fields.position" maxlength="100" initial="{{ $directory->name }}"></text-field>
                                    <field-errors name="position"></field-errors>
                                </div>
                            </div>
                        </div>
                        <div class="md:row mb-4">
                            <div class="md:col">
                                <div class="form-control">
                                    <label for="email">Correo electrónico</label>
                                    <text-field name="email" v-model="fields.email" maxlength="100" initial="{{ $directory->email }}"></text-field>
                                    <field-errors name="email"></field-errors>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Portada
                        </h3>
                        <div clas="md:row">
                            @if($directory->image_url)
                                <div class="preview-aside">
                                    <figure class="preview-aside__box preview-box">
                                        
                                        <img class="preview-box__img" src="{{ url($directory->image_url) }}" alt="" ref="thumb">                                  
                                        <figcaption class="preview-box__caption">
                                            Imagen actual
                                        </figcaption>
                                    </figure>
                                </div>
                            @endif
                            <div class="md:col-2/3">
                                {{-- Avatar --}}
                                <div class="form-control">
                                    <label for="cover">Agregar imagen</label>

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
