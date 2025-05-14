@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '')
@section('canonical', config('app.url'))
@section('class', 'home')
@section('content')
    <section id="inicio" class="hero">
        <hero
        background-image="{{ url($banner->image_url) }}"
        :is-parallax-active="true"
        hero-height="85vh"
        >
            <template slot="container">
                <h1 class="hero-title">
                    {{ $banner->title }}
                </h1>
                <div class="hero-p">
                    {!! $banner->description !!}
                </div>
               <!--  <a class="btn hero-button" href="">Aprende más</a>--> 
            </template>
        </hero>
    </section>
    <section id="acerca" class="section__xl section__darkblue section__about">
        <div class="container">
            <h2 data-aos="fade-down" class="title title__white h3 text-center">ACERCA DE</h2>
            <hr data-aos="fade-down" class="title__divisor">

            <div class="md:row mb-4">
                <div data-aos="fade-right" class="about__text md:col-1/2">
                    <h2 class="h3 text-center title__white">Misión</h2>
                    
                        {!! $about['Misión'] ?? 'Contenido no disponible' !!}
                    
                </div>
                <div data-aos="fade-left" class="about__text md:col-1/2">
                    <h2 class="h3 text-center title__white mb-4">Visión</h2>

                    {!! $about['Visión'] ?? 'Contenido no disponible' !!}
                    
                </div>
            </div>
            <div data-aos="fade-up" class="about__text row mt-16">
                <div class="md:col">
                    <h2 class="h3 text-center title__white">Valores</h2>
                    
                    {!! $about['Valores'] ?? 'Contenido no disponible' !!}
                </div>
            </div>
        </div>
    </section>
    <section id="servicios" class="section__xl section__border--bottom">
        <div class="container">
            <h2 class="title h3 text-center" data-aos="fade-down">SERVICIOS</h2>
            <hr data-aos="fade-down" class="title__divisor">
            <div data-aos="fade-up" class="services__grid">
                @foreach($services as $service)
                    <div class="services__card card-equal">
                        <div class="services__card__image">
                            <img src="{{ asset($service->image_url) }}" alt="{{ $service->name }}">
                        </div>
                        <div class="services__card__content">
                            <h4 class="service__card__text">{{ $service->name }}</h4>
                            {!! $service->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="empresas" class="section__xl section__darkblue">
        <div class="container">
            <h2 data-aos="fade-down" class="title h3 title__white text-center">Empresas fundadoras</h2>
            <hr data-aos="fade-down" class="title__divisor">
            <div data-aos="fade-up" class="row">

                <carousel
                    :images='@json($imagesEmpresas)'
                        :visible-count="4"
                        :interval-time="2000" 
                ></carousel>
            </div>
        </div>
    </section>
    <section id="proveedores" class="section__xl">
        <div class="container">
            <h2 data-aos="fade-down" class="title h3 text-center">Proveedores agremiados</h2>
            <hr data-aos="fade-down" class="title__divisor">
            <div data-aos="fade-up" class="row">
                <carousel
                    :images='@json($imagesProveedores)'
                        :visible-count="3"
                        :interval-time="2000" 
                ></carousel>

            </div>
        </div>
    </section>

    <buttonvideo
        video-src="{{ asset('videos/app.mp4') }}"
        thumbnail="{{ asset('img/thumb.jpg') }}"
        background-image="{{ asset('img/fondo-plataforma.jpg') }}"
        title="PLATAFORMA NETWORKING"
        subtitle="CONECTA, COLABORA Y CRECE"
        description="Explora nuestra plataforma en este video."
        >
</buttonvideo>

    <section id="directorio" class="section__xl section__border--bottom">
        <div class="container">
            <h2 data-aos="fade-down" class="title h3 text-center">Directorio</h2>
            <hr data-aos="fade-down" class="title__divisor">

            <directory
            :directories="{{ $directories }}"
            ></directory>
            
        </div>
    </section>
    <section id="news" class="section__xl section__darkblue">
        <div class="container">
            <h2 class="title h3 title__white text-center" data-aos="fade-down">NOTICIAS</h2>
            <hr data-aos="fade-down" class="title__divisor">
            <div data-aos="fade-up" class="news__grid">
                @foreach($news as $item)
                    <div class="news__card">
                        <div class="news__image">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                            <div class="news__date">
                                <div class="news__date__day">{{ \Carbon\Carbon::parse($item->created_at)->format('d') }}</div>
                                <div class="news__date__month">{{ \Carbon\Carbon::parse($item->created_at)->locale('es')->translatedFormat('F') }}</div>
                                <div class="news__date__year">{{ \Carbon\Carbon::parse($item->created_at)->format('Y') }}</div>
                            </div>
                        </div>
                        <div class="news__content">
                            <h4 class="news__title">{{ $item->title }}</h4>
                            <p class="news__description">{{ Str::limit(strip_tags($item->description), 150) }}</p>
                            <a href="{{ 'noticia/'.$item->slug }}" class="news__button">Leer más</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contacto" class="section__xl">
        <div class="container">
            <h2 data-aos="fade-down" class="title h3 text-center">Contáctanos</h2>
            <hr data-aos="fade-down" class="title__divisor">
            <div class="md:row row-gap">
            <!-- Formulario con estilo de tarjeta -->
             <!-- Información de contacto con misma altura y estilo -->
                
                <div  data-aos="fade-up" class="md:col-2/3 contacto-card">
                    <h3 class="title h4 text-center">Envíanos un mensaje</h3>

                    <h4 class="h5 text-center mb-16">
                        Estamos aquí para ayudarte. Déjanos tu mensaje y te responderemos pronto.
                    </h4>
                    <base-form action="{{ url('contacto') }}"
                        enctype="multipart/form-data"
                        inline-template
                        v-cloak
                    >
                        <form>
                            @include('components.alert')
                            <div class="md:row mb-4">
                                <div class="md:col-1/2">
                                    <div class="form-control">
                                        <label for="name">Nombre</label>
                                        <text-field name="name" v-model="fields.name" maxlength="80" initial=""></text-field>
                                        <field-errors name="name"></field-errors>
                                    </div>
                                </div>
                                <div class="md:col-1/2">
                                    <div class="form-control">
                                        <label for="email">Correo electrónico</label>
                                        <text-field type="email" name="email" v-model="fields.email" maxlength="80" initial=""></text-field>
                                        <field-errors name="email"></field-errors>
                                    </div>
                                </div>
                            </div>

                            <div class="md:row mb-4">
                                <div class="md:col">
                                    <div class="form-control">
                                        <label for="subject">Asunto</label>
                                        <text-field name="subject" v-model="fields.subject" maxlength="80" initial=""></text-field>
                                        <field-errors name="subject"></field-errors>
                                    </div>
                                </div>
                            </div>

                            <div class="md:row mb-12"> 
                                <div class="md:col">
                                    <div class="form-control">
                                        <label for="message">Mensaje</label>
                                        <text-area
                                            cols="40"
                                            rows="10"
                                            name="message" 
                                            v-model="fields.message"
                                            class="text-area__noresize"
                                        ></text-area>
                                        <field-errors name="message"></field-errors>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <form-button class="btn btn--darkblue btn--wide">
                                    ENVIAR
                                </form-button>
                            </div>
                        </form>
                    </base-form>
                </div>

                <div data-aos="fade-up" class="md:col-1/3 contacto-info">
                    <h3 class="title title__white h4 text-center">Detalles de contacto</h3>
                    <div class="info-content">
                        <p>
                            <strong><i class="fa-brands fa-whatsapp"></i> whatsapp:</strong><br>
                            <a href="https://wa.me/526182333131" target="_blank">
                                618 233 3131
                            </a>
                        </p>
                        <p>
                            <strong><i class="fa-solid fa-envelope"></i> Email:</strong><br>
                            <a href="mailto:direcciongeneral@clusterminerodgo.com">
                                direcciongeneral@clusterminerodgo.com
                            </a>
                        </p>
                        <p> Encuentra nuestras oficinas en: <br>
                            <strong><i class="fa-solid fa-map-marker-alt"></i> Dirección:</strong><br>
                            <a href="https://www.google.com/maps?q=Cerro+Gordo+No.+100+Fracc.+Lomas+del+Parque+C.P.+34100+Esq.+Paseo+de+Navacoyán" target="_blank">
                                 Cerro Gordo No. 100 Fracc. Lomas del Parque C.P. 34100 Esq. Paseo de Navacoyán
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <scrolltotop></scrolltotop> 
@endsection