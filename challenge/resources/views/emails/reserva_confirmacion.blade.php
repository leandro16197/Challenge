<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Reserva</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="color: #007bff;">¡Reserva Confirmada! 🎉</h1>
        <p>Hola {{ $reserva->user->name }},</p>
        <p>Tu reserva para el evento <strong>{{ $reserva->evento->nombre }}</strong> ha sido confirmada.</p>
        <p><strong>🔢 Cantidad de reservas:</strong> {{ $reserva->cantidad }}</p>
        <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($reserva->evento->fecha_evento)->format('d/m/Y H:i') }}</p>
        <p><strong>📍 Ubicación:</strong> {{ $reserva->evento->direccion }}</p>
        <p>Gracias por tu reserva. Nos vemos pronto! 😊</p>
    </div>
</body>
</html>
