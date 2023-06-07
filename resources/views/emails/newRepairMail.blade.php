<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap');

        .email{
            width: 100%;
            height: auto;
            background-image: url('https://i.ibb.co/SRvgMKW/mail-back.jpg');
            font-family: 'Poppins', sans-serif, Arial, Helvetica;
        }

        .logo-container{
            width: 90%;
            margin-left: 5%;
            background-color: #f4f4f476;
        }

        .logo-container img{
            width: 30%;
            margin-left: 35%;
        }

        .mail-header h1{
            background-color: #20d738;
            padding: .5rem .3rem;
        }

        .mail-container{
            width: 90%;
            margin-left: 5%;
            background-color: #fff;
            height: max-content;
        }

        .header-message{
            line-height: 1.4rem;
            padding: 1rem;
        }

        .mail-footer{
            width: 90%;
            margin-left: 5%;
            padding: 1rem 0;
            background-color: #6d6c6c;
            color: #000;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email">
        <div class="logo-container">
            <img src="https://i.ibb.co/S3gj2nm/logo-roatan.png" alt="logo-roatan">
        </div>
        <div class="mail-container">
            <div class="mail-header">
                <h1>¡Reparación aceptada!</h1>
                <br>
                <div class="header-message">
                    <p>Saludos estimado {{$_client}}.</p>
                    <p>Le informamos por este medio que la solicitud de mantenimiento/reparacion del dispositivo: <b>{{$_device}}</b>, a sido registrada y aceptada, por lo que se procedera a realizar el servicio requerido <b>{{$_service}}</b>.</p>
                    <br>
                    <hr>
                    <br>
                    <h4>información de reparación:</h4>
                    <p>- <b>Codigo:</b> {{$_code}}</p>
                    <p>- <b>Cliente:</b> {{$_client}}</p>
                    <p>- <b>Dispositivo:</b> {{$_device}}</p>
                    <p>- <b>Tecnico asignado:</b> {{$_technical}}</p>
                    <p>- <b>Servicio requerido:</b> {{$_service}}</p>
                    <p>- <b>Fecha y hora de solicitud:</b> {{$_time}}</p>
                </div>
            </div>
            <hr>
        </div>
        <div class="mail-footer">
            <h5><b>Roatán Technology</b> <br> <u>technologyroatan@gmail.com</u> <br> Roatán, Islas de la Bahía</h5>
        </div>
    </div>
</body>
</html>