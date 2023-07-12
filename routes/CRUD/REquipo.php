<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;

Route::middleware(['auth:sanctum'])
    ->prefix('equipo')
    ->group(function () {

        Route::get('/check', function() { return 'ok'; });

        Route::get('', [EquipoController::class, 'index'])
            ->name('index');

        Route::post('', [EquipoController::class, 'store'])
            ->name('store')->where('equipo', '[0-9]+');

        Route::put('/{equipoID}', [EquipoController::class, 'update'])
            ->name('update')
            ->whereNumber('equipo')
            ->where('equipo', '[0-9]+');

        Route::delete('/{equipoID}', [EquipoController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('equipo')
            ->where('equipo', '[0-9]+');
    });