<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('encuestas', \App\Http\Livewire\Encuestas\EncuestaIndex::class)->name('encuestas.index')->middleware('auth')->can('encuestas.index');
Route::get('encuesta/{encuesta}', \App\Http\Livewire\Encuestas\EncuestaShow::class)->name('encuestas.show')->middleware('auth')->can('encuestas.show');
Route::get('participantes', \App\Http\Livewire\Participantes\ParticipanteIndex::class)->name('participantes.index')->middleware('auth')->can('participantes.index');
Route::get('resultados', \App\Http\Livewire\Resultados\ResultadoIndex::class)->name('resultados.index')->middleware('auth')->can('resultados.index');
Route::get('resultados/{participante}', \App\Http\Livewire\Resultados\ResultadoShow::class)->name('resultados.show')->middleware('auth')->can('resultados.show');
Route::get('votos', \App\Http\Livewire\Votos\VotoEncuesta::class)->name('votos.encuesta')->middleware('auth')->can('votos.encuesta');
Route::get('votos/{encuesta}', \App\Http\Livewire\Votos\VotoParticipante::class)->name('votos.participante')->middleware('auth')->can('votos.participante');
Route::get('votos/participante/{participante}', \App\Http\Livewire\Votos\VotoPreguntas::class)->name('votos.preguntas')->middleware('auth')->can('votos.preguntas');
Route::get('descargar_gandores', [\App\Http\Controllers\PrinterController::class, 'ganadores'])->name('ganadores')->middleware('auth');
Route::get('descargar_resultados', [\App\Http\Controllers\PrinterController::class, 'resultados'])->name('resultados')->middleware('auth');
