<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'perfil_de_cliente'
    ];
}
