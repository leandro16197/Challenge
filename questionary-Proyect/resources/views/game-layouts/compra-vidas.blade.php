@extends('questionary.game-index')

@section('title', 'Market')


@section('content')

<div class="container style-container-market text-center p-4" id="question-container">
    <div class="alert alert-info text-center mb-4" role="alert">
        ¡Compra más vidas para seguir jugando y convertirte en el número 1 del ranking!
    </div>
    <div class="card mx-auto" style="max-width: 500px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h5 class="card-title mb-4">Selecciona tu paquete de vidas</h5>
            @foreach ($data as $vida)
            <div class="form-check mb-3">
                <input
                    class="form-check-input vida-radio"
                    type="radio"
                    name="vida"
                    id="vida-{{ $vida['id'] }}"
                    value="{{ $vida['id'] }}"
                    data-quantity="{{ $vida['lives_quantity'] }}"
                    data-price="{{ $vida['price'] }}">
                <label class="form-check-label" for="vida-{{ $vida['id'] }}">
                    <strong>Cantidad:</strong> {{ $vida['lives_quantity'] }} vida,
                    <strong>Precio:</strong> ${{ number_format($vida['price'], 2) }}
                </label>
            </div>
            @endforeach
            <div id="confirmButtonContainer" class="mt-3" style="display: none;">
                <button type="button" id="confirmButton" class="btn btn-confirmar-compra w-100">Confirmar</button>
            </div>
            <div id="wallet_container"></div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    const MERCADO_PAGO_PUBLIC_KEY = "{{ env('MERCADO_PAGO_PUBLIC_KEY') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('js/MercadoPago.js') }}"></script>
@endpush