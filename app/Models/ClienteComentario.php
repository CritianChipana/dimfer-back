<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteComentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'comentario',
        'cliente_id',
        'email_user',
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}
