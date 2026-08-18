<?php

use App\Http\Controllers\LegajoDocumentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('descargas')->name('descargas.')->group(function () {
    Route::get('/matriculas/{matricula}', [LegajoDocumentoController::class, 'matricula'])->name('matriculas');
    Route::get('/sss/{sss}', [LegajoDocumentoController::class, 'sss'])->name('sss');
    Route::get('/habilitaciones/{habilitacionLaboratorio}', [LegajoDocumentoController::class, 'habilitacion'])->name('habilitaciones');
});
