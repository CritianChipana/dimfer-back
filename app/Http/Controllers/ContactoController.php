<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    public function contactos(Request $request, $id_entidad)
    {
        try {
            $contactos = Contacto::where('entidad_tecnica_id', $id_entidad)->get();

            return response()->json([
                'success' => true,
                'data' => $contactos
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar los contactos, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function contactosTodos(Request $request)
    {
        try {
            $contactos = Contacto::get();

            return response()->json([
                'success' => true,
                'data' => $contactos
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar los contactos, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function createdContacto(Request $request)
    {

        try {
            // $contacto = new Contacto();
            // $contacto->nombre = $request->nombre;
            // $contacto->telefono = $request->telefono;
            // $contacto->email = $request->email;
            // $contacto->entidad_tecnica_id = $request->entidad_tecnica_id;
            // $contacto->save();
            $contacto = Contacto::create($request->all());

            return response()->json([
                'success' => true,
                'data' => $contacto
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear el contacto, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedContacto(Request $request, $id)
    {

        try {
            $contacto = Contacto::find($id);

            if ($contacto) {
                $contacto->update($request->all());

                return response()->json([
                    'success' => true,
                    'data' => $contacto
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró el contacto',
                    'msg' => 'Error al actualizar el contacto'
                ];
                return response()->json($payload, 500);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al actualizar el contacto, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteContacto(Request $request, $id)
    {

        try {
            $contacto = Contacto::find($id);

            if ($contacto) {
                $contacto->delete();

                return response()->json([
                    'success' => true,
                    'data' => $contacto
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró el contacto',
                    'msg' => 'Error al eliminar el contacto'
                ];
                return response()->json($payload, 500);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar el contacto, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function arreglar(Request $request)
    {

        try {

            $contactos = DB::select("SELECT * from contactos where nombre LIKE '9%'");

            foreach ($contactos as $value) {
                $contacto = Contacto::find($value->id);
                $aux_name = $contacto->nombre;
                $contacto->nombre = $contacto->telefono;
                $contacto->telefono = $aux_name;
                $contacto->save();
            }

                return response()->json([
                    'success' => true,
                    'data' => $contactos
                ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar el contacto, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    
}
