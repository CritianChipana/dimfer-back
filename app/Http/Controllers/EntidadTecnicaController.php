<?php

namespace App\Http\Controllers;

use App\Models\EntidadTecnica;
use Illuminate\Http\Request;

class EntidadTecnicaController extends Controller
{
    public function crearEntidadTecnica(Request $request)
    {
        $entidadTecnica = new EntidadTecnica();
        $entidadTecnica->nombre = $request->nombre;
        $entidadTecnica->save();
        return response()->json($entidadTecnica, 201);
    }
}
