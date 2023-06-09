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
            @if (session('success'))
                <div class="success_alert">{{session('success')}}</div>
            @endif
            <form action="{{ route('forget-password-post') }}" method="post">
                <img src="{{ asset('images/logo_roatan.png') }}" alt="">
                @csrf
                <input type="email" name="email" class="icon_email" autofocus placeholder="Correo">
                @if ($errors->has('email'))
                <div class="" style="background-color: red; font-size: 12px; color: #fff; padding: 1rem; border-radius: 8px; text-align: center; width: 100%;">
                    <p style="">{{ $errors->first('email') }}</p>
                </div>
                @endif
                @if (session('fail'))
                <div class="" style="background-color: red; font-size: 12px; color: #fff; padding: 1rem; border-radius: 8px; text-align: center; width: 100%;">
                    <p style="">{{session('fail')}}</p>
                </div>
                @endif
                <button type="submit">Enviar Correo</button>
                <a href="{{route('login')}}">Ir a inicio de sesión</a>
            </form>
        </div>
    </div>
</body>
</html>