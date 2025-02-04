<!DOCTYPE html>
<html>
<head>
    <title>Reserva Cancelada</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #d9534f;">Reserva Cancelada</h2>
        <p>Hola {{ $reserva->user->name }},</p>
        <p>Te informamos que tu reserva para el evento <strong>{{ $reserva->evento->nombre }}</strong> ha sido cancelada.</p>
        <p><strong>🔢 Cantidad de reservas:</strong> {{ $reserva->cantidad }}</p>
        <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($reserva->evento->fecha_evento)->format('d/m/Y H:i') }}</p>
        <p><strong>📍 Ubicación:</strong> {{ $reserva->evento->direccion }}</p>
        <p>Si tienes dudas, contáctanos. 📧</p>
        <p>Saludos,</p>
        <p><strong>{{ config('app.name') }}</strong></p>
    </div>
</body>
</html>
