<div id="weather">
    <p id="temperature"></p>
    <p id="description"></p>
</div>
<style>
#weather {
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    max-width: 300px;
    margin: 5px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}
#temperature {
    font-size: 1.3rem;
    font-weight: bold;
}

#description {
    font-size: 1.2rem;
    font-style: italic;
}
</style>
<script>
    const localidadUsuario = "{{ Auth::user()->localidad }}";
    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${localidadUsuario}&appid=04cf48bd230b9dcea58e16835f6f9b6e&units=metric&lang=es`)
      .then(response => response.json())
      .then(data => {
        document.getElementById('temperature').textContent = `Temperatura: ${data.main.temp}°C`;
        document.getElementById('description').textContent = `Descripción: ${data.weather[0].description}`;
      })
      .catch(error => console.log(error));
    </script>
    
  