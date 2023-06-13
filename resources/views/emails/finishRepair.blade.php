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
            <img style="width:50%; margin-left: 25%;" src="https://i.ibb.co/S3gj2nm/logo-roatan.png" alt="logo-roatan">
        </div>
        <div class="mail-container">
            <div class="mail-header">
                <h1>¡Reparación completada!</h1>
                <br>
                <div class="header-message">
                    <p>Saludos estimado {{$_client}}.</p>
                    <p>Le informamos por este medio que el mantenimiento/reparación del dispositivo {{$_device}} fue completado.</p>
                    <p>Le pedimos que pase por el taller para finalizar el proceso de pago del servicio.</p>
                    <br>
                    <hr>
                    <br>
                    <h4>Información de reparación:</h4>
                    <p>- <b>Codigo:</b> {{$_code}}</p>
                    <p>- <b>Cliente:</b> {{$_client}}</p>
                    <p>- <b>Dispositivo:</b> {{$_device}}</p>
                    <p>- <b>Tecnico asignado:</b> {{$_technical}}</p>
                    <p>- <b>Servicio requerido:</b> {{$_service}}</p>
                    <p>- <b>Fecha y hora de solicitud:</b> {{$_time}}</p>
                    <hr>
                    <h4>Descripción de total:</h4>
                    <table style="width:100%;">
                        <thead style="padding: .5rem 1rem; background-color:rgb(38, 82, 227); color: #fff">
                            <tr>
                                <th>Cantidad</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($_list as $item)
                                <tr style="padding: .5rem 1rem; border-bottom:2px #6d6c6c solid;">
                                    <td  style="padding: .5rem 1rem;">{{$item->quantity}}</td>
                                    <td  style="padding: .5rem 1rem;">{{$item->name}}</td>
                                    <td  style="padding: .5rem 1rem;">{{$item->price}}</td>
                                    <td style="text-align: right; padding: .5rem 1rem;">{{$item->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <p>- <b>Subtotal:</b> {{$_subtotal}} Lps</p>
                    <p>- <b>ISV 15%:</b> {{$_isv}} Lps</p>
                    <p>- <b>Total a Pagar:</b> {{$_total}} Lps</p>
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