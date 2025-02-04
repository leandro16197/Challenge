function obtenerCoordenadas(localidad, direccion) {
    const query = `${direccion}, ${localidad}, Argentina`;
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const lat = data[0].lat;
                const lon = data[0].lon;
                mostrarMapa(lat, lon);
            } else {
                alert("No se encontraron coordenadas para la dirección ingresada.");
            }
        })
        .catch(error => console.error("Error obteniendo coordenadas:", error));
}