<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;

Route::middleware(['auth:sanctum'])
    ->prefix('division')
    ->group(function () {

        Route::get('/check', function() { return 'ok'; });

        Route::get('', [DivisionController::class, 'index'])
            ->name('index');

        Route::post('', [DivisionController::class, 'store'])
            ->name('store')->where('division', '[0-9]+');

        Route::put('/{divisionID}', [DivisionController::class, 'update'])
            ->name('update')
            ->whereNumber('division')
            ->where('division', '[0-9]+');

        Route::delete('/{divisionID}', [DivisionController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('division')
            ->where('division', '[0-9]+');
    });

    /*Route::get('/check', function() { return 'ok'; });

    Route::get('', [DivisionController::class, 'index'])
        ->name('index');

    Route::post('', [DivisionController::class, 'store'])
        ->name('store')->where('division', '[0-9]+');

    Route::put('/{divisionID}', [DivisionController::class, 'update'])
        ->name('update')
        ->whereNumber('division')
        ->where('division', '[0-9]+');

    Route::delete('/{divisionID}', [DivisionController::class, 'destroy'])
        ->name('destroy')
        ->whereNumber('division')
        ->where('division', '[0-9]+');*/
