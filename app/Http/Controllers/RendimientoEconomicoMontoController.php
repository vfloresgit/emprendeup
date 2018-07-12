<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RendimientoEconomicoMontoController extends Controller
{
    //
    public function registrarInicial(Request $request)
    {
        try{
            $user = User::select('fecha_inicio')->where('start_up_id',$request->header('START-UP-ID'))->first();
            $var = $user->fecha_inicio;
            $date =new DateTime($var);

            $rendimiento = new RendimientoEconomicoMonto();

            $rendimiento->facturacion = $request->input('facturacion');
            $rendimiento->month = $request->input('month');
            $rendimiento->year = $request->input('year');
            $rendimiento->facturacion2 = $request->input('facturacion2');
            switch ($request->input('month2')) {
                case 'Enero':
                $rendimiento->month2 = 1;
                break;
                case 'Febrero':
                $rendimiento->month2 = 2;
                break;
                case 'Marzo':
                $rendimiento->month2 = 3;
                break;
                case 'Abril':
                $rendimiento->month2 = 4;
                break;
                case 'Mayo':
                $rendimiento->month2 = 5;
                break;
                case 'Junio':
                $rendimiento->month2 = 6;
                break;
                case 'Julio':
                $rendimiento->month2 = 7;
                break;
                case 'Agosto':
                $rendimiento->month2 = 8;
                break;
                case 'Setiembre':
                $rendimiento->month2 = 9;
                break;
                case 'Octubre':
                $rendimiento->month2 = 10;
                break;
                case 'Noviembre':
                $rendimiento->month2 = 11;
                break;
                case 'Diciembre':
                $rendimiento->month2 = 12;
                break;
                default:
                $rendimiento->month2 = $request->input('month2');
                break;
            }

            $rendimiento->year2 = $request->input('year2');
            $rendimiento->facturacion3 = $request->input('facturacion3');

            switch ($request->input('month3')) {
                case 'Enero':
                $rendimiento->month3 = 1;
                break;
                case 'Febrero':
                $rendimiento->month3 = 2;
                break;
                case 'Marzo':
                $rendimiento->month3 = 3;
                break;
                case 'Abril':
                $rendimiento->month3 = 4;
                break;
                case 'Mayo':
                $rendimiento->month3 = 5;
                break;
                case 'Junio':
                $rendimiento->month3 = 6;
                break;
                case 'Julio':
                $rendimiento->month3 = 7;
                break;
                case 'Agosto':
                $rendimiento->month3 = 8;
                break;
                case 'Setiembre':
                $rendimiento->month3 = 9;
                break;
                case 'Octubre':
                $rendimiento->month3 = 10;
                break;
                case 'Noviembre':
                $rendimiento->month3 = 11;
                break;
                case 'Diciembre':
                $rendimiento->month3 = 12;
                break;
                default:
                $rendimiento->month3 = $request->input('month3');
                break;
            }
            $rendimiento->year3 = $request->input('year3');
            $rendimiento->facturacion4 = $request->input('facturacion4');

            switch ($request->input('month4')) {
                case 'Enero':
                $rendimiento->month4 = 1;
                break;
                case 'Febrero':
                $rendimiento->month4 = 2;
                break;
                case 'Marzo':
                $rendimiento->month4 = 3;
                break;
                case 'Abril':
                $rendimiento->month4 = 4;
                break;
                case 'Mayo':
                $rendimiento->month4 = 5;
                break;
                case 'Junio':
                $rendimiento->month4 = 6;
                break;
                case 'Julio':
                $rendimiento->month4 = 7;
                break;
                case 'Agosto':
                $rendimiento->month4 = 8;
                break;
                case 'Setiembre':
                $rendimiento->month4 = 9;
                break;
                case 'Octubre':
                $rendimiento->month4 = 10;
                break;
                case 'Noviembre':
                $rendimiento->month4 = 11;
                break;
                case 'Diciembre':
                $rendimiento->month4 = 12;
                break;
                default:
                $rendimiento->month4 = $request->input('month4');
                break;
            }
            $rendimiento->year4 = $request->input('year4');
            $rendimiento->facturacion5 = $request->input('facturacion5');
            switch ($request->input('month5')) {
                case 'Enero':
                $rendimiento->month5 = 1;
                break;
                case 'Febrero':
                $rendimiento->month5 = 2;
                break;
                case 'Marzo':
                $rendimiento->month5 = 3;
                break;
                case 'Abril':
                $rendimiento->month5 = 4;
                break;
                case 'Mayo':
                $rendimiento->month5 = 5;
                break;
                case 'Junio':
                $rendimiento->month5 = 6;
                break;
                case 'Julio':
                $rendimiento->month5 = 7;
                break;
                case 'Agosto':
                $rendimiento->month5 = 8;
                break;
                case 'Setiembre':
                $rendimiento->month5 = 9;
                break;
                case 'Octubre':
                $rendimiento->month5 = 10;
                break;
                case 'Noviembre':
                $rendimiento->month5 = 11;
                break;
                case 'Diciembre':
                $rendimiento->month5 = 12;
                break;
                default:
                $rendimiento->month5 = $request->input('month5');
                break;
            }
            $rendimiento->year5 = $request->input('year5');
            $rendimiento->facturacion6 = $request->input('facturacion6');
            switch ($request->input('month6')) {
                case 'Enero':
                $rendimiento->month6 = 1;
                break;
                case 'Febrero':
                $rendimiento->month6 = 2;
                break;
                case 'Marzo':
                $rendimiento->month6 = 3;
                break;
                case 'Abril':
                $rendimiento->month6 = 4;
                break;
                case 'Mayo':
                $rendimiento->month6 = 5;
                break;
                case 'Junio':
                $rendimiento->month6 = 6;
                break;
                case 'Julio':
                $rendimiento->month6 = 7;
                break;
                case 'Agosto':
                $rendimiento->month6 = 8;
                break;
                case 'Setiembre':
                $rendimiento->month6 = 9;
                break;
                case 'Octubre':
                $rendimiento->month6 = 10;
                break;
                case 'Noviembre':
                $rendimiento->month6 = 11;
                break;
                case 'Diciembre':
                $rendimiento->month6 = 12;
                break;
                default:
                $rendimiento->month6 = $request->input('month6');
                break;
            }
            $rendimiento->year6 = $request->input('year6');
            $rendimiento->punto_equilibrio = $request->input('punto_equilibrio');
            $rendimiento->fondos_propios = $request->input('fondos_propios');
            $rendimiento->fondos_inversionistas = $request->input('fondos_inversionistas');
            $rendimiento->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
            $rendimiento->fondos_creditos = $request->input('fondos_creditos');
            $rendimiento->inversion_privada = $request->input('inversion_privada');
            $rendimiento->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
            $rendimiento->inversiones_otros = $request->input('inversiones_otros');

            $rendimiento->start_up_id = $request->header('START-UP-ID');

            $mes = Month::where('month_number',$request->input('month'))->where('year',$request->input('year'))->first();
        // echo 'Mes:';
        // echo $mes;
            $rendimiento->month_month_id = $mes->month_id;

            $rendimiento->save();
            return response()->json(['msg' => 'Rendimiento economico monto registrada con éxito', 'success' => true,'rpta'=>$rendimiento ], 201);
        }catch(\Exception $e){
            // echo $e;
            return response()->json(['msg' => 'Error al registrar el rendimiento economico', 'success' => false], 201);
        }
        
    }
    
    public function registrar(Request $request)
    {   
        $var = getdate();
        $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
        $rendimiento = new RendimientoEconomicoMonto();
        $rendimiento->monto_compras_soles = $request->input('monto_compras_locales');
        $rendimiento->monto_compras_importación = $request->input('monto_compras_importación');
        $rendimiento->monto_impuesto_renta_3era_categoria = $request->input('monto_impuesto_renta_3era_categoria');
        $rendimiento->monto_impuesto_renta_5ta_categoria = $request->input('monto_impuesto_renta_5ta_categoria');
        $rendimiento->facturacion = $request->input('facturacion');

        $rendimiento->punto_equilibrio = $request->input('punto_equilibrio');
        $rendimiento->fondos_propios = $request->input('fondos_propios');
        $rendimiento->fondos_inversionistas = $request->input('fondos_inversionistas');
        $rendimiento->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
        $rendimiento->fondos_creditos = $request->input('fondos_creditos');
        $rendimiento->inversion_privada = $request->input('inversion_privada');
        $rendimiento->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
        $rendimiento->inversiones_otros = $request->input('inversiones_otros');
        $rendimiento->monto_compras_locales = $request->input('monto_compras_locales');
        $rendimiento->monto_compras_exportación = $request->input('monto_compras_exportación');
        $rendimiento->fase = $startUp->fase;
        $rendimiento->start_up_id = $request->header('START-UP-ID');
        
        $mes = Month::where('month_number',$var['mon'])->where('year',$var['year'])->first();
        $rendimiento->month_month_id = $mes->month_id;
        try{
            $rendimiento->save();

            return response()->json(['msg' => 'Rendimiento economico monto registrada con éxito', 'success' => true, 'rpta'=>$rendimiento], 201);
        }catch(\Exception $e){
            return response()->json(['msg' => 'Error al registrar el rendimiento economico', 'success' => false], 201);
        }

    }

    public function actualizar($id,Request $request)
    {
        $rendimiento = RendimientoEconomicoMonto::where('id',$id)->first();
        $rendimiento->monto_compras_soles = $request->input('monto_compras_locales');
        $rendimiento->monto_compras_importación = $request->input('monto_compras_importación');
        $rendimiento->monto_impuesto_renta_3era_categoria = $request->input('monto_impuesto_renta_3era_categoria');
        $rendimiento->monto_impuesto_renta_5ta_categoria = $request->input('monto_impuesto_renta_5ta_categoria');
        $rendimiento->facturacion = $request->input('facturacion');

        $rendimiento->punto_equilibrio = $request->input('punto_equilibrio');
        $rendimiento->fondos_propios = $request->input('fondos_propios');
        $rendimiento->fondos_inversionistas = $request->input('fondos_inversionistas');
        $rendimiento->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
        $rendimiento->fondos_creditos = $request->input('fondos_creditos');
        $rendimiento->inversion_privada = $request->input('inversion_privada');
        $rendimiento->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
        $rendimiento->inversiones_otros = $request->input('inversiones_otros');

        $rendimiento->update();

        return response()->json(['msg' => 'Rendimiento economico monto actualizado con éxito', 'success' => true], 201);
    }

    public function obtenerRendimientoEconomicoPorMes(Request $request){
        $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
        
        if($startUp->fase > 1){
            $rendimientosFaseAnterior = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('fase',$startUp->fase - 1)->get();
            $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('fase',$startUp->fase)->where('month_month_id',$request->header('MONTH-ID'))->first();
            $rendimientosFaseAnterior->toArray();
            for ($i=sizeof($rendimientosFaseAnterior) - 1; $i >= 0 ; $i--) {
                $rendimientoFaseAnterior = $rendimientosFaseAnterior[$i];
                // echo 'Fase Anterior:'.$rendimientoFaseAnterior;
                if ($rendimientoFaseAnterior['facturacion'] != null && $rendimientoFaseAnterior['facturacion']  != '') {
                    $i = -1;
                }
            }
            if($rendimiento['facturacion'] == ''){
                                // $rendimiento['facturacion'] = $rendimientos[$i]['facturacion'];
                $rendimiento->punto_equilibrio = $rendimientoFaseAnterior['punto_equilibrio'];
                $rendimiento->fondos_propios = $rendimientoFaseAnterior['fondos_propios'];
                $rendimiento->fondos_inversionistas = $rendimientoFaseAnterior['fondos_inversionistas'];
                $rendimiento->fondos_no_reembolsables = $rendimientoFaseAnterior['fondos_no_reembolsables'];
                $rendimiento->fondos_creditos = $rendimientoFaseAnterior['fondos_creditos'];
                $rendimiento->inversion_privada = $rendimientoFaseAnterior['inversion_privada'];
                $rendimiento->inversion_fondos_concursables = $rendimientoFaseAnterior['inversion_fondos_concursables'];
                $rendimiento->inversiones_otros = $rendimientoFaseAnterior['inversiones_otros'];
                
            }
            return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento,'form'=>$rendimiento,'success' => true], 201);                   
        } else {
            $rendimientos = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('fase',$startUp->fase)->get();
            $rendimientos->toArray();
            $rendimientoRegistroInicial = $rendimientos[0];
            for ($i=1; $i < sizeof($rendimientos); $i++) { 
             if($rendimientos[$i]['month_month_id'] == $request->header('MONTH-ID')){
                $rendimiento = $rendimientos[$i];
                if($rendimiento['facturacion'] == ''){
                    if($i == 1){
                                // $rendimiento['facturacion'] = $rendimientoRegistroInicial['facturacion'];
                        $rendimiento['punto_equilibrio'] = $rendimientoRegistroInicial['punto_equilibrio'];
                        $rendimiento['fondos_propios'] = $rendimientoRegistroInicial['fondos_propios'];
                        $rendimiento['fondos_inversionistas'] = $rendimientoRegistroInicial['fondos_inversionistas'];
                        $rendimiento['fondos_no_reembolsables'] = $rendimientoRegistroInicial['fondos_no_reembolsables'];
                        $rendimiento['fondos_creditos'] = $rendimientoRegistroInicial['fondos_creditos'];
                        $rendimiento['inversion_privada'] = $rendimientoRegistroInicial['inversion_privada'];
                        $rendimiento['inversion_fondos_concursables'] = $rendimientoRegistroInicial['inversion_fondos_concursables'];
                        $rendimiento['inversiones_otros'] = $rendimientoRegistroInicial['inversiones_otros'];
                    } else {
                                // $rendimiento['facturacion'] = $rendimientos[$i]['facturacion'];
                        $rendimiento['punto_equilibrio'] = $rendimientos[$i - 1]['punto_equilibrio'];
                        $rendimiento['fondos_propios'] = $rendimientos[$i - 1]['fondos_propios'];
                        $rendimiento['fondos_inversionistas'] = $rendimientos[$i - 1]['fondos_inversionistas'];
                        $rendimiento['fondos_no_reembolsables'] = $rendimientos[$i - 1]['fondos_no_reembolsables'];
                        $rendimiento['fondos_creditos'] = $rendimientos[$i - 1]['fondos_creditos'];
                        $rendimiento['inversion_privada'] = $rendimientos[$i - 1]['inversion_privada'];
                        $rendimiento['inversion_fondos_concursables'] = $rendimientos[$i - 1]['inversion_fondos_concursables'];
                        $rendimiento['inversiones_otros'] = $rendimientos[$i - 1]['inversiones_otros'];
                                // $rendimiento['monto_compras_locales'] = $rendimientos[$i - 1]['monto_compras_locales'];
                                // $rendimiento['monto_compras_exportación'] = $rendimientos[$i - 1]['monto_compras_exportación'];
                    }

                } 
                return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento,'form'=>$rendimiento,'success' => true], 201);                    
            } 

        }
    }
            // return response()->json(['success'=>false,'msg'=>'No se encontro data','rpta'=> [],'form'=>[]], 201);
    return response()->json([ 'success' => false ,'msg' => 'No tiene registros de rendimiento económico para esta fase','rpta'=>[],'form'=>[]], 201);
            /*if($rendimiento->count() > 1)
            {
                if($rendimiento[1]->facturacion == ""){
                    $form = $rendimiento->first();
                    $rendimiento = $rendimiento->last();
                    $form->id = $rendimiento->id;
                    return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$form,'form'=>$rendimiento,'success' => true], 201);
                } else {
                    $rendimiento = $rendimiento->last();
                    return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento,'form'=>$rendimiento,'success' => true], 201);
                }
            }
            else
            {       
                if($rendimiento[0]->facturacion == ""){
                    $form= RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('month_month_id',$request->header('MONTH-ID')-1)->where('fase',$startUp->fase)->get();
                    if(is_null($form) == false){
                        if($form->count() > 1){
                            $form = $form->last();
                            $form->id = $rendimiento[0]->id;
                            return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$form,'form'=>$rendimiento[0],'success' => true], 201);    
                        }
                        else{
                            if(is_null($form) == false){
                                if($form->count() > 0){
                                    $form[0]->id = $rendimiento[0]->id;
                                    return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$form[0],'form'=>$rendimiento[0],'success' => true], 201);
                                } else {
                                    return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento[0],'form'=>$rendimiento[0],'success' => true], 201);
                                }
                            } else {
                                return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento[0],'form'=>$rendimiento[0],'success' => true], 201);
                            }
                        }
                    } else {
                        return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento[0],'form'=>$rendimiento[0],'success' => true], 201);
                    }
                } else {
                    return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento[0],'form'=>$rendimiento[0],'success' => true], 201);
                }
            }*/
        }

        public function mostrarRendimientoEconomico(Request $request){
            $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
            $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('fase',$startUp->fase)->get();
            return response()->json(['msg' => $rendimiento, 'success' => true], 200);
        }

        public function obtenerPorStartUp($id){
            $startUp = StartUp::where('start_up_id',$id)->first();
            $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$id)->where('fase',$startUp->fase)->first();
            $form= RendimientoEconomicoMonto::select('punto_equilibrio','fondos_propios','facturacion','month','year','facturacion2','month2','year2','facturacion3','month3','year3','facturacion4','month4','year4','facturacion5','month5','year5','facturacion6','month6','year6','fondos_inversionistas','fondos_no_reembolsables','fondos_creditos','inversion_privada','inversion_fondos_concursables','inversiones_otros')->where('start_up_id', $id)->where('fase',$startUp->fase)->first();

            return response()->json(['msg' => 'Rendimiento economico obtenido con Exito', 'rpta' => $rendimiento,'form' => $form,'success' => true], 201);     
        }

        public function obtenerMontoPorStartUp($id){
            $startUp = StartUp::where('start_up_id',$id)->first();
            $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$id)->where('fase',$startUp->fase)->first();
            $form= RendimientoEconomicoMonto::select('punto_equilibrio','fondos_propios','monto_compras_soles','monto_impuesto_renta_3era_categoria','monto_impuesto_renta_5ta_categoria','facturacion','facturacion2','facturacion3','facturacion4','facturacion5','facturacion6','fondos_inversionistas','fondos_no_reembolsables','fondos_creditos','inversion_privada','inversion_fondos_concursables','inversiones_otros')->where('fase',$startUp->fase)->where('start_up_id', $id)->first();

            return response()->json(['msg' => 'Nivel Avance obtenido con Exito', 'rpta' => $rendimiento,'form' => $rendimiento,'success' => true], 201);     
        }

        public function actualizarInicial($id,Request $request)
        {
            try{
                $rendimiento = RendimientoEconomicoMonto::where('id',$id)->first();
                $rendimiento->facturacion = $request->input('facturacion');
                $rendimiento->month = $request->input('month');
                $rendimiento->year = $request->input('year');
                $rendimiento->facturacion2 = $request->input('facturacion2');
                switch ($request->input('month2')) {
                    case 'Enero':
                    $rendimiento->month2 = 1;
                    break;
                    case 'Febrero':
                    $rendimiento->month2 = 2;
                    break;
                    case 'Marzo':
                    $rendimiento->month2 = 3;
                    break;
                    case 'Abril':
                    $rendimiento->month2 = 4;
                    break;
                    case 'Mayo':
                    $rendimiento->month2 = 5;
                    break;
                    case 'Junio':
                    $rendimiento->month2 = 6;
                    break;
                    case 'Julio':
                    $rendimiento->month2 = 7;
                    break;
                    case 'Agosto':
                    $rendimiento->month2 = 8;
                    break;
                    case 'Setiembre':
                    $rendimiento->month2 = 9;
                    break;
                    case 'Octubre':
                    $rendimiento->month2 = 10;
                    break;
                    case 'Noviembre':
                    $rendimiento->month2 = 11;
                    break;
                    case 'Diciembre':
                    $rendimiento->month2 = 12;
                    break;
                    default:
                    $rendimiento->month2 = $request->input('month2');
                    break;
                }
                $rendimiento->year2 = $request->input('year2');
                $rendimiento->facturacion3 = $request->input('facturacion3');
                switch ($request->input('month3')) {
                    case 'Enero':
                    $rendimiento->month3 = 1;
                    break;
                    case 'Febrero':
                    $rendimiento->month3 = 2;
                    break;
                    case 'Marzo':
                    $rendimiento->month3 = 3;
                    break;
                    case 'Abril':
                    $rendimiento->month3 = 4;
                    break;
                    case 'Mayo':
                    $rendimiento->month3 = 5;
                    break;
                    case 'Junio':
                    $rendimiento->month3 = 6;
                    break;
                    case 'Julio':
                    $rendimiento->month3 = 7;
                    break;
                    case 'Agosto':
                    $rendimiento->month3 = 8;
                    break;
                    case 'Setiembre':
                    $rendimiento->month3 = 9;
                    break;
                    case 'Octubre':
                    $rendimiento->month3 = 10;
                    break;
                    case 'Noviembre':
                    $rendimiento->month3 = 11;
                    break;
                    case 'Diciembre':
                    $rendimiento->month3 = 12;
                    break;
                    default:
                    $rendimiento->month3 = $request->input('month3');
                    break;
                }
                $rendimiento->year3 = $request->input('year3');
                $rendimiento->facturacion4 = $request->input('facturacion4');
                switch ($request->input('month4')) {
                    case 'Enero':
                    $rendimiento->month4 = 1;
                    break;
                    case 'Febrero':
                    $rendimiento->month4 = 2;
                    break;
                    case 'Marzo':
                    $rendimiento->month4 = 3;
                    break;
                    case 'Abril':
                    $rendimiento->month4 = 4;
                    break;
                    case 'Mayo':
                    $rendimiento->month4 = 5;
                    break;
                    case 'Junio':
                    $rendimiento->month4 = 6;
                    break;
                    case 'Julio':
                    $rendimiento->month4 = 7;
                    break;
                    case 'Agosto':
                    $rendimiento->month4 = 8;
                    break;
                    case 'Setiembre':
                    $rendimiento->month4 = 9;
                    break;
                    case 'Octubre':
                    $rendimiento->month4 = 10;
                    break;
                    case 'Noviembre':
                    $rendimiento->month4 = 11;
                    break;
                    case 'Diciembre':
                    $rendimiento->month4 = 12;
                    break;
                    default:
                    $rendimiento->month4 = $request->input('month4');
                    break;
                }
                $rendimiento->year4 = $request->input('year4');
                $rendimiento->facturacion5 = $request->input('facturacion5');
                switch ($request->input('month5')) {
                    case 'Enero':
                    $rendimiento->month5 = 1;
                    break;
                    case 'Febrero':
                    $rendimiento->month5 = 2;
                    break;
                    case 'Marzo':
                    $rendimiento->month5 = 3;
                    break;
                    case 'Abril':
                    $rendimiento->month5 = 4;
                    break;
                    case 'Mayo':
                    $rendimiento->month5 = 5;
                    break;
                    case 'Junio':
                    $rendimiento->month5 = 6;
                    break;
                    case 'Julio':
                    $rendimiento->month5 = 7;
                    break;
                    case 'Agosto':
                    $rendimiento->month5 = 8;
                    break;
                    case 'Setiembre':
                    $rendimiento->month5 = 9;
                    break;
                    case 'Octubre':
                    $rendimiento->month5 = 10;
                    break;
                    case 'Noviembre':
                    $rendimiento->month5 = 11;
                    break;
                    case 'Diciembre':
                    $rendimiento->month5 = 12;
                    break;
                    default:
                    $rendimiento->month5 = $request->input('month5');
                    break;
                }
                $rendimiento->year5 = $request->input('year5');
                $rendimiento->facturacion6 = $request->input('facturacion6');
                switch ($request->input('month6')) {
                    case 'Enero':
                    $rendimiento->month6 = 1;
                    break;
                    case 'Febrero':
                    $rendimiento->month6 = 2;
                    break;
                    case 'Marzo':
                    $rendimiento->month6 = 3;
                    break;
                    case 'Abril':
                    $rendimiento->month6 = 4;
                    break;
                    case 'Mayo':
                    $rendimiento->month6 = 5;
                    break;
                    case 'Junio':
                    $rendimiento->month6 = 6;
                    break;
                    case 'Julio':
                    $rendimiento->month6 = 7;
                    break;
                    case 'Agosto':
                    $rendimiento->month6 = 8;
                    break;
                    case 'Setiembre':
                    $rendimiento->month6 = 9;
                    break;
                    case 'Octubre':
                    $rendimiento->month6 = 10;
                    break;
                    case 'Noviembre':
                    $rendimiento->month6 = 11;
                    break;
                    case 'Diciembre':
                    $rendimiento->month6 = 12;
                    break;
                    default:
                    $rendimiento->month6 = $request->input('month6');
                    break;
                }
                $rendimiento->year6 = $request->input('year6');
                $rendimiento->punto_equilibrio = $request->input('punto_equilibrio');
                $rendimiento->fondos_propios = $request->input('fondos_propios');
                $rendimiento->fondos_inversionistas = $request->input('fondos_inversionistas');
                $rendimiento->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
                $rendimiento->fondos_creditos = $request->input('fondos_creditos');
                $rendimiento->inversion_privada = $request->input('inversion_privada');
                $rendimiento->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
                $rendimiento->inversiones_otros = $request->input('inversiones_otros');

                $mes = Month::where('month_number',$request->input('month'))->where('year',$request->input('year'))->first();
                $rendimiento->month_month_id = $mes->month_id;

                $rendimiento->update();

                $form= RendimientoEconomicoMonto::select('punto_equilibrio','fondos_propios','facturacion','month','year','facturacion2','month2','year2','facturacion3','month3','year3','facturacion4','month4','year4','facturacion5','month5','year5','facturacion6','month6','year6','fondos_inversionistas','fondos_no_reembolsables','fondos_creditos','inversion_privada','inversion_fondos_concursables','inversiones_otros')->where('id', $id)->first();

                return response()->json(['msg' => 'Rendimiento economico actualizado con éxito','rpta' => $rendimiento,'form' => $form ,'success' => true], 201);
            }catch(\Exception $e){
                return response()->json(['msg' => 'Error al actualizar el Rendimiento economico','success' => false], 201);
            }

        }

        public function reporteGraficoFacturacion(Request $request){

            $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
            $user = User::where('start_up_id',$request->header('START-UP-ID'))->first();
            $var = $user->fecha_inicio;
            $date =new DateTime($var);
            if ($date->format('d') <= 15) {
                $mes = Month::where('month_number',$date->format('m'))->where('year',$date->format('Y'))->first();
            } else {
                if($date->format('m') == 12){
                    $mes = Month::where('month_number',1)->where('year',$date->format('Y')+1)->first();
                } else {
                    $mes = Month::where('month_number',$date->format('m') + 1)->where('year',$date->format('Y'))->first();
                }

            }  
            $listaMes = Month::select('month_id')->where('month_id','>=',$mes->month_id)->limit($startUp->tiempo)->get();
            $i = 0;
            foreach($listaMes->pluck('month_id') as $a){
                $x = Month::where('month_id',$a)->first();
                $listaMes[$i]['titulo'] = $x->month_name.' '.$x->year;
                $i++;
            }

            $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('fase',$startUp->fase)->get();
            if ($startUp->fase == 1) {
                $rendimiento->shift();
            }

            $facturacion = $rendimiento->pluck('facturacion');

            return response()->json(['rpta' => $facturacion ,'labels'=>$listaMes->pluck('titulo'),'success' => true], 201);

        }

        public function actualizarEnEvaluacion($id,Request $request)
        {
            $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
            $rendimiento = RendimientoEconomicoMonto::where('id',$id)->first();
            $rendimiento->monto_compras_soles = $request->input('monto_compras_locales');
            $rendimiento->monto_compras_importación = $request->input('monto_compras_importación');
            $rendimiento->monto_impuesto_renta_3era_categoria = $request->input('monto_impuesto_renta_3era_categoria');
            $rendimiento->monto_impuesto_renta_5ta_categoria = $request->input('monto_impuesto_renta_5ta_categoria');
            $rendimiento->facturacion = $request->input('facturacion');
            $rendimiento->punto_equilibrio = $request->input('punto_equilibrio');
            $rendimiento->fondos_propios = $request->input('fondos_propios');
            $rendimiento->fondos_inversionistas = $request->input('fondos_inversionistas');
            $rendimiento->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
            $rendimiento->fondos_creditos = $request->input('fondos_creditos');
            $rendimiento->inversion_privada = $request->input('inversion_privada');
            $rendimiento->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
            $rendimiento->inversiones_otros = $request->input('inversiones_otros');
        // $rendimiento->monto_compras_locales = $request->input('monto_compras_locales');
        // $rendimiento->monto_compras_exportación = $request->input('monto_compras_exportación');
/*
        //llenando tabla del siguiente mes
        $rendimientoSiguiente = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('month_month_id',$request->header('MONTH-ID')+1)->where('fase',$startUp->fase)->first();
        if($rendimientoSiguiente != null && $rendimientoSiguiente->facturacion == NULL){
        $rendimientoSiguiente->monto_compras_soles = $request->input('monto_compras_soles');
        $rendimientoSiguiente->monto_impuesto_renta_3era_categoria = $request->input('monto_impuesto_renta_3era_categoria');
        $rendimientoSiguiente->monto_impuesto_renta_5ta_categoria = $request->input('monto_impuesto_renta_5ta_categoria');
        $rendimientoSiguiente->facturacion = $request->input('facturacion');
        $rendimientoSiguiente->punto_equilibrio = $request->input('punto_equilibrio');
        $rendimientoSiguiente->fondos_propios = $request->input('fondos_propios');
        $rendimientoSiguiente->fondos_inversionistas = $request->input('fondos_inversionistas');
        $rendimientoSiguiente->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
        $rendimientoSiguiente->fondos_creditos = $request->input('fondos_creditos');
        $rendimientoSiguiente->inversion_privada = $request->input('inversion_privada');
        $rendimientoSiguiente->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
        $rendimientoSiguiente->inversiones_otros = $request->input('inversiones_otros');
        $rendimientoSiguiente->update(); }
*/

        //llenando tabla general para reporte en PoweBI
        $general = Empleo::where('start_up_id',$request->header('START-UP-ID'))->where('month_month_id',$request->header('MONTH-ID'))->where('fase',$startUp->fase)->first();
        $general->monto_compras_soles = $request->input('monto_compras_locales');
        $general->monto_impuesto_renta_3era_categoria = $request->input('monto_impuesto_renta_3era_categoria');
        $general->monto_impuesto_renta_5ta_categoria = $request->input('monto_impuesto_renta_5ta_categoria');
        $general->facturacion = $request->input('facturacion');
        $general->fondos_propios = $request->input('fondos_propios');
        $general->fondos_inversionistas = $request->input('fondos_inversionistas');
        $general->fondos_no_reembolsables = $request->input('fondos_no_reembolsables');
        $general->fondos_creditos = $request->input('fondos_creditos');
        $general->inversion_privada = $request->input('inversion_privada');
        $general->inversion_fondos_concursables = $request->input('inversion_fondos_concursables');
        $general->inversiones_otros = $request->input('inversiones_otros');

        try{
            $general->update();
            $rendimiento->update();

            return response()->json(['msg' => 'Rendimiento economico monto actualizado con éxito','success' => true], 201);
        }catch(\Exception $e){
            return response()->json(['msg' => 'Error al actualizar el rendimiento economico','success' => false], 201);
        }
        
    }

    public function obtenerRendimientoEconomicoPorMesPorFase(Request $request){
        $startUp = StartUp::where('start_up_id',$request->header('START-UP-ID'))->first();
        $rendimiento = RendimientoEconomicoMonto::where('start_up_id',$request->header('START-UP-ID'))->where('month_month_id',$request->header('MONTH-ID'))->where('fase',$request->header('FASE-ID'))->get();
        $form= RendimientoEconomicoMonto::select('punto_equilibrio','fondos_propios','facturacion','monto_compras_soles','monto_impuesto_renta_3era_categoria','monto_impuesto_renta_5ta_categoria','fondos_inversionistas','fondos_no_reembolsables','fondos_creditos','inversion_privada','inversion_fondos_concursables','inversiones_otros')->where('start_up_id',$request->header('START-UP-ID'))->where('month_month_id',$request->header('MONTH-ID'))->where('fase',$request->header('FASE-ID'))->get();

        if($rendimiento->count() > 1 && $form->count() > 1)
        {
            $rendimiento = $rendimiento->last();
            $form = $form->last();
            return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento,'form'=>$rendimiento,'success' => true], 201);
        }
        else
        {       
            return response()->json(['msg' => 'Registro obtenido con éxito','rpta'=>$rendimiento[0],'form'=>$rendimiento[0],'success' => true], 201);
        }
    }
}
