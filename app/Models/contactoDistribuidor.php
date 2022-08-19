<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactoDistribuidor extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "telefono",
        "telefono2",
        "direccion",
        "email",
        "email2",
        "cargo",
        "cliente_id"
    ];
}
