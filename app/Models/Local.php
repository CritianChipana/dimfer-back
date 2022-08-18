<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    // relacion inversa de uno a muchos
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
    
}
