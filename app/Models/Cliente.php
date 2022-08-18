<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_comercial',
        'ubicacion',
        'departamento',
        'provincia',
        'tipo_de_cliente',
        'canales_de_venta',
        'razon_social',
        'email_user',
        'ruc',
        'tipo_de_tienda',
        'perfil_de_cliente',
        'n_tienda',
        'activo',
        'logo',
        'latitud',
        'longitud',
        'productos',
        'exhibidor',
        'remoledar_exhibidor',
        'foto_local',
        'tiene_material',
        'redes_sociales',
        'web',
        'link_facebook',
        'direccion_cliente',
        'ubicacion_de_maps',
    ];

    //relacion uno a muchos
    public function locales()
    {
        return $this->hasMany('App\Models\Local');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Models\ClienteComentario');
    }
    
}
