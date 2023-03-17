
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cita</title>
</head>
<body>
<h2>Su cita ha sido registrada </h2>
<h2> Fecha y hora: {{$request->input('cita')}}</h2>
<h3> Tipo de cita: {{$request->input('tipo_cita')}} </h2>
</body>
</html>
