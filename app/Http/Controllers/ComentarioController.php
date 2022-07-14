<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    
    public function comentarios (Request $request) {
        try {
            $comentarios = Comentario::get();

            return response()->json([
                'success' => true,
                'data' => $comentarios
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar los comentarios, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function createdComentario (Request $request) {
        try {

            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->convocatoria = $request->convocatoria;
            

            return response()->json([
                'success' => true,
                'data' => $comentario
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear el comentario, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function updatedComentario () {

    }
    public function deleteComentario () {

    }


}
