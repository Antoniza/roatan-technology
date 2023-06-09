<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Technology</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="right-content">
            @if (session('fail'))
                <div class="fail_login">{{session('fail')}}</div>
            @endif
            @if (session('message'))
                <div class="success_alert">{{session('message')}}</div>
            @endif
            <form action="{{ route('post-login') }}" method="post">
                <img src="{{ asset('images/logo_roatan.png') }}" alt="">
                @csrf
                <input type="email" name="email" class="icon_email" autofocus placeholder="Correo">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <button type="submit">Ingresar</button>
                <a href="{{route('forget-password')}}">¿Olvido su contraseña?</a>
            </form>
        </div>
    </div>
</body>
</html>