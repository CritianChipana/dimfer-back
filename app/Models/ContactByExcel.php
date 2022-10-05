<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactByExcel extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "empresa",
        "telefono",
        "telefono2",
        "email",
        "email2",
        "cargo",
        "direccion",
        "modulo"
    ];

}
