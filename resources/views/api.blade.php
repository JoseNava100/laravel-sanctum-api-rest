<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name')}} </title>
</head>
<body>

    <div>
        <h1>Api Rest</h1>
        <p>Api Token Authentication</p>
    </div>

    <div>
        <div>
            <h3>Contraseña sin encriptar</h3>
            <p> {{ $password }}</p>
        </div>

        <div>
            <h3>Contraseña encriptada</h3>
            <p> {{ $encryptedPassword  }}</p>
        </div>
        
    </div>

    
</body>
</html>