<?php

use App\Http\Controllers\Api\ColegiadoController;
use Illuminate\Support\Facades\Route;

Route::post('/colegiados', [ColegiadoController::class, 'store'])
    ->middleware('n8n.token');
