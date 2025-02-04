<!DOCTYPE html>
<html>
<head>
    <title>Evento Actualizado</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="color: #007bff;">{{ $evento->nombre }}</h1>
        <p>Hola,</p>
        <p>Queremos informarte que el evento "<strong>{{ $evento->nombre }}</strong>" ha sido actualizado.</p>
        <p><strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y H:i') }}</p>
        <p><strong>📍 Ubicación:</strong> {{ $evento->direccion }}, {{ $evento->localidad }}</p>
        <p><strong>📖 Descripción:</strong> {{ $evento->description }}</p>
        <p>¡Esperamos verte allí! 🎉</p>
    </div>
</body>
</html>
