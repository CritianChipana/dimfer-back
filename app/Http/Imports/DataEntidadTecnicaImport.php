<?php

namespace App\Http\Imports;

use App\Models\Comentario;
use App\Models\Contacto;
use App\Models\Convocatoria;
use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;

use function PHPSTORM_META\type;

class DataEntidadTecnicaImport implements ToModel
{
    public function model(array $row)
    {

        if ($row[0] && $row[0] != 'RUC') {
            $existe_entidad = EntidadTecnica::where('ruc', $row[0])->first();
            if ($existe_entidad) {
                $ruc = trim($row[0]);
                $data = [
                    'departamento_fiscal' => $row[10],
                    'departamento_real' => $row[12],
                    'direccion_fiscal' => $row[2],
                    'latitud_fiscal_gps' => (float) $row[23],
                    'longitud_fiscal_gps' => (float) $row[24],
                    'direccion_real' => $row[3],
                    'latitud_real_gps' => (float)$row[25],
                    'longitud_real_gps' => (float) $row[26],
                    'email_user' => $row[7],
                    'estado' => $row[5],
                    'foto_direccion_fiscal' => $row[19],
                    'foto_direccion_real' => $row[20],
                    'medio_de_contacto' => $row[8],
                    'proveedor_actual' => $row[9],
                    'provincia_fiscal' => $row[11],
                    'provincia_real' => $row[13],
                    'razon_social' => $row[1],
                    'representante_legal' => $row[14],
                    'ruc' => $ruc, // POSICION 0
                    'tiene_grupo' => $row[5],
                    'tipo_de_cliente' => $row[15],
                    'tipo_de_construccion' => $row[16],
                    'verificado_direccion_fiscal_gps' => $row[21] == 'VERDADERO' ? 1 : 0,
                    'verificado_direccion_real_gps' => $row[22] == 'VERDADERO' ? 1 : 0,
                    'vigencia' => $row[6],
                    'zona' => $row[4]
                ];
                $new_entidad = EntidadTecnica::create($data);

                $cantidad_De_modulos = $row[17];
                $cantidad_de_convocatoria = $row[18];

                $array_convocatorias = explode(",", $cantidad_de_convocatoria);
                $array_modulos = explode(',', $cantidad_De_modulos);
                for ($i = 0; $i < count($array_convocatorias); $i++) {
                    $convocatoriaModelo = Convocatoria::where('nombre', $array_convocatorias[$i])->first();
                    if ($convocatoriaModelo) {
                        $convocatoriaModelo->entidadesTecnicas()->attach($new_entidad->id, ['cantidad_de_modulos' => $array_modulos[$i]]);
                    }
                }

                // crear contactos
                $json_contacto = json_decode($row[27]);
                // dd($json_contacto);
                foreach ($json_contacto as $contacto) {
                    Contacto::create([
                        'nombre' => $contacto->contactName,
                        'telefono' => $contacto->contactTelephone,
                        'email' => $contacto->emailContact,
                        'entidad_tecnica_id' => $new_entidad->id
                    ]);
                }
                // crear comentario
                $json_comentario = json_decode($row[28]);
                // dd($json_comentario);
                foreach ($json_comentario as $comentario) {
                    Comentario::create([
                        'comentario' => $comentario->commentary,
                        'convocatoria' => $comentario->convocatoria,
                        'email_user' => $comentario->emailName,
                        'entidad_tecnica_id' => $new_entidad->id
                    ]);
                }
            }

            return null;
        }
    }
}

// contacto 17-22
