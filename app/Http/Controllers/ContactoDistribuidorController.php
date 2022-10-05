<?php

namespace App\Http\Controllers;

use App\Models\contactoDistribuidor;
use Illuminate\Http\Request;

class ContactoDistribuidorController extends Controller
{
    public function contactos(Request $request, $id_cliente)
    {
        try {
            $contactos = contactoDistribuidor::where('cliente_id', $id_cliente)->get();

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
            $contactos = contactoDistribuidor::join('clientes', 'contacto_distribuidors.cliente_id', '=', 'clientes.id')
                ->select('clientes.razon_social','contacto_distribuidors.*')
                ->get();



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
            $contacto = contactoDistribuidor::create($request->all());

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
            $contacto = contactoDistribuidor::find($id);

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
            $contacto = contactoDistribuidor::find($id);

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
