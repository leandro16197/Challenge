$(document).ready(function () {
    const radios = document.querySelectorAll('.vida-radio');
    const confirmButtonContainer = document.getElementById('confirmButtonContainer');
    const confirmButton = document.getElementById('confirmButton');
    const walletContainer = $('#wallet_container');
    const mp = new MercadoPago(MERCADO_PAGO_PUBLIC_KEY);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            confirmButtonContainer.style.display = 'block';
            
            // Eliminar la clase 'selected' de todos los radios
            radios.forEach(r => r.parentElement.classList.remove('selected'));
            
            // Agregar la clase 'selected' al contenedor del radio seleccionado
            radio.parentElement.classList.add('selected');
        });
    });

    // Al hacer clic en el botón "Confirmar"
    confirmButton.addEventListener('click', function () {
        let selectedRadio = document.querySelector('input[name="vida"]:checked');
        if (selectedRadio) {
            let id = parseInt(selectedRadio.value); 
            let cantidad = parseInt(selectedRadio.getAttribute('data-quantity'));
            let precio = parseFloat(selectedRadio.getAttribute('data-price'));
            console.log('ID:', id);
            walletContainer.show();

            fetch('http://localhost:8000/create-preference', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    vidaId: id,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.preferenceId) {
                    mp.bricks().create("wallet", "wallet_container", {
                        initialization: {
                            preferenceId: data.preferenceId,
                            redirectMode: 'self'
                        },
                        customization: {
                            texts: {
                                action: "Pagar ahora",
                                valueProp: "Paga de forma rápida y segura",
                            }
                        }
                    });
                } else {
                    console.error("No se pudo obtener el preferenceId");
                }
            })
            .catch(error => {
                console.error("Error al obtener el preferenceId:", error);
            });
        } else {
            console.error("No hay un paquete seleccionado.");
        }
    });
});
