<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de correo</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 20px;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .email-header {
            background-color: #007bff;
            padding: 20px;
            text-align: center;
        }
        .email-header img {
            max-height: 50px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body h1 {
            color: #333333;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin: 30px 0;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #6b6e76;
            padding: 20px;
        }
        .subcopy {
            margin-top: 30px;
            font-size: 14px;
            color: #6b6e76;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-content">
        {{-- Header con logo --}}
        <div class="email-header">
            <h1 style="color: whitesmoke">Bienvenid@ a {{ config('app.name') }}</h1>
        </div>

        {{-- Cuerpo del mensaje --}}
        <div class="email-body">
            <h1>Hola {{ $user->name }},</h1>
            <p>Gracias por registrarte en <strong>{{ config('app.name') }}</strong>. Para completar tu registro, por favor verifica tu dirección de correo electrónico haciendo clic en el siguiente botón:</p>

            <p style="text-align: center;">
                <a href="{{ $url }}" class="button">Verificar mi correo</a>
            </p>

            <p>Si no creaste una cuenta, puedes ignorar este mensaje.</p>

            <div class="subcopy">
                Si el botón no funciona, copia y pega el siguiente enlace en tu navegador:<br>
                <a href="{{ $url }}">{{ $url }}</a>
            </div>
        </div>

        {{-- Footer --}}
        <div class="email-footer">
            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </div>
    </div>
</div>
</body>
</html>
