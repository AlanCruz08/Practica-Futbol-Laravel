<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadioController;

Route::middleware(['auth:sanctum'])
    ->prefix('estadio')
    ->group(function () {

        Route::get('/check', function() { return 'ok'; });

        Route::get('', [EstadioController::class, 'index'])
            ->name('index');

        Route::post('', [EstadioController::class, 'store'])
            ->name('store')->where('estadio', '[0-9]+');

        Route::put('/{estadioID}', [EstadioController::class, 'update'])
            ->name('update')
            ->whereNumber('estadio')
            ->where('estadio', '[0-9]+');

        Route::delete('/{estadioID}', [EstadioController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('estadio')
            ->where('estadio', '[0-9]+');
    });