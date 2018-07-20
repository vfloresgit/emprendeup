<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Fase;

class FaseController extends Controller
{
    //
    public function registrarCantidadMeses(Request $request){
     // {"fecha_inicio_reg":"2018-02-13","fecha_inicio_eval":"2026-07-01T05:00:00.000Z"}
    	// $request->input('fecha_inicio_reg');
    	//  $endDate=Carbon::createFromDate(1995,8,18)->age;
    	// // $endDate=Carbon::createFromDate(2018);
    	// return response()->json(['msg' => 'Usuario registrado con éxito ', 'rpta' => $endDate,'success' => true], 201);
    	// $dt = Carbon::createFromDate(2018, 2, 1);
    	// echo $dt->diffForHumans($dt->copy()->addMonth());
    	// echo "<br>";
     //    echo $dt->diffForHumans($dt->copy()->subMonth()); 
		   if($request->input('fecha_fin_eval')!=null){
		           // echo "fin lleno";

		        $fechaInicioEval = Carbon::parse($request->input('fecha_inicio_eval'));
				$fechaFinEval = Carbon::parse($request->input('fecha_fin_eval'));

				echo $fechaInicioEval->day;exit;

				if(Carbon::$fechaInicioEval=>14){

				}else{

				}

				$MesesDiferencia = $fechaFinEval->diffInMonths($fechaInicioEval);

				   $AsignacionDeMeses= Fase::create([
		            'inicio' => $fechaInicioEval,
		            'cantidad_meses' => $MesesDiferencia,
		            'fin' => $fechaFinEval
		            ]);

				 return response()->json(['msg' => 'Fechas registradas exitosamente', 'rpta' => $AsignacionDeMeses,'success' => true], 201);		        

		        }else{
		           // echo "fin vacio";
		         $fechaInicioEval = Carbon::parse($request->input('fecha_inicio_eval'));

		         $AsignacionDeMeses= Fase::create([
		            'inicio' => $fechaInicioEval,
		            'cantidad_meses' => '1',
		            'fin' => $fechaInicioEval
		            ]);		         
		         return response()->json(['msg' => 'Fechas registradas exitosamente', 'rpta' => $AsignacionDeMeses,'success' => true], 201);
		        }
        }

        public function pruebaFecha(){

        	 $fechaInicioEval = Carbon::parse('2018-03-14');
        	 $sumadedias=$fechaInicioEval->addDay();
        	 echo $sumadedias;

        }

        
        

    
}
