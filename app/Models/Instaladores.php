<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instaladores extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'dni',
        'especializacion',
        'foto',
        'celular',
        'correo',
    ];
}
