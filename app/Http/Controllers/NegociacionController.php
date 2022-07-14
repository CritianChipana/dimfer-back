<?php

namespace App\Http\Controllers;

use App\Models\Negociacion;
use Illuminate\Http\Request;

class NegociacionController extends Controller
{
    public function negociacione (Request $request) {
        try {
            
            $data = $request->all();
            $entidadTecnica = Negociacion::where('entidad_tecnica', $data['entidad_tecnica'])->where('convocatoria', $data['convocatoria'])->first();
            if ($entidadTecnica) {
                return response()->json([
                    'success' => true,
                    'data' => $entidadTecnica 
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró negociación'
                ], 404);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar la negociacion, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function createdNegociacion (Request $request) {
        try {

            $data = $request->all();
            $entidadTecnica = Negociacion::create($data);

            return response()->json([
                'success' => true,
                'data' => $entidadTecnica
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear la negociacion, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedNegociacion (Request $request, $id) {
        try {

            $data = $request->all();
            $entidadTecnica = Negociacion::find($id);
            if ($entidadTecnica) {
                $entidadTecnica->update($data);
                return response()->json([
                    'success' => true,
                    'data' => $entidadTecnica
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró la negociacion',
                    'msg' => 'Error al actualizar la negociacion'
                ];
                return response()->json($payload, 400);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al actualizar la negociacion, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteNegociacion (Request $request) {

    }
}
