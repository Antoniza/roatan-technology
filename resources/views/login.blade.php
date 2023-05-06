<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Technology</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="container">
        <div class="right-content">
            <form action="{{ route('post-login') }}" method="post">
                <h1>Iniciar Sesión</h1>
                @if (session('fail'))
                    <h4>{{session('fail')}}</h4>
                @endif
                @csrf
                <label for=""><box-icon type='solid' name='user-circle'></box-icon><span>Correo</span></label>
                <input type="email" name="email" autofocus>
                <label for=""><box-icon type='solid' name='lock-alt'></box-icon><span>Contraseña</span></label>
                <input type="password" name="password" id="password">
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</html>