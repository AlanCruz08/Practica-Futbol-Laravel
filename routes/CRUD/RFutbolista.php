<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FutbolistaController;


Route::middleware(['auth:sanctum'])
    ->prefix('futbolista')
    ->group(function () {

        Route::get('/check', function() { return 'ok'; });

        Route::get('', [FutbolistaController::class, 'index'])
            ->name('index');

        Route::post('', [FutbolistaController::class, 'store'])
            ->name('store')->where('futbolista', '[0-9]+');

        Route::put('/{futbolistaID}', [FutbolistaController::class, 'update'])
            ->name('update')
            ->whereNumber('futbolista')
            ->where('futbolista', '[0-9]+');

        Route::delete('/{futbolistaID}', [FutbolistaController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('futbolista')
            ->where('futbolista', '[0-9]+');
    });
  /*  Route::get('/check', function() { return 'ok'; });

    Route::get('/', [FutbolistaController::class, 'index'])
        ->name('index');

    Route::post('/', [FutbolistaController::class, 'store'])
        ->name('store')->where('futbolista', '[0-9]+');

    Route::put('/{futbolistaID}', [FutbolistaController::class, 'update'])
        ->name('update')
        ->whereNumber('futbolista')
        ->where('futbolista', '[0-9]+');

    Route::delete('/{futbolistaID}', [FutbolistaController::class, 'destroy'])
        ->name('destroy')
        ->whereNumber('futbolista')
        ->where('futbolista', '[0-9]+');*/