<?php

namespace App\Http\Controllers;

use App\Http\Imports\DataEntidadTecnicaImport;
use App\Http\Imports\EntidadTecnicaImport;
use App\Models\Comentario;
use App\Models\Contacto;
use App\Models\Convocatoria;
use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Facades\Excel;
// use Excel;

class EntidadTecnicaController extends Controller
{

    public function entidadesTecnicas(Request $request)
    {
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
    public function entidadesTecnicasByUser(Request $request)
    {
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
    public function createdEntidadTecnica(Request $request)
    {
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
    public function updatedEntidadTecnica(Request $request, $id)
    {

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
    public function deleteEntidadTecnica(Request $request, $id)
    {

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
    public function cargaEntidadTecnicaExcel(Request $request)
    {
        try {

            // if ($request->hasFile('file')) {
            //     $path = $request->file('file')->getRealPath();
            //     // dd($path);
            //     Excel::import(new EntidadTecnicaImport, $path);
            // } else {
            //     $payload = [ // excel to json
            //         'success' => false,
            //         'error' => 'No se encontró el archivo',
            //         'msg' => 'Error al cargar el archivo'
            //     ];
            //     return response()->json($payload, 400);
            // }

            $entidades = $request->data;
            foreach ($entidades as $entidad) {

                $existe = isset($entidad['RUC']); /* ? ($entidad['RUC']) : '' */
                if ($existe) {
                    $existe_entidad_tecnica = EntidadTecnica::where('ruc', strval($entidad['RUC']))->first();
                    if (!$existe_entidad_tecnica) {
                        $payload = [
                            'departamento_fiscal' => isset($entidad['Departamento']) ? $entidad['Departamento'] : '',
                            'departamento_real' => isset($entidad['DEPARTAMENTO - REAL']) ? $entidad['DEPARTAMENTO - REAL'] : '',
                            'direccion_fiscal' => isset($entidad['DIRECCION FISCAL']) ? $entidad['DIRECCION FISCAL'] : '',
                            'latitud_fiscal_gps' => isset($entidad['LATITUD GPS']) ? (float)$entidad['LATITUD GPS'] : 0,
                            'longitud_fiscal_gps' => isset($entidad['LONGITUD GSP']) ? (float)$entidad['LONGITUD GSP'] : 0,
                            'direccion_real' => isset($entidad['DIRECCION REAL']) ? $entidad['DIRECCION REAL'] : '',
                            'latitud_real_gps' => isset($entidad['LATITUD GPS_1']) ? (float)$entidad['LATITUD GPS_1'] : 0,
                            'longitud_real_gps' => isset($entidad['LONGITUD GSP_1']) ? (float)$entidad['LONGITUD GSP_1'] : 0,
                            'email_user' => isset($entidad['EMAIL DEL USUARIO']) ? $entidad['EMAIL DEL USUARIO'] : '',
                            'estado' => isset($entidad['ESTADO']) ? $entidad['ESTADO'] : '',
                            'proveedor_actual' => isset($entidad['PROVEEDOR ACTUAL']) ? $entidad['PROVEEDOR ACTUAL'] : '',
                            'provincia_fiscal' => isset($entidad['Provincia']) ? $entidad['Provincia'] : '',
                            'razon_social' => isset($entidad['RAZON SOCIAL']) ? $entidad['RAZON SOCIAL'] : '',
                            'representante_legal' => isset($entidad['Rep Legal/persona de contacto']) ? $entidad['Rep Legal/persona de contacto'] : '',
                            'ruc' => isset($entidad['RUC']) ? strval($entidad['RUC']) : '',
                            'tiene_grupo' => isset($entidad['PERTENECE A UN GRUPO?']) ? $entidad['PERTENECE A UN GRUPO?'] : '',
                            'tipo_de_cliente' => isset($entidad['CLENTE/NO CLIENTE/TIPO DE CLIENTE']) ? $entidad['CLENTE/NO CLIENTE/TIPO DE CLIENTE'] : '',
                            'tipo_de_construccion' => isset($entidad['TIPO DE CONSTRUCCION (CSP/AVN)']) ? $entidad['TIPO DE CONSTRUCCION (CSP/AVN)'] : '',
                            'vigencia' => isset($entidad['VIGENTE']) ? $entidad['VIGENTE'] : '',
                            'zona' => isset($entidad['ZONA']) ? $entidad['ZONA'] : '',
                        ];

                        $newEntidad = EntidadTecnica::create($payload);

                        $payload_contact_1 = [
                            'nombre' => isset($entidad['NOMBRE DEL CONTACTO']) ? $entidad['NOMBRE DEL CONTACTO'] : '',
                            'email' => isset($entidad['EMail']) ? $entidad['EMail'] : '',
                            'telefono' => isset($entidad['Celular']) ? $entidad['Celular'] : '',
                            'entidad_tecnica_id' => $newEntidad->id,
                        ];
                        logger("===============================");
                        logger($payload_contact_1);
                        $payload_contact_2 = [
                            'nombre' => isset($entidad['NOMBRE DEL CONTACTO_1']) ? $entidad['NOMBRE DEL CONTACTO_1'] : '',
                            'email' => isset($entidad['EMail_1']) ? $entidad['EMail_1'] : '',
                            'telefono' => isset($entidad['Celular_1']) ? $entidad['Celular_1'] : '',
                            'entidad_tecnica_id' => $newEntidad,
                        ];

                        if (isset($entidad['NOMBRE DEL CONTACTO']) || isset($entidad['EMail']) || isset($entidad['Celular'])) {
                            Contacto::create($payload_contact_1);
                        }
                        if (isset($entidad['NOMBRE DEL CONTACTO_1']) || isset($entidad['EMail_1']) || isset($entidad['Celular_1'])) {
                            Contacto::create($payload_contact_2);
                        }
                        // dd($entidad['RUC']);
                    }
                }
            }
            // $data = json_decode($data);

            return response()->json([
                'success' => true,
                'data' => 'Se creo correctamente la entidad técnica'
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

    public function cargaEntidadTecnica(Request $request)
    {
        try {

            // if ($request->hasFile('file')) {
            //     $path = $request->file('file')->getRealPath();
            //     Excel::import(new DataEntidadTecnicaImport, $path);
            // } else {
            //     $payload = [
            //         'success' => false,
            //         'error' => 'No se encontró el archivo',
            //         'msg' => 'Error al cargar el archivo'
            //     ];
            //     return response()->json($payload, 400);
            // }

            $entidades = $request->data;
            foreach ($entidades as $entidad) {
                logger($entidad);
                $existe = isset($entidad['RUC']); /* ? ($entidad['RUC']) : '' */
                if ($existe) {
                    $existe_entidad_tecnica = EntidadTecnica::where('ruc', $entidad['RUC'])->first();
                    if (!$existe_entidad_tecnica) {
                        $payload = [
                            'departamento_fiscal' => isset($entidad['DEPARTAMENTO FISCAL']) ? $entidad['DEPARTAMENTO FISCAL'] : '',
                            'departamento_real' => isset($entidad['DEPARTAMENTO REAL']) ? $entidad['DEPARTAMENTO REAL'] : '',
                            'direccion_fiscal' => isset($entidad['DIRECIÓN FISCAL']) ? $entidad['DIRECIÓN FISCAL'] : '',
                            'latitud_fiscal_gps'  => isset($entidad['LATITUD FISCAL']) ? (float)$entidad['LATITUD FISCAL'] : 0,
                            'longitud_fiscal_gps'  => isset($entidad['LONGITUD FISCAL']) ? (float)$entidad['LONGITUD FISCAL'] : 0,
                            'direccion_real'  => isset($entidad['DIRECIÓN REAL']) ? $entidad['DIRECIÓN REAL'] : '',
                            'latitud_real_gps'  => isset($entidad['LATITUD REAL']) ? (float)$entidad['LATITUD REAL'] : 0,
                            'longitud_real_gps'  => isset($entidad['LONGITUD REAL']) ? (float)$entidad['LONGITUD REAL'] : 0,
                            'email_user'  => isset($entidad['EMAIL']) ? $entidad['EMAIL'] : '',
                            'estado'  => isset($entidad['ESTADO']) ? $entidad['ESTADO'] : '',
                            'foto_direccion_fiscal'  => isset($entidad['FOTO DIRECCION FISCAL']) ? $entidad['FOTO DIRECCION FISCAL'] : '',
                            'foto_direccion_real'  => isset($entidad['FOTO DIRECCION REAL']) ? $entidad['FOTO DIRECCION REAL'] : '',
                            'medio_de_contacto'  => isset($entidad['MEDIO DE CONTACTO']) ? $entidad['MEDIO DE CONTACTO'] : '',
                            'proveedor_actual'  => isset($entidad['PROVEEDOR ACTUAL']) ? $entidad['PROVEEDOR ACTUAL'] : '',
                            'provincia_fiscal'  => isset($entidad['PROVINCIA FISCAL']) ? $entidad['PROVINCIA FISCAL'] : '',
                            'provincia_real'  => isset($entidad['PROVINCIA REAL']) ? $entidad['PROVINCIA REAL'] : '',
                            'razon_social'  => isset($entidad['RAZON SOCIAL']) ? $entidad['RAZON SOCIAL'] : '',
                            'representante_legal'  => isset($entidad['REPRESENTANTE LEGAL']) ? $entidad['REPRESENTANTE LEGAL'] : '',
                            'ruc'  => isset($entidad['RUC']) ? strval($entidad['RUC']) : '',
                            'tiene_grupo'  => isset($entidad['Departamento']) ? $entidad['Departamento'] : '',
                            'tipo_de_cliente'  => isset($entidad['TIPO DE CLIENTE']) ? $entidad['TIPO DE CLIENTE'] : '',
                            'tipo_de_construccion'  => isset($entidad['TIPO DE CONSTRUCCION']) ? $entidad['TIPO DE CONSTRUCCION'] : '',
                            'verificado_direccion_fiscal_gps'  => $entidad['VERIFICADO DIRECCION FISCAL'] == 'VERDADERO' ? true : false,
                            'verificado_direccion_real_gps'  => isset($entidad['VERIFICADO DIRECCION REAL']) == 'VERDADERO' ? true : false,
                            'vigencia'  => isset($entidad['VIGENCIA']) ? $entidad['VIGENCIA'] : '',
                            'zona'  => isset($entidad['ZONA']) ? $entidad['ZONA'] : '',
                        ];

                        $newEntidad = EntidadTecnica::create($payload);
                        // $newEntidad_id = new EntidadTecnica();
                        // $newEntidad_id->ruc = strval($entidad['RUC']);
                        // $newEntidad_id->save();
                        // $newEntidad_id->razon_social = isset($entidad['RAZON SOCIAL']) ? $entidad['RAZON SOCIAL'] : ''



                        //Crear relacion
                        $cantidad_De_modulos = isset($entidad['CANTIDAD DE MODULOS']) ? $entidad['CANTIDAD DE MODULOS'] : '';
                        $cantidad_de_convocatoria = isset($entidad['CANTIDAD DE CONVOCATORIAS']) ? $entidad['CANTIDAD DE CONVOCATORIAS'] : '';

                        $array_convocatorias = explode(",", $cantidad_de_convocatoria);
                        $array_modulos = explode(',', $cantidad_De_modulos);
                        for ($i = 0; $i < count($array_convocatorias); $i++) {
                            $convocatoriaModelo = Convocatoria::where('nombre', $array_convocatorias[$i])->first();
                            if ($convocatoriaModelo) {
                                $convocatoriaModelo->entidadesTecnicas()->attach($newEntidad->id, ['cantidad_de_modulos' => (int)$array_modulos[$i]]);
                            }
                        }
                        //crear contactos
                        $json_contactos = isset($entidad['CONTACTOS']) ? json_decode($entidad['CONTACTOS']) : [];

                        foreach ($json_contactos as $key => $value) {
                            logger('================');
                            // logger($json_contactos[$key]->);
                            $payload_contact_1 = [
                                'nombre' => isset($json_contactos[$key]->contactTelephone) ? $json_contactos[$key]->contactTelephone  : '',
                                'email' => isset($json_contactos[$key]->emailContact) ? $json_contactos[$key]->emailContact : '',
                                'telefono' => isset($json_contactos[$key]->contactName) ? $json_contactos[$key]->contactName : '',
                                'entidad_tecnica_id' => $newEntidad->id,
                            ];
                            if (isset($json_contactos[$key]->contactTelephone) || isset($json_contactos[$key]->emailContact) || isset($json_contactos[$key]->contactName)) {
                                Contacto::create($payload_contact_1);
                            }
                        }
                        // crear comentarios
                        $json_comentarios = isset($entidad['COMENTARIOS']) ? json_decode($entidad['COMENTARIOS']) : [];
                        // dd($json_comentarios);
                        foreach ($json_comentarios as $key => $value) {
                            $payload_comentario = [
                                'comentario' => isset($json_comentarios[$key]->commentary) ? $json_comentarios[$key]->commentary : '',
                                'convocatoria' => isset($json_comentarios[$key]->convocatoria) ? $json_comentarios[$key]->convocatoria : '',
                                'email_user' => isset($json_comentarios[$key]->emailName) ? $json_comentarios[$key]->emailName : '',
                                'entidad_tecnica_id' => $newEntidad->id,
                            ];
                            if (isset($json_comentarios[$key]->commentary) || isset($json_comentarios[$key]->convocatoria) || isset($json_comentarios[$key]->emailName)) {
                                Comentario::create($payload_comentario);
                            }
                        }
                    }
                }
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
