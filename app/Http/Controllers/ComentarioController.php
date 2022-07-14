<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function comentarios(Request $request, $id_entidad)
    {
        try {
            $comentarios = Comentario::where('entidad_tecnica_id', $id_entidad)->get();

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

    public function createdComentario(Request $request)
    {
        try {

            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->convocatoria = $request->convocatoria;
            $comentario->email_user = $request->email_user;
            $comentario->entidad_tecnica_id = $request->entidad_tecnica_id;
            $comentario->save();

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

    public function updatedComentario(Request $request, $id)
    {

        try {

            $comentario = Comentario::find($id);

            if ($comentario) {

                $comentario->comentario = $request->comentario;
                $comentario->convocatoria = $request->convocatoria;
                $comentario->email_user = $request->email_user;
                $comentario->save();

                return response()->json([
                    'success' => true,
                    'data' => $comentario
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro el comentario',
                    'msg' => 'Error al actualizar el comentario, hable con el administrador'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al actualizar el comentario, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteComentario(Request $request, $id)
    {
        try {
            $comentario = Comentario::find($id);

            if ($comentario) {
                $comentario->delete();

                return response()->json([
                    'success' => true,
                    'msg' => 'Se elimino comentario'
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro el comentario',
                    'msg' => 'Error al eliminar el comentario, hable con el administrador'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar el comentario, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
