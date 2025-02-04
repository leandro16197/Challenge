<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento Cancelado</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #d9534f;">Evento Cancelado</h2>
        <p>Estimado usuario,</p>
        <p>Lamentamos informarte que el evento <strong>{{ $evento->nombre }}</strong> ha sido cancelado.</p>
        <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y H:i') }}</p>
        <p><strong>📍 Ubicación:</strong> {{ $evento->direccion }}, {{ $evento->localidad }}</p>
        <p>Gracias por tu comprensión. 🙏</p>
    </div>
</body>
</html>
