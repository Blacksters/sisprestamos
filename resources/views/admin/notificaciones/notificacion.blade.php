<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Notificacion de pago</h1>
<hr>
<p>
    <h1>Notificacion de pago</h1>
    <hr>
</p>
<p>Usted tiene un pago atrasado, le pedimos que realice el pago lo antes posible.</p>
<hr>
<p>
    <b>Detalle del pago:</b> <br><br>
    <b>Monto: </b>{{$pago->monto_pagado}}<br>
    <b>Fecha de pago: </b>{{$pago->fecha_pago}}<br>
    <b>Referencia pago: </b>{{$pago->referencia_pago}}<br>
    <b>Estado: </b>{{$pago->estado}}<br>
</p>

<small>Gracias por su atencion.</small>
</body>
</html>