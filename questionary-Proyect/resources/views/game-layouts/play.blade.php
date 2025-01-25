@extends('questionary.game-index')

@section('title', 'Play')

@section('content')
<div class="container style-container-play" id="question-container">
    <form id="answerForm" action="{{ route('submit.answers') }}" method="POST">
        @csrf

        <!-- Pregunta -->
        <div class="question text-center mb-4">
        <img src="{{asset($question->image)}}" class="img-question-play" alt="">
            <h2>{{ $question->question }}</h2>
        </div>

        <!-- Respuestas -->
        <div class="answers">
            @foreach ($respuestas as $respuesta)
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="respuesta"
                    id="respuesta{{ $respuesta->id }}"
                    value="{{ $respuesta->id }}"
                    required
                    style="display: none;">
                <label
                    class="form-check-label answer-option"
                    for="respuesta{{ $respuesta->id }}"
                    data-id="{{ $respuesta->id }}"
                    data-correct="{{ $respuesta->is_correct ? '1' : '0' }}">
                    {{ $respuesta->response }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-4" id="submitAnswerBtn" style="display: none;">Enviar respuesta</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="resultModalLabel">Resultado del Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="modal-results">
                <!-- Los resultados se insertarán aquí -->
                <p class="fs-4">¡Excelente trabajo!</p>
                <p class="fs-5 respuesta">Respuestas correctas: <span id="correctas-count">0</span></p>
                <p class="fs-5" style="margin-top: 10px;">Respuestas incorrectas: <span id="incorrectas-count">0</span></p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-success" id="restartGameBtn replayBtn">Volver a jugar</button>
                <button type="button" class="btn btn-info" id="rankingBtn">Ir al Ranking</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de fin de vidas -->
<div class="modal fade" id="noLivesModal" tabindex="-1" aria-labelledby="noLivesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noLivesModalLabel">¡Fin de las vidas!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>No tienes más vidas. ¡Has terminado el juego!</p>
      </div>
      <div class="modal-footer">
        <div class="botones-modal-vida">
            <div class="boton-cerar">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            <div class="boton-ranking">
            <a href="/ranking" class="btn btn-primary">Ir al Ranking</a>
            </div>
            <div class="boton-ranking">
            <a href="/ranking" class="btn btn-primary">Comprar Vidas</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
    p{
        margin-left: 10px;
    }
</style>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    let answerLabels = document.querySelectorAll('.answer-option');
    let respuestas = [];
    let respuestaCount = 0;
    let vidas = {{ $vidas->vidas }}; 


    function disableAnswers() {
        answerLabels.forEach(label => {
            label.style.pointerEvents = 'none';  
            label.style.backgroundColor = 'gray'; 
        });

        const inputs = document.querySelectorAll('.form-check-input');
        inputs.forEach(input => {
            input.disabled = true; // Deshabilitar inputs
        });
    }

    function resetQuestionState() {
        answerLabels.forEach(label => {
            label.style.backgroundColor = '';
            label.style.color = '';
            label.style.pointerEvents = 'auto';
        });

        const inputs = document.querySelectorAll('.form-check-input');
        inputs.forEach(input => {
            input.disabled = false;
        });
    }

    function assignAnswerEvents() {
        answerLabels.forEach(label => {
            label.addEventListener('click', function() {
                if (vidas <= 0) return;

                const selectedAnswerId = label.getAttribute('data-id');
                const isCorrect = label.getAttribute('data-correct') === '1';

                answerLabels.forEach(l => {
                    l.style.backgroundColor = '';
                    l.style.color = '';
                });

                if (!isCorrect) {
                    label.style.backgroundColor = 'red';
                    label.style.color = 'white';
                } else {
                    label.style.backgroundColor = 'green';
                    label.style.color = 'white';
                }


                if (!isCorrect) {
                    answerLabels.forEach(l => {
                        if (l.getAttribute('data-correct') === '1') {
                            l.style.backgroundColor = 'green';
                            l.style.color = 'white';
                        }
                    });
                }

                answerLabels.forEach(l => {
                    l.style.pointerEvents = 'none';
                });

                const inputs = document.querySelectorAll('.form-check-input');
                inputs.forEach(input => {
                    input.disabled = true;
                });


                respuestas.push({
                    id: selectedAnswerId,
                    isCorrect: isCorrect
                });
                respuestaCount++;
                if (respuestaCount >= 5) {
                    console.log("Enviando respuestas...", respuestas);
                    sendAllAnswers(respuestas);
                } else {
                    console.log("Respuestas pendientes:", respuestaCount);
                    setTimeout(() => {
                        fetchNewQuestion();
                    }, 1000);
                }
                if (vidas <= 0 && respuestaCount==5) {
                    showNoLivesModal();
                }
            });
        });
    }

    function showNoLivesModal() {
        const noLivesModal = new bootstrap.Modal(document.getElementById('noLivesModal'), {
            keyboard: false 
        });
        noLivesModal.show();
    }

    function sendAllAnswers(respuestas) {
        fetch("{{ route('submit.answers') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    respuestas: respuestas
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Respuestas del servidor:', data);

               
                if (data.correctas !== undefined && data.incorrectas !== undefined) {
                    // Actualizar el contenido del modal
                    document.getElementById('modal-results').innerHTML = `
                    <p>Respuestas correctas: ${data.correctas}</p>
                    <p>Respuestas incorrectas: ${data.incorrectas}</p>
                `;
                    // Inicializar el modal y mostrarlo
                    const myModal = new bootstrap.Modal(document.getElementById('resultModal'), {
                        keyboard: false 
                    });
                    myModal.show();
                }
            })
            .catch(error => {
                console.error('Error al enviar las respuestas:', error);
                alert('Hubo un problema al procesar tus respuestas.');
            });
    }


    function fetchNewQuestion() {
        fetch("{{ route('getQuestion') }}", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                // Actualizar la pregunta y respuestas en el frontend
                const questionContainer = document.getElementById('question-container');
                const questionElement = questionContainer.querySelector('.question h2');
                const answersContainer = questionContainer.querySelector('.answers');
                answersContainer.innerHTML = '';

                // Actualizar la pregunta
                questionElement.textContent = data.question;

                // Agregar nuevas respuestas
                data.respuestas.forEach(respuesta => {
                    const answerLabel = document.createElement('label');
                    answerLabel.classList.add('form-check-label', 'answer-option');
                    answerLabel.setAttribute('data-id', respuesta.id);
                    answerLabel.setAttribute('data-correct', respuesta.is_correct ? '1' : '0');
                    answerLabel.textContent = respuesta.response;
                    answersContainer.appendChild(answerLabel);
                });

                // Restablecer estado y habilitar la selección
                resetQuestionState();

                // Reasignar los eventos de selección para las nuevas respuestas
                answerLabels = document.querySelectorAll('.answer-option');
                assignAnswerEvents();
            })
            .catch(error => {
                console.error('Error al obtener la nueva pregunta:', error);
            });
    }

    // Si no hay vidas, deshabilitar respuestas al cargar la página
    if (vidas <= 0) {
        disableAnswers();
        showNoLivesModal();
    }

    // Llamar a la función para cargar la primera pregunta
    fetchNewQuestion();

    // Manejar el botón "Ir al Ranking"
    document.getElementById('rankingBtn').addEventListener('click', function() {
        window.location.href = '/ranking';
    });
    document.getElementById('restartGameBtn').addEventListener('click', function () {
        // Realizar solicitud AJAX para reiniciar el juego
        fetch("{{ route('restart.game') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Restablecer las vidas
                vidas = data.vidas;

                // Actualizar la interfaz
                const questionContainer = document.getElementById('question-container');
                const questionElement = questionContainer.querySelector('.question h2');
                const answersContainer = questionContainer.querySelector('.answers');
                answersContainer.innerHTML = '';

                // Agregar la nueva pregunta y respuestas
                questionElement.textContent = data.question;
                data.respuestas.forEach(respuesta => {
                    const answerLabel = document.createElement('label');
                    answerLabel.classList.add('form-check-label', 'answer-option');
                    answerLabel.setAttribute('data-id', respuesta.id);
                    answerLabel.setAttribute('data-correct', respuesta.is_correct ? '1' : '0');
                    answerLabel.textContent = respuesta.response;
                    answersContainer.appendChild(answerLabel);
                });

                // Reasignar eventos
                answerLabels = document.querySelectorAll('.answer-option');
                assignAnswerEvents();

                // Ocultar el modal
                const noLivesModal = bootstrap.Modal.getInstance(document.getElementById('noLivesModal'));
                noLivesModal.hide();
            } else {
                alert('No se pudo reiniciar el juego. Intenta nuevamente.');
            }
        })
        .catch(error => {
            console.error('Error al reiniciar el juego:', error);
        });
    });
});


</script>

@push('scripts')
@endpush