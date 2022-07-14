<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadTecnica extends Model
{
    use HasFactory;

    protected $fillable = [
        'departamento_fiscal',
        'departamento_real',
        'direccion_fiscal',
        'latitud_fiscal_gps',
        'longitud_fiscal_gps',
        'direccion_real',
        'latitud_real_gps',
        'longitud_real_gps',
        'email_user',
        'estado',
        'foto_direccion_fiscal',
        'foto_direccion_real',
        'medio_de_contacto',
        'proveedor_actual',
        'provincia_fiscal',
        'provincia_real',
        'razon_social',
        'representante_legal',
        'ruc',
        'tiene_grupo',
        'tipo_de_cliente',
        'tipo_de_construccion',
        'verificado_direccion_fiscal_gps',
        'verificado_direccion_real_gps',
        'vigencia',
        'zona',
    ];
}
