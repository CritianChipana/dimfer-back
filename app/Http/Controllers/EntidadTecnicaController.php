<?php

namespace App\Http\Controllers;

use App\Models\EntidadTecnica;
use Illuminate\Http\Request;

class EntidadTecnicaController extends Controller
{

    public function entidadesTecnicas (Request $request) {
        try {
            $entidadesTecnicas = EntidadTecnica::get();

            return response()->json([
                'success' => true,
                'data' => $entidadesTecnicas
            ], 200);

        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar la entidad técnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }

    }
    public function createdEntidadTecnica (Request $request) {
        try {

            $data = $request->all();
            $entidadTecnica = EntidadTecnica::create($data);

            return response()->json([
                'success' => true,
                'data' => $entidadTecnica
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear la entidad técnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedEntidadTecnica (Request $request, $id) {
        
        try {
            $entidadTecnica = EntidadTecnica::find($id);

            if ($entidadTecnica) {
                $data = $request->all();
                $entidadTecnica->update($data);

                return response()->json([
                    'success' => true,
                    'data' => $entidadTecnica
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró la entidad técnica',
                    'msg' => 'Error al actualizar la entidad técnica'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al modificar la entidad técnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteEntidadTecnica (Request $request, $id) {
        
        try {
            $entidadTecnica = EntidadTecnica::find($id);

            if ($entidadTecnica) {
                $entidadTecnica->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Entidad técnica eliminada correctamente'
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró la entidad técnica',
                    'msg' => 'Error al eliminar la entidad técnica'
                ];
                return response()->json($payload, 400);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar la entidad técnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
