<?php

namespace App\Http\Imports;

use App\Models\Convocatoria;
use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class ConvocatoriaImport implements ToModel
{
    public $convocatorias = [];
    public function model(array $row)
    {
        // crear convocatoria
        if ($row[0] && $row[0] == 'RUC') {
            // $i = 2;
            // dd(isset($row[8]));
            for ($i = 2; $i < count($row); $i++) {
                array_push($this->convocatorias, $row[$i]);

                $convocatoria = Convocatoria::where('nombre', $row[$i])->first();
                if (!$convocatoria) {
                    // new Convocatoria([
                    //     'nombre' => $row[$i],
                    // ]);
                    $data = [
                        'nombre' => $row[$i],
                    ];
                    $convocatoria = Convocatoria::create($data);
                }
            }
        }

        // crear relacion entidad tecnica y convocatoria

        if ($row[0] && $row[0] != 'RUC') {
            // dd($row[0]);
            $entidad_tecnica = EntidadTecnica::where('ruc', $row[0])->first();
            // dd($entidad_tecnica);
            for ($i=0; $i <count($this->convocatorias) ; $i++) {
                if (isset($row[$i+2])) {
                    // dd($this->convocatorias[$i]);
                    $convocaoria = Convocatoria::where('nombre', $this->convocatorias[$i])->first();
                    // dd($convocaoria);
                    if ($entidad_tecnica && $convocaoria) {
                        $existe_relacion = DB::select(
                            'Select * from convocatoria_entidad_tecnica 
                            WHERE convocatoria_id = ? AND entidad_tecnica_id = ?',
                            [
                                $convocaoria->id,
                                $entidad_tecnica->id
                            ]);
                            // dd($existe_relacion);
                        if (count($existe_relacion)==0) {
                        $entidad_tecnica->convocatorias()->attach($convocaoria->id, ['cantidad_de_modulos'=> $row[$i + 2]]);
                        } else {
                            DB::select(
                                'Update convocatoria_entidad_tecnica 
                                SET cantidad_de_modulos = ?
                                WHERE convocatoria_id = ? AND entidad_tecnica_id = ?',
                                [
                                    $row[$i + 2],// cantidad de modulos
                                    $convocaoria->id,
                                    $entidad_tecnica->id
                                ]);
                        }
                    }
                } 
            }
            // dd($this->convocatorias);
        }
        return null;
        // return new EntidadTecnica([
        //     // 'name' => $row[0],
        //     // 'email' => $row[1],
        //     'departamento_fiscal' => $row[7],
        //     'departamento_real' => $row[14],
        //     'direccion_fiscal' => $row[10],
        //     'latitud_fiscal_gps' =>(float) $row[11],
        //     'longitud_fiscal_gps' =>(float) $row[12],
        //     'direccion_real' => $row[15],
        //     'latitud_real_gps' =>(float)$row[16],
        //     'longitud_real_gps' =>(float) $row[17],
        //     'email_user' => $row[29],
        //     'estado' => $row[2],
        //     // 'foto_direccion_fiscal' => $row[1],
        //     // 'foto_direccion_real' => $row[1],
        //     // 'medio_de_contacto' => $row[1],
        //     'proveedor_actual' => $row[27],
        //     'provincia_fiscal' => $row[8],
        //     // 'provincia_real' => $row[1],
        //     'razon_social' => $row[3],
        //     'representante_legal' => $row[6],
        //     'ruc' => $row[4],
        //     'tiene_grupo' => $row[5],
        //     'tipo_de_cliente' => $row[25],
        //     'tipo_de_construccion' => $row[28],
        //     // 'verificado_direccion_fiscal_gps' => $row[1],
        //     // 'verificado_direccion_real_gps' => $row[1],
        //     'vigencia' => $row[1],
        //     'zona' => $row[0]
        // ]);
    }
}

// contacto 17-22
