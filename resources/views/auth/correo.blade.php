<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Creacion de usuario</title>
</head>
<body>
<p>
    Se le informa que se a registrado una nueva cuenta de usuario, la cual esta enlazada a este correo electronico
    para poder acceder a ella, puede utilizar la contraseña que se le proporciona a continuacion.
</p>

<h4><Strong>Nombre: </Strong>{{ $distressCall ['nombres']}}</h4>
<h4><Strong>Correo electronico: </Strong>{{ $distressCall ['email']}}</h4>
<h4><Strong>Telefono: </Strong>{{ $distressCall ['telefono'] }}</h4>
<h4><Strong>Identidad: </Strong>{{ $distressCall ['identidad'] }}</h4>
<h4><Strong>Contraseña: </Strong>{{ $distressCall ['contraseña'] }}</h4>

<p>Si uno de estos datos es incorrecto, por favor contactarse con la empresa</p>

</body>
</html>