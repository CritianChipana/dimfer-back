<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntidadTecnicaController;
use App\Http\Controllers\ComentarioController;

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

//ENTIDADES TECNICAS
Route::get('/entidad', [EntidadTecnicaController::class, 'entidadesTecnicas']);
Route::post('/entidad', [EntidadTecnicaController::class, 'createdEntidadTecnica']);
Route::put('/entidad/{id}', [EntidadTecnicaController::class, 'updatedEntidadTecnica']);
Route::delete('/entidad/{id}', [EntidadTecnicaController::class, 'deleteEntidadTecnica']);

// COMENTARIOS
Route::get('/comentario', [ComentarioController::class, 'comentarios']);
Route::post('/comentario', [ComentarioController::class, 'createdComentario']);
Route::put('/comentario/{id}', [ComentarioController::class, 'updatedComentario']);
Route::delete('/comentario/{id}', [ComentarioController::class, 'deleteComentario']);