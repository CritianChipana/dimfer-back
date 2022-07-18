<?php

namespace App\Http\Controllers;

use App\Http\Imports\DataEntidadTecnicaImport;
use App\Http\Imports\EntidadTecnicaImport;
use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Facades\Excel;
// use Excel;

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
    public function entidadesTecnicasByUser (Request $request) {
        try {
            $email_user = $request->header('email_user');
            $entidadesTecnicas = EntidadTecnica::where('email_user', $email_user)->get();

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

            $existe_entidad_tecnica = EntidadTecnica::where('ruc', $request->ruc)->first();
            if ($existe_entidad_tecnica) {
                $payload = [
                    'success' => false,
                    'msg' => 'Ya existe una entidad técnica registrada con ese email'
                ];
                return response()->json($payload, 400);
            }
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
    public function cargaEntidadTecnicaExcel (Request $request) {
        try {

            if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                Excel::import(new EntidadTecnicaImport , $path);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró el archivo',
                    'msg' => 'Error al cargar el archivo'
                ];
                return response()->json($payload, 400);
            }

            return response()->json([
                'success' => true,
                'data' => 'Archivo cargado correctamente'
            ], 200);

        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear la entidad técnica por excel, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function cargaEntidadTecnica (Request $request) {
        try {

            if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                Excel::import(new DataEntidadTecnicaImport , $path);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró el archivo',
                    'msg' => 'Error al cargar el archivo'
                ];
                return response()->json($payload, 400);
            }

            return response()->json([
                'success' => true,
                'data' => 'Archivo cargado correctamente'
            ], 200);

        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear la entidad técnica por excel, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
