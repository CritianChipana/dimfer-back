<?php

namespace App\Http\Controllers;

use App\Models\ClienteComentario;
use Illuminate\Http\Request;

class ClienteComentarioController extends Controller
{
    public function createdClienteComentario(Request $request)
    {
        try {

            $data = $request->all();

            // dd('a');
            $clienteComentario = ClienteComentario::create($data);
            return response()->json([
                'success' => true,
                'data' => $clienteComentario
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear comentario del cliente, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function comentariosByCliente(Request $request, $id_cliente)
    {
        try {
            // $email_user = $request->header('email_user');
            $entidadesTecnicas = ClienteComentario::where('cliente_id', $id_cliente)->get();

            return response()->json([
                'success' => true,
                'data' => $entidadesTecnicas
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar comentarios del cliente, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
}
