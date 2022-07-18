<?php

namespace App\Http\Controllers;

use App\Http\Imports\ConvocatoriaImport;
use App\Models\Convocatoria;
use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ConvocatoriaController extends Controller
{
    public function convocatorias(Request $request)
    {
        try {

            $convocatorias = Convocatoria::get();
            foreach ($convocatorias as $convocatoria) {
                $convocatoria->entidadesTecnicas; 
                // $convocatoria->entidades_tecnicas = sizeof($convocatoria->entidadesTecnicas);
                // $convocatoria->cantidad_de_modulos2 = $convocatorias_relacion->sum('cantidad_de_modulos');
            }

            return response()->json([
                'success' => true,
                'data' => $convocatorias
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function entidadesDeConvocatorias(Request $request, $id_convocatoria)
    {
        try {

            $convocatoria = Convocatoria::find($id_convocatoria);

            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            $entidades = $convocatoria->entidadesTecnicas;

            foreach ($entidades as $entidad) {
                $entidad->cantidad_de_modulos = $entidad->pivot->cantidad_de_modulos;
                $entidad->id_negociacion = $entidad->pivot->id;
                $entidad->fecha_de_facturacion = $entidad->pivot->fecha_de_facturacion;
                $entidad->monto_en_soles = $entidad->pivot->monto_en_soles;
                $entidad->convocatoria = $entidad->pivot->convocatoria;
                $entidad->departamento_de_despacho = $entidad->pivot->departamento_de_despacho;
                $entidad->entidad_tecnica = $entidad->pivot->entidad_tecnica;
                $entidad->estado_de_negociacion = $entidad->pivot->estado_de_negociacion;
                $entidad->etapa_de_contratacion = $entidad->pivot->etapa_de_contratacion;
                $entidad->gano_entidad_tecnica = $entidad->pivot->gano_entidad_tecnica;
                $entidad->incluye_puerta_principal = $entidad->pivot->incluye_puerta_principal;
                $entidad->perdio_entidad_tecnica = $entidad->pivot->perdio_entidad_tecnica;
                $entidad->porcentaje_de_cierre = $entidad->pivot->porcentaje_de_cierre;
            }

            return response()->json([
                'success' => true,
                'data' => $entidades
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar entidades de convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function createdConvocatoria(Request $request)
    {
        try {

            $data = $request->all();
            $convocatoria = Convocatoria::create($data);

            return response()->json([
                'success' => true,
                'data' => $convocatoria
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function updatedConvocatoria(Request $request, $id)
    {
        try {

            $data = $request->all();
            $convocatoria = Convocatoria::find($id);
            if ($convocatoria) {
                $convocatoria->update($data);
                return response()->json([
                    'success' => true,
                    'data' => $convocatoria
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro la convocatoria',
                    'msg' => 'Error al actualizar convocatoria'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al actualizar convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    public function deleteConvocatoria(Request $request, $id)
    {
        try {

            $convocatoria = Convocatoria::find($id);
            if ($convocatoria) {
                $convocatoria->delete();
                return response()->json([
                    'success' => true,
                    'data' => $convocatoria
                ], 200);
            } else {
                $payload = [
                    'success' => false,
                    'error' => 'No se encontro la convocatoria',
                    'msg' => 'Error al eliminar convocatoria'
                ];
                return response()->json($payload, 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    // AGREGAR RELACION CONVOCATORIA CON ENTIDAD TECNICA

    public function addEntidadTecnica(Request $request)
    {
        try {
            $id_convocatoria = $request->id_convocatoria;
            $id_entidadTecnica = $request->id_entidadTecnica;
            $cantidad_de_modulos = $request->cantidad_de_modulos;

            $convocatoria = Convocatoria::find($id_convocatoria);
            $entidadTecnica = EntidadTecnica::find($id_entidadTecnica);
            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            if (!$entidadTecnica) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la entidad técnica',
                ];
                return response()->json($payload, 400);
            }
            
            $convocatoria->entidadesTecnicas()->attach($id_entidadTecnica, ['cantidad_de_modulos'=>$cantidad_de_modulos]);

            return response()->json([
                'success' => true,
                'msg' => 'Se agregó la entidad tecnica a la convocatoria'
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al agregar entidades de convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function deleteEntidadTecnica(Request $request, $id_convocatoria, $id_entidadTecnica)
    {
        try {
            $id_convocatoria = $request->id_convocatoria;
            $id_entidadTecnica = $request->id_entidadTecnica;

            $convocatoria = Convocatoria::find($id_convocatoria);
            $entidadTecnica = EntidadTecnica::find($id_entidadTecnica);
            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            if (!$entidadTecnica) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la entidad técnica',
                ];
                return response()->json($payload, 400);
            }

            $convocatoria->entidadesTecnicas()->detach($id_entidadTecnica);

            return response()->json([
                'success' => true,
                'msg' => 'Se elimino la entidad tecnica a la convocatoria'
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al eliminar entidades de convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function getEntidadTecnica(Request $request)
    {
    }
    public function entidadSinNegociacion(Request $request, $id_convocatoria)
    {
        try {

            $convocatoria = Convocatoria::find($id_convocatoria);

            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            $entidades = $convocatoria->entidadesTecnicas;
            $entidades_libre = [];
            $entidades_totales = EntidadTecnica::all();

            foreach ($entidades_totales as $entidad) {
                $entidad_en_convocatoria = false;
                foreach ($entidades as $entidad_convocatoria) {
                    if ($entidad->id == $entidad_convocatoria->id) {
                        $entidad_en_convocatoria = true;
                    }
                }
                if (!$entidad_en_convocatoria) {
                    $entidades_libre[] = $entidad;
                }
            }

            return response()->json([
                'success' => true,
                'data' => $entidades_libre
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al listar entidades de convocatoria, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    ///NEGOCIACIONES
    public function createNegociacion(Request $request, $id_convocatoria, $id_entidadTecnica)
    {
        try {
            $id_convocatoria = $request->id_convocatoria;
            $id_entidadTecnica = $request->id_entidadTecnica;
            $cantidad_de_modulos = $request->cantidad_de_modulos;

            $convocatoria = Convocatoria::find($id_convocatoria);
            $entidadTecnica = EntidadTecnica::find($id_entidadTecnica);
            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            if (!$entidadTecnica) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la entidad técnica',
                ];
                return response()->json($payload, 400);
            }

            // $payload = [
            //     'cantidad_de_modulos' => $cantidad_de_modulos,
            //     'fecha_de_facturacion' => $request->fecha_de_facturacion,
            //     'monto_en_soles' => $request->monto_en_soles,
            //     'convocatoria' => $request->convocatoria,
            //     'departamento_de_despacho' => $request->departamento_de_despacho,
            //     'entidad_tecnica' => $request->entidad_tecnica,
            //     'estado_de_negociacion' => $request->estado_de_negociacion,
            //     'etapa_de_contratacion' => $request->etapa_de_contratacion,
            //     'gano_entidad_tecnica' => $request->gano_entidad_tecnica,
            //     'incluye_puerta_principal' => $request->incluye_puerta_principal,
            //     'perdio_entidad_tecnica' => $request->perdio_entidad_tecnica,
            //     'porcentaje_de_cierre' => $request->porcentaje_de_cierre
            // ];

            DB::select(
                'Update convocatoria_entidad_tecnica 
                SET cantidad_de_modulos = ?,
                fecha_de_facturacion = ?,
                monto_en_soles = ?,
                convocatoria = ?,
                departamento_de_despacho = ?,
                entidad_tecnica = ?,
                estado_de_negociacion = ?,
                etapa_de_contratacion = ?,
                gano_entidad_tecnica = ?,
                incluye_puerta_principal = ?,
                perdio_entidad_tecnica = ?,
                porcentaje_de_cierre = ?
                WHERE convocatoria_id = ? AND entidad_tecnica_id = ?',
                [
                    $cantidad_de_modulos,
                    $request->fecha_de_facturacion,
                    $request->monto_en_soles,
                    $request->convocatoria,
                    $request->departamento_de_despacho,
                    $request->entidad_tecnica,
                    $request->estado_de_negociacion,
                    $request->etapa_de_contratacion,
                    $request->gano_entidad_tecnica,
                    $request->incluye_puerta_principal,
                    $request->perdio_entidad_tecnica,
                    $request->porcentaje_de_cierre,
                    $id_convocatoria,
                    $id_entidadTecnica
                ]);

            return response()->json([
                'success' => true,
                'msg' => 'Se crear negociacion de la entidad tecnica'
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear negociacion de la entidades tecnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }
    
    public function getNegociacion(Request $request,  $id_convocatoria, $id_entidadTecnica)
    {
        try {
            $id_convocatoria = $request->id_convocatoria;
            $id_entidadTecnica = $request->id_entidadTecnica;

            $convocatoria = Convocatoria::find($id_convocatoria);
            $entidadTecnica = EntidadTecnica::find($id_entidadTecnica);
            if (!$convocatoria) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la convocatoria',
                ];
                return response()->json($payload, 400);
            }
            if (!$entidadTecnica) {
                $payload = [
                    'success' => false,
                    'msg' => 'No se encontró la entidad técnica',
                ];
                return response()->json($payload, 400);
            }

            $response = DB::select('
                SELECT * FROM convocatoria_entidad_tecnica 
                WHERE convocatoria_id = ? AND entidad_tecnica_id = ?',
                [
                    $id_convocatoria,
                    $id_entidadTecnica
                ]);
            

            return response()->json([
                'success' => true,
                'data' => $response
            ], 200);
        } catch (\Throwable $th) {
            $payload = [
                'success' => false,
                'error' => $th->getMessage(),
                'msg' => 'Error al crear negociacion de la entidades tecnica, hable con el administrador'
            ];
            return response()->json($payload, 500);
        }
    }

    public function cargaConvocatoriaExcel (Request $request) {
        try {

            if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                Excel::import(new ConvocatoriaImport , $path);
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
                'data' => 'Convocatorias cargado correctamente'
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
