<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\contactoDistribuidor;
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

    public function clientesByEmail(Request $request)
    {
        try {
            $email_user = $request->header('email_user');
            $cliente = Cliente::where('email_user', $email_user)->get();

            return response()->json([
                'success' => true,
                'data' => $cliente
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
            $clientes = $request->data;
            // return $clientes;
            foreach ($clientes as $cliente) {

                $existe = isset($cliente['Nombre/Razon Social del Cliente']); /* ? ($cliente['RUC']) : '' */
                if ($existe) {
                    $existe_cliente = Cliente::where('razon_social', strval($cliente['Nombre/Razon Social del Cliente']))->first();
                    if (!$existe_cliente) {
                        $payload = [
                            'razon_social' => isset($cliente['Nombre/Razon Social del Cliente']) ? trim(strval($cliente['Nombre/Razon Social del Cliente'])) : '',
                            'canal_de_venta' => isset($cliente['Canal de Venta']) ? trim(strtoupper(strval($cliente['Canal de Venta']))) : '',
                            'ruc' => isset($cliente['RUC']) ? trim(strval($cliente['RUC'])) : '',
                            'email_user' => isset($cliente['Vendedor']) ? trim(strval($cliente['Vendedor'])) : '',
                            'tipo_de_tienda' => isset($cliente['Tipo de tienda']) ? trim(strtoupper(strval($cliente['Tipo de tienda']))) : '',
                            'perfil_de_cliente' => isset($cliente['Perfil de cliente']) ? trim(strval($cliente['Perfil de cliente'])) : '',
                            'n_tienda' => isset($cliente['N° de tiendas']) ? $cliente['N° de tiendas'] : 0,
                            'activo' => isset($cliente['Activo (Si/No)']) ? (($cliente['Activo (Si/No)'] == 'si' or $cliente['Activo (Si/No)'] == 'SI') ? true : false ) : false,
                            'logo' => isset($cliente['Logo']) ? (($cliente['Logo'] == 'si' or $cliente['Logo'] == 'SI') ? true : false ) : false,
                            'latitud' => isset($cliente['Latitud']) ? trim(strval($cliente['Latitud'])) : 0,
                            'longitud' => isset($cliente['Longitud']) ? trim(strval($cliente['Longitud'])) : 0,
                            'productos' => isset($cliente['Que productos comercializa']) ? trim(strval($cliente['Que productos comercializa'])) : '',
                            'exhibidor' => isset($cliente['Tiene exhibidor']) ? (($cliente['Tiene exhibidor'] == 'si' or $cliente['Tiene exhibidor'] == 'SI') ? true : false ) : false,
                            'remoledar_exhibidor' => isset($cliente['Se necesita remoledar el exhibidor?']) ? (($cliente['Se necesita remoledar el exhibidor?'] == 'si' or $cliente['Se necesita remoledar el exhibidor?'] == 'SI') ? true : false ) : false,
                            'foto_local' => isset($cliente['Tenemos fotos de su local?']) ? (($cliente['Tenemos fotos de su local?'] == 'si' or $cliente['Tenemos fotos de su local?'] == 'SI') ? true : false ) : false,
                            'tiene_material' => isset($cliente['Tiene material publicitario? (Banner/Aficha/Bandera)']) ?(($cliente['Tiene material publicitario? (Banner/Aficha/Bandera)'] == 'si' or $cliente['Tiene material publicitario? (Banner/Aficha/Bandera)'] == 'SI') ? true : false ) : false,
                            'redes_sociales' => isset($cliente['Que redes sociales utiliza?']) ? trim(strval($cliente['Que redes sociales utiliza?'])) : '',
                            'web' => isset($cliente['Web']) ? trim(strval($cliente['Web'])) : '',
                            'link_facebook' => isset($cliente['Link de facebook']) ? trim(strval($cliente['Link de facebook'])) : '',
                            'departamento' => isset($cliente['Departamento']) ? trim(strtoupper(strval($cliente['Departamento']))) : '',
                            'provincia' => isset($cliente['Provincia']) ? trim(strtoupper(strval($cliente['Provincia']))) : '',
                            'direccion_cliente' => isset($cliente['DireccionCliente']) ? trim(strval($cliente['DireccionCliente'])) : '',
                            'ubicacion_de_maps' => isset($cliente['ubicación de maps google']) ? trim(strval($cliente['ubicación de maps google'])) : '',
                        ];

                        $newCliente = Cliente::create($payload);

                        $payload_contact_1 = [
                            'nombre' => isset($cliente['Nombre contacto 1']) ? $cliente['Nombre contacto 1'] : '',
                            'telefono' => isset($cliente['Numero Contacto 1']) ? $cliente['Numero Contacto 1'] : '',
                            'email' => isset($cliente['Correo contacto 1']) ? $cliente['Correo contacto 1'] : '',
                            'cliente_id' => $newCliente->id,
                        ];
                        logger("===============================");
                        logger($payload_contact_1);
                        $payload_contact_2 = [
                            'nombre' => isset($cliente['Nombre contacto 2']) ? $cliente['Nombre contacto 2'] : '',
                            'telefono' => isset($cliente['Numero Contacto 2']) ? $cliente['Numero Contacto 2'] : '',
                            'email' => isset($cliente['Correo contacto 2']) ? $cliente['Correo contacto 2'] : '',
                            'cliente_id' => $newCliente->id,
                        ];

                        if (isset($cliente['Nombre contacto 1']) || isset($cliente['Numero Contacto 1']) || isset($cliente['Correo contacto 1'])) {
                            contactoDistribuidor::create($payload_contact_1);
                        }
                        if (isset($cliente['Nombre contacto 2']) || isset($cliente['Numero Contacto 2']) || isset($cliente['Correo contacto 2'])) {
                            contactoDistribuidor::create($payload_contact_2);
                        }
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
