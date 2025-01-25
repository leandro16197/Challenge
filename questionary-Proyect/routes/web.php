<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\generosController;
use App\Http\Controllers\QuestionaryController;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::check() && Auth::user()->rol == 1) {
            return $next($request);
        }
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
    }], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/questionary', [QuestionaryController::class, 'store'])->name('questionary.store');
        Route::get('/addQuestion', [generosController::class, 'getGeneros'])->name('addQuestion');
        Route::get('/questions/data', [QuestionaryController::class, 'getQuestionsData'])->name('questions.data');
        Route::get('/dato/{id}', [QuestionaryController::class, 'datoById']);
        Route::get('/listQuestions', [QuestionaryController::class, 'index'])->name('listQuestions');
        Route::post('/modificar', [QuestionaryController::class, 'update']);
        Route::delete('/eliminar-questionary/{id}', [QuestionaryController::class, 'destroy'])->name('questionary.destroy');
    });


    Route::get('/home', [GameController::class, 'index']);
    Route::get('/play', [GameController::class, 'play'])->name('play');
    Route::post('/submit-answer', [GameController::class, 'submitAnswer'])->name('submit.answers');
    Route::get('/ranking', [GameController::class, 'ranking']);
    Route::get('/ranking/datos', [GameController::class, 'rankingDatos']);
    Route::get('/profile/jugador', [ProfileController::class, 'edit_jugador'])->name('profile.edit');
    Route::patch('/profile/jugador', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/jugador', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/restart-game', [GameController::class, 'restartGame'])->name('restart.game');
    Route::post('/create-preference', [MercadoPagoController::class, 'createPreference']);
    Route::get('/success', [PagoController::class, 'success'])->name('success');
    Route::get('/failure', [PagoController::class, 'failure'])->name('failure');
    Route::get('/pending', [PagoController::class, 'pending'])->name('pending');
    Route::post('/mercadopago/webhook', [MercadoPagoController::class, 'webhook']);
    Route::get('/market',[LifeController::class,'getLife'])->name('vidas.get');
    Route::get('/users',[UsuariosController::class,'index'])->name('usuarios.get');
    Route::get('/users-list',[UsuariosController::class,'list'])->name('usuarios.list');
    Route::delete('/delete-user/{id}',[UsuariosController::class,'delete_User']);
    Route::put('/modificar-user/{id}',[UsuariosController::class,'update_rol']);
});

require __DIR__ . '/auth.php';
