<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Http\Request;

class ConvocatoriaController extends Controller
{
    public function convocatorias (Request $request) {
        try {

            $convocatoria = Convocatoria::get();

            return response()->json([
                'success' => true,
                'data' => $convocatoria
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function entidadesDeConvocatorias (Request $request, $id_convocatoria) {
        try {

            $convocatoria = Convocatoria::find($id_convocatoria);

            if( !$convocatoria ) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            $entidades = $convocatoria->entidadesTecnicas;

            return response()->json([
                'success' => true,
                'data' => $entidades
            ], 200);

        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar entidades de convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function createdConvocatoria (Request $request) {
        try {

            $data = $request->all();
            $convocatoria = Convocatoria::create($data);

            return response()->json([
                'success' => true,
                'data' => $convocatoria
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedConvocatoria (Request $request, $id) {
        try {

            $data = $request->all();
            $convocatoria = Convocatoria::find($id);
            if ($convocatoria) {
                $convocatoria->update($data);
                return response()->json([
                    'success' => true,
                    'data' => $convocatoria
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro la convocatoria',
                    'msg' => 'Error al actualizar convocatoria'
                ];
                return response()->json($payload, 400);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al actualizar convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteConvocatoria (Request $request, $id) {
        try {

            $convocatoria = Convocatoria::find($id);
            if ($convocatoria) {
                $convocatoria->delete();
                return response()->json([
                    'success' => true,
                    'data' => $convocatoria
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro la convocatoria',
                    'msg' => 'Error al eliminar convocatoria'
                ];
                return response()->json($payload, 400);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
