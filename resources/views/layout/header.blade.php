
<site-header
    :logo="'{{ url('img/cluster-minero-logo.png') }}'"
    :uri="'{{ url('/') }}'"
    :breakpoint="760"
>
    <template slot="button-session">
        <div class="menu__container">
            <site-menu
            :breakpoint="760"
            :links="{
                'Inicio': '/#inicio',
                'Acerca de': '/#acerca',
                'Servicios': '/#servicios',
                'Empresas': '/#empresas',
                'Proveedores': '/#proveedores',
                'Plataforma': '/#plataforma',
                'Directorio': '/#directorio',
                'Noticias': '/#news',
                'Contacto': '/#contacto',
            }"
            active-link="{{ $activeLink }}"
            >
                <template slot="close">
                    Cerrar X
                </template>
            </site-menu>
            @guest
                <a href="{{ url('login') }}" class="btn btn--outline-primary btn-login-menu">
                    <img class="img-user-login" src="{{ url('img/header/users.svg') }}">
                    Ingresar
                </a>
            @endguest
        </div>
    </template>
</site-header>


