<?php

namespace App\Http\Controllers;

use App\Models\Instaladores;
use Illuminate\Http\Request;

class InstaladoresController extends Controller
{
    public function contactosTodos(Request $request)
    {
        try {
            $contactos = Instaladores::get();

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
            $contacto = Instaladores::create($request->all());

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
            $contacto = Instaladores::find($id);

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
            $contacto = Instaladores::find($id);

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
}
