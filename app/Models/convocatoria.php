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
    // relacion muchos a muchos
    public function entidadesTecnicas()
    {
        return $this->belongsToMany('App\Models\EntidadTecnica')->withPivot('cantidad_de_modulos', 
        'created_at', 
        'id',
        'fecha_de_facturacion',
        'monto_en_soles',
        'convocatoria',
        'departamento_de_despacho',
        'entidad_tecnica',
        'estado_de_negociacion',
        'etapa_de_contratacion',
        'gano_entidad_tecnica',
        'incluye_puerta_principal',
        'perdio_entidad_tecnica',
        'porcentaje_de_cierre',);
        
        // return $this->belongsToMany(EntidadTecnica::class);
    }

    public function entidadesTecnicasSinRelacion()
    {
        return $this->belongsToMany('App\Models\EntidadTecnica')->wherePivotNull('cantidad_de_modulos', 
        // 'created_at', 
        // 'id',
        // 'fecha_de_facturacion',
        // 'monto_en_soles',
        // 'convocatoria',
        // 'departamento_de_despacho',
        // 'entidad_tecnica',
        // 'estado_de_negociacion',
        // 'etapa_de_contratacion',
        // 'gano_entidad_tecnica',
        // 'incluye_puerta_principal',
        // 'perdio_entidad_tecnica',
        // 'porcentaje_de_cierre'
    );
        
        // return $this->belongsToMany(EntidadTecnica::class);
    }
}
