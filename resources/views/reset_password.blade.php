<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Technology</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="right-content">
            <form action="{{ route('reset-password-post') }}" method="POST">
                <img src="{{ asset('images/logo_roatan.png') }}" alt="">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <input type="text" id="email_address" name="email" required autofocus placeholder="Correo Electrónico">
                @if ($errors->has('email'))
                <div class="" style="background-color: red; font-size: 12px; color: #fff; padding: 1rem; border-radius: 8px; text-align: center; width: 100%;">
                    <p style="">{{ $errors->first('email') }}</p>
                </div>
                @endif

                <input type="password" id="password" name="password" required autofocus placeholder="Nueva Contraseña">
                @if ($errors->has('password'))
                <div class="" style="background-color: red; font-size: 12px; color: #fff; padding: 1rem; border-radius: 8px; text-align: center; width: 100%;">
                    <p>{{ $errors->first('password') }}</p>
                </div>
                @endif

                <input type="password" id="password-confirm" name="password_confirmation" required
                    autofocus placeholder="Confirme contraseña">
                @if ($errors->has('password_confirmation'))
                <div class="" style="background-color: red; font-size: 12px; color: #fff; padding: 1rem; border-radius: 8px; text-align: center; width: 100%;">
                    <p>{{ $errors->first('password_confirmation') }}</p>
                </div>
                @endif

                <button type="submit">Cambiar contraseña</button>
                <a href="{{route('login')}}">Ir a inicio de sesión</a>
            </form>
        </div>
    </div>
</body>

</html>
