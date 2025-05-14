@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar elemento al directorio')
@section('tab_title', 'Agregar elemento al directorio | ' . config('app.name'))
@section('description', 'Agregar elemento al directorio.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Agregar al directorio
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/directorio/') }}">Ver todos el directorio</a>
        </p>

            <base-form action="{{ url('admin/directorio/crear') }}"
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
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="80" initial=""></text-field>
                                    <field-errors name="name"></field-errors>

                                </div>
                            </div>
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="position">Puesto</label>
                                    <text-field name="position" v-model="fields.position" maxlength="80" initial=""></text-field>
                                    <field-errors name="position"></field-errors>

                                </div>
                            </div>

                        </div>
                        <div class="md:row mb-4">
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="email">Correo electrónico</label>
                                    <text-field name="email" v-model="fields.email" maxlength="80" initial=""></text-field>
                                    <field-errors name="email"></field-errors>

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
