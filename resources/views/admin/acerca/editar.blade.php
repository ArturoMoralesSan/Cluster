@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar elemento a acerca')
@section('tab_title', 'Editar elemento a acerca | ' . config('app.name'))
@section('description', 'Editar elemento a acerca.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar elemento a acerca
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/acerca/') }}">Ver todos los elementos de acerca</a>
        </p>

            <base-form action="{{ url('admin/acerca/'. $about->id .'/actualizar') }}"
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
                                    <label for="title">Titulo</label>
                                    <text-field name="title" v-model="fields.title" maxlength="100" initial="{{ $about->title }}"></text-field>
                                    <field-errors name="title"></field-errors>
                                </div>
                            </div>
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="type">Tipo de sección</label>
                                    <search-select-field
                                        name="type"
                                        v-model="fields.type"
                                        :options="{{ $types }}"
                                        :initial= "{{ $about->type_about_id }}"                                    >
                                    </search-select-field> 
                                    <field-errors name="type"></field-errors>
                                </div>
                            </div>
                        </div>
                        <div class="md:row mb-4">
                            <div class="md:col">
                                <div class="form-control">
                                    <label for="description">Descripción</label>
                                    <text-area-tiny 
                                        name="description" 
                                        v-model="fields.description" 
                                        :initial-value="{{ json_encode($about->content) }}">
                                    </text-area-tiny>
                                    <field-errors name="email"></field-errors>
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
