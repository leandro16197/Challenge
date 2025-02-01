<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AdminController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/',[EventoController::class,'index']);
    Route::post('/evento/{evento}/reservar', [EventoController::class, 'reservar'])->name('evento.reservar');
    Route::get('/MisEventos',[EventoController::class,'getEventoByUser'])->name('evento.myevents');
    Route::delete('/eliminar-reserva/{id}',[EventoController::class,'deleteReserva'])->name('reserva.eliminar');
    Route::get('/administracion',[AdminController::class,'index'])->name('admin.admin');
    Route::put('/evento/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/evento/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/administracion/addEvent',[AdminController::class,'addEvent'])->name('admin.addEvent');
    Route::post('/administracion/addEvent', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/administracion/config', [AdminController::class, 'config'])->name('admin.config');
    Route::post('/administracion/config', [AdminController::class, 'addImgBackground'])->name('admin.addimg');
});
require __DIR__.'/auth.php';
