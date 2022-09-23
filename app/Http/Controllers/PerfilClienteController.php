<?php

namespace App\Http\Controllers;

use App\Models\PerfilCliente;
use Illuminate\Http\Request;

class PerfilClienteController extends Controller
{

    public function perfilClientes(Request $request)
    {
        try {
            $perfiles = PerfilCliente::get();

            return response()->json([
                'success' => true,
                'data' => $perfiles
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar los perfiles, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function createdPerfilCliente(Request $request)
    {
        try {

            $data = $request->all();
            // dd('a');
            $perfile = PerfilCliente::create($data);
            return response()->json([
                'success' => true,
                'data' => $perfile
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear perfil, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedPerfilCliente(Request $request, $id)
    {

        try {
            $perfil = PerfilCliente::find($id);

            if ($perfil) {
                $data = $request->all();
                $perfil->update($data);

                return response()->json([
                    'success' => true,
                    'data' => $perfil
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró perfil',
                    'msg' => 'Error al actualizar datos del perfil'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al modificar perfil, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
