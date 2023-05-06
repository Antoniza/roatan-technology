<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Technology</title>

    {{-- * IMPORTING THE CSS ELEMENTS --}}
    @include('includes.stylesheets')

    {{-- * IMPORTING JQUERY LIBRARY WITH CDN AND FILE FOR ANY CASE OF INTERNET DISCONNECTION --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    {{-- * CREATING THE MAIN COMPONENT --}}
    @auth
    <div class="main-container">
        <div class="main-header">
            <div class="header-brand">
                <img src="" alt="">
                <a href="{{route('dashboard')}}">Roatan Technology</a>
            </div>
            <div class="header-options">
                <li><a href="{{route('dashboard-repairs')}}">Reparaciones</a></li>
                |
                <li><a href="{{route('dashboard-technicals')}}">Técnicos</a></li>
                |
                <li><a href="{{route('dashboard-services_products')}}">Productos y Servicios</a></li>
                <div class="profile">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
        <div class="profile-menu">
            <div class="profile-header">
                <img src="https://images.unsplash.com/photo-1518889735218-3e3a03fd3128?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="">
                <span>{{Auth::user()->name}}</span>
            </div>
            <div class="profile-body">
                <a href="#">Configuración</a>
                <a href="/logout" class="logout">Salir</a>
            </div>
        </div>
        <div class="main-body">
            @yield('content')
        </div>
    </div>
@endauth
</body>
{{-- * IMPORTING THE JS ELEMENTS --}}
@include('includes.javascript')

</html>
