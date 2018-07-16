<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mes;

class MesController extends Controller
{
    //
     public function registrar(Request $request){ //no se usa
        $month = new Mes();
        $month->month_id = $request->input('month_name');
        $month->year_id = $request->input('month_number');
        $month->tipo_mes = $request->input('semester');
        $month->save();

        return response()->json(['msg' => 'Mes registrado con éxito', 'success' => true], 201);
    }

}
