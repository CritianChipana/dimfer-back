<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function clientes(Request $request)
    {
        try {
            $clientes = Cliente::get();

            return response()->json([
                'success' => true,
                'data' => $clientes
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar los clientes, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function entidadesTecnicasByUser(Request $request)
    {
        try {
            $email_user = $request->header('email_user');
            $entidadesTecnicas = Cliente::where('email_user', $email_user)->get();

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
    public function createdCliente(Request $request)
    {
        try {

            $data = $request->all();
            // dd('a');
            $cliente = Cliente::create($data);
            return response()->json([
                'success' => true,
                'data' => $cliente
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear cliente, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updateCliente(Request $request, $id)
    {

        try {
            $cliente = Cliente::find($id);

            if ($cliente) {
                $data = $request->all();
                $cliente->update($data);

                return response()->json([
                    'success' => true,
                    'data' => $cliente
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró cliente',
                    'msg' => 'Error al actualizar datos del cliente'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al modificar cliente, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteCliente(Request $request, $id)
    {

        try {
            $cliente = Cliente::find($id);

            if ($cliente) {
                $cliente->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Cliente eliminado correctamente'
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontró cliente',
                    'msg' => 'Error al eliminar cliente'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar cliente, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function cargaClienteExcel(Request $request)
    {

        try {
            $entidades = $request->data;
            return $entidades;
            foreach ($entidades as $entidad) {

                $existe = isset($entidad['RUC']); /* ? ($entidad['RUC']) : '' */
                if ($existe) {
                    $existe_entidad_tecnica = Cliente::where('ruc', strval($entidad['Nombre/Razon Social del Cliente']))->first();
                    if (!$existe_entidad_tecnica) {
                        $payload = [
                            'departamento_fiscal' => isset($entidad['Departamento']) ? trim(strval($entidad['Departamento'])) : '',
                            'departamento_real' => isset($entidad['DEPARTAMENTO - REAL']) ? trim(strval($entidad['DEPARTAMENTO - REAL'])) : '',
                            'direccion_fiscal' => isset($entidad['DIRECCION FISCAL']) ? trim(strval($entidad['DIRECCION FISCAL'])) : '',
                        ];

                        $newEntidad = Cliente::create($payload);

                        // $payload_contact_1 = [
                        //     'nombre' => isset($entidad['NOMBRE DEL CONTACTO']) ? $entidad['NOMBRE DEL CONTACTO'] : '',
                        //     'email' => isset($entidad['EMail']) ? $entidad['EMail'] : '',
                        //     'telefono' => isset($entidad['Celular']) ? $entidad['Celular'] : '',
                        //     'entidad_tecnica_id' => $newEntidad->id,
                        // ];
                        // logger("===============================");
                        // logger($payload_contact_1);
                        // $payload_contact_2 = [
                        //     'nombre' => isset($entidad['NOMBRE DEL CONTACTO_1']) ? $entidad['NOMBRE DEL CONTACTO_1'] : '',
                        //     'email' => isset($entidad['EMail_1']) ? $entidad['EMail_1'] : '',
                        //     'telefono' => isset($entidad['Celular_1']) ? $entidad['Celular_1'] : '',
                        //     'entidad_tecnica_id' => $newEntidad,
                        // ];

                        // if (isset($entidad['NOMBRE DEL CONTACTO']) || isset($entidad['EMail']) || isset($entidad['Celular'])) {
                        //     Contacto::create($payload_contact_1);
                        // }
                        // if (isset($entidad['NOMBRE DEL CONTACTO_1']) || isset($entidad['EMail_1']) || isset($entidad['Celular_1'])) {
                        //     Contacto::create($payload_contact_2);
                        // }
                        // dd($entidad['RUC']);
                    }
                }
            }

            // $data = json_decode($data);

            return response()->json([
                'success' => true,
                'data' => 'Se creo correctamente los clientes'
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
