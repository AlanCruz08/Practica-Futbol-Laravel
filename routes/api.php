<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



include_once __DIR__ . '/CRUD/RLogin.php';
include_once __DIR__ . '/CRUD/REstadio.php';
include_once __DIR__ . '/CRUD/RFutbolista.php';
include_once __DIR__ . '/CRUD/REquipo.php';
//include_once __DIR__ . '/CRUD/RDivision.php';