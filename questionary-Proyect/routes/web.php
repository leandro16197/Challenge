<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\generosController;
use App\Http\Controllers\QuestionaryController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/questionary', [QuestionaryController::class, 'store'])->name('questionary.store');
    Route::get('/addQuestion', [GenerosController::class, 'getGeneros'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');    
    Route::get('/questions/data', [QuestionaryController::class, 'getQuestionsData'])->name('questions.data');
    Route::get('/dato/{id}',[QuestionaryController::class,'datoById']);
    Route::get('/listQuestions', [QuestionaryController::class, 'index']); 
    Route::post('/modificar', [QuestionaryController::class, 'update']);
    Route::delete('/eliminar-questionary/{id}', [QuestionaryController::class, 'destroy'])->name('questionary.destroy');





});

require __DIR__.'/auth.php';
