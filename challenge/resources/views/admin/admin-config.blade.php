@extends('admin.admin-dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('admin.addimg') }}" method="POST" enctype="multipart/form-data" class="upload-form">
    @csrf
    <label for="backgroundImage" class="upload-label">
        <i class="fas fa-upload"></i> Selecciona una imagen de fondo
    </label>
    <input type="file" id="backgroundImage" name="backgroundImage" accept="image/*" class="upload-input">
    <button type="submit" class="upload-button">Cambiar fondo</button>
</form>

@endsection

<style>
    .upload-form {
        width: 100%;
        max-width: 400px;
        margin: 40px auto;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .upload-label {
        display: block;
        background: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    .upload-label:hover {
        background: #0056b3;
    }

    .upload-input {
        display: none;
    }

    .upload-button {
        margin-top: 15px;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background: #28a745;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-button:hover {
        background: #218838;
    }
</style>