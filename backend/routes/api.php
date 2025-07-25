<?php

use Illuminate\Support\Facades\Route;
// routes/api.php
use App\Http\Controllers\DesaController;

Route::get('/desa', [DesaController::class, 'index']);
Route::post('/desa', [DesaController::class, 'store']);
Route::get('/desa/{id}', [DesaController::class, 'show']);
Route::put('/desa/{id}', [DesaController::class, 'update']);
Route::delete('/desa/{id}', [DesaController::class, 'destroy']);
