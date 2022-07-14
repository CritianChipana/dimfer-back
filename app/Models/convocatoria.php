<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "cantidad_de_entidades_tecnicas",
        "cantidad_de_modulos_registrados",
        "cantidad_de_modulos_licitados",
        "cantidad_de_modulos_ganados",
        "porcentaje_cantidad_de_modulos_participados",
        "porcentaje_cantidad_de_modulos_eficacia",
        "estado",
    ];
}
