<?php

namespace App\Http\Controllers;

use App\Models\ContactByExcel;
use App\Models\contactoDistribuidor;
use Illuminate\Http\Request;

class ContactByExcelController extends Controller
{
    public function getContacts(Request $request) {

        try {

            $contacts = ContactByExcel::get();

            return response()->json([
                'success' => true,
                'data' => $contacts
            ], 200);
        
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'No se encontro contactos, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }

    }

    public function createByExcel(Request $request) {

        try {

            $contactos = $request->data;
            foreach ($contactos as $contacto) {
                $payload = [
                    'modulo' => isset($contacto['Modulo']) ? $contacto['Modulo'] : '',
                    'nombre' => isset($contacto['Nombre']) ? $contacto['Nombre'] : '',
                    'empresa' => isset($contacto['Empresa']) ? $contacto['Empresa'] : '',
                    'telefono' => isset($contacto['Telefono Personal']) ? $contacto['Telefono Personal'] : '',
                    'telefono2' => isset($contacto['Telefono Corporativo']) ? $contacto['Telefono Corporativo'] : '',
                    'email' => isset($contacto['Email Personal']) ? $contacto['Email Personal'] : '',
                    'email2' => isset($contacto['Email Corporato']) ? $contacto['Email Corporato'] : '',
                    'cargo' => isset($contacto['Cargo']) ? $contacto['Cargo'] : '',
                    'direccion' => isset($contacto['Dirección']) ? $contacto['Dirección'] : '',
                ];
                    ContactByExcel::create($payload);
            }
    
            return response()->json([
                'success' => true,
                'data' => 'Se creo correctamente los contactos'
            ], 200);
        
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear contactos por excel, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

}
