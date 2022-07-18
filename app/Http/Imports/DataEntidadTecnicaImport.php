<?php

namespace App\Http\Imports;

use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;

use function PHPSTORM_META\type;

class DataEntidadTecnicaImport implements ToModel
{
    public function model(array $row)
    {

        if ($row[0] && $row[0] != 'RUC') {
            // $ruc = intval($row[4]);
            // // dd($row[4]);
            $ruc = trim($row[0]);
            // $ruc = implode($row[4]);
            // $ruc = trim( $row[4]."a papapepa a ");
            // $ruc = preg_replace("/[[:space:]]/","",trim($ruc));
            // dd($ruc);
            return new EntidadTecnica([
                'departamento_fiscal' => $row[10],
                'departamento_real' => $row[12],
                'direccion_fiscal' => $row[2],
                'latitud_fiscal_gps' =>(float) $row[23],
                'longitud_fiscal_gps' =>(float) $row[24],
                'direccion_real' => $row[3],
                'latitud_real_gps' =>(float)$row[25],
                'longitud_real_gps' =>(float) $row[26],
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
            ]);
        }
    }
}

// contacto 17-22
