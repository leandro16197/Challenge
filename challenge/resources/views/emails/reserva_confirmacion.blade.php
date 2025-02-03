<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Reserva</title>
</head>
<body>
    <h1>¡Reserva confirmada!</h1>
    <p>Hola {{ $reserva->user->name }},</p>
    <p>Tu reserva para el evento <strong>{{ $reserva->evento->nombre }}</strong> ha sido confirmada.</p>
    <p><strong>Cantidad de participantes:</strong> {{ $reserva->cantidad }}</p>
    <p><strong>Evento:</strong> {{ $reserva->evento->nombre }}</p>
    <p><strong>Fecha:</strong> {{ $reserva->evento->fecha }}</p>
    <p><strong>Ubicación:</strong> {{ $reserva->evento->ubicacion }}</p>
    <p>Gracias por tu reserva.</p>
</body>
</html>
