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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categoria','App\Http\Controllers\CategoriaController');
Route::apiResource('marca','App\Http\Controllers\MarcaController');
Route::apiResource('cliente','App\Http\Controllers\ClienteController');
Route::apiResource('tipo','App\Http\Controllers\TipoController');
Route::apiResource('produto','App\Http\Controllers\ProdutoController');
Route::apiResource('compra','App\Http\Controllers\CompraController');

