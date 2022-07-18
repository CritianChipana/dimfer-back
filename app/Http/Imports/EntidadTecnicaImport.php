<?php

namespace App\Http\Imports;

use App\Models\EntidadTecnica;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;


class EntidadTecnicaImport implements ToModel
{
    public function model(array $row)
    {
        // dd(count($row));

        // if( $row) {
            
        //     dd($row[0]);
        // }
        if ($row[0] && $row[0] != 'ZONA') {
            // $ruc = intval($row[4]);
            // // dd($row[4]);
            $ruc = trim($row[4]);
            // $ruc = implode($row[4]);
            // $ruc = trim( $row[4]."a papapepa a ");
            // $ruc = preg_replace("/[[:space:]]/","",trim($ruc));
            // dd($ruc);
            return new EntidadTecnica([
                // 'name' => $row[0],   
                // 'email' => $row[1],
                'departamento_fiscal' => $row[7],
                'departamento_real' => $row[14],
                'direccion_fiscal' => $row[10],
                'latitud_fiscal_gps' =>(float) $row[11],
                'longitud_fiscal_gps' =>(float) $row[12],
                'direccion_real' => $row[15],
                'latitud_real_gps' =>(float)$row[16],
                'longitud_real_gps' =>(float) $row[17],
                'email_user' => $row[29],
                'estado' => $row[2],
                // 'foto_direccion_fiscal' => $row[1],
                // 'foto_direccion_real' => $row[1],
                // 'medio_de_contacto' => $row[1],
                'proveedor_actual' => $row[27],
                'provincia_fiscal' => $row[8],
                // 'provincia_real' => $row[1],
                'razon_social' => $row[3],
                'representante_legal' => $row[6],
                'ruc' => $ruc,
                'tiene_grupo' => $row[5],
                'tipo_de_cliente' => $row[25],
                'tipo_de_construccion' => $row[28],
                // 'verificado_direccion_fiscal_gps' => $row[1],
                // 'verificado_direccion_real_gps' => $row[1],
                'vigencia' => $row[1],
                'zona' => $row[0]
            ]);
        }
    }
}

// contacto 17-22
