<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntidadTecnicaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\NegociacionController;

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
Route::get('/entidad/user', [EntidadTecnicaController::class, 'entidadesTecnicasByUser']);
Route::post('/entidad', [EntidadTecnicaController::class, 'createdEntidadTecnica']);
Route::put('/entidad/{id}', [EntidadTecnicaController::class, 'updatedEntidadTecnica']);
Route::delete('/entidad/{id}', [EntidadTecnicaController::class, 'deleteEntidadTecnica']);

// COMENTARIOS
Route::get('/comentario/{id_entidad}', [ComentarioController::class, 'comentarios']);
Route::post('/comentario', [ComentarioController::class, 'createdComentario']);
Route::put('/comentario/{id}', [ComentarioController::class, 'updatedComentario']);
Route::delete('/comentario/{id}', [ComentarioController::class, 'deleteComentario']);

// CONTACTOS
Route::get('/contacto/{id_entidad}', [ContactoController::class, 'contactos']);
Route::post('/contacto', [ContactoController::class, 'createdContacto']);
Route::put('/contacto/{id}', [ContactoController::class, 'updatedContacto']);
Route::delete('/contacto/{id}', [ContactoController::class, 'deleteContacto']);

// NEGOCICION
Route::post('/negociacion/detalle', [NegociacionController::class, 'negociacione']);
Route::post('/negociacion', [NegociacionController::class, 'createdNegociacion']);
Route::put('/negociacion/{id}', [NegociacionController::class, 'updatedNegociacion']);
Route::delete('/negociacion/{id}', [NegociacionController::class, 'deleteNegociacion']);

//CONVOCATORIA
Route::get('/convocatoria', [ConvocatoriaController::class, 'convocatorias']);
Route::get('/convocatoria/{id_convocatoria}', [ConvocatoriaController::class, 'entidadesDeConvocatorias']);
Route::post('/convocatoria', [ConvocatoriaController::class, 'createdConvocatoria']);
Route::put('/convocatoria/{id}', [ConvocatoriaController::class, 'updatedConvocatoria']);
Route::delete('/convocatoria/{id}', [ConvocatoriaController::class, 'deleteConvocatoria']);

//negocicion
Route::post('/negociacion/{id_convocatoria}/{id_entidadTecnica}', [ConvocatoriaController::class, 'createNegociacion']);
Route::get('/negociacion/{id_convocatoria}/{id_entidadTecnica}', [ConvocatoriaController::class, 'getNegociacion']);

Route::post('/add/entidad', [ConvocatoriaController::class, 'addEntidadTecnica']);
Route::post('/get/entidad', [ConvocatoriaController::class, 'getEntidadTecnica']);
Route::get('/entidadSinNegociacion/{id_convocatoria}', [ConvocatoriaController::class, 'entidadSinNegociacion']);
Route::delete('/delete/entidad/{id_convocatoria}/{id_entidadTecnica}', [ConvocatoriaController::class, 'deleteEntidadTecnica']);

//CARGA DE EntidadTecnica por excel
Route::post('/entidad/excel', [EntidadTecnicaController::class, 'cargaEntidadTecnicaExcel']);
//Carga de Convocatoria por excel
Route::post('/convocatoria/excel', [ConvocatoriaController::class, 'cargaConvocatoriaExcel']);

//CARGA DE DATOS ENTIDAD TECNICA
Route::post('/entidad/carga', [EntidadTecnicaController::class, 'cargaEntidadTecnica']);