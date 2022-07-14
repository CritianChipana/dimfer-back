<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negociacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "fecha_de_facturacion",
        "monto_en_soles",
        "convocatoria",
        "departamento_de_despacho",
        "entidad_tecnica",
        "estado_de_negociacion",
        "etapa_de_contratacion",
        "gano_entidad_tecnica",
        "incluye_puerta_principal",
        "perdio_entidad_tecnica",
        "porcentaje_de_cierre"
    ];
}
