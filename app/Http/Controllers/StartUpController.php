<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StartUp;
use App\User;
use App\NivelAvance;
class StartUpController extends Controller
{
    //
    

    public function exportById($id){
        // $startUp = StartUp::join('departamentos','startup.departamento_id','=','departamentos.id')->join('provincias','startup.province_id','=','provincias.id')->join('distritos','startup.district_id','=','distritos.id')->join('meses','meses.startup_id','=','startup.id')->join('fase','meses.fase_id','=','fase.id')->select('startup.id','startup.name','startup.foundation_year as Año de Fundación','startup.email as Correo Electrónico','startup.phone as Teléfono','startup.web_page as Página Web','startup.industry_sector as Sector Industrial','startup.especificar','startup.product_type as Tipo de Producto','startup.product_details as Detalles del producto','departamentos.nombre as Región','provincias.nombre as Provincia','distritos.nombre as Distrito','startup.tiempo as Meses a Evaluar','fase.inicio as Fase','startup.pasos as Pasos')->where('startup.id','=',$id)->first();
        //  $incubado = User::where('start_up_id',$id)->first();
        //  $hoy = getDate();
        //  if($startUp['pasos'] == 6){
        //      Excel::create('Startup '.$startUp['name'].'-'.$hoy[0], function($excel) use ($startUp){
        //          $excel->setTitle('Our new awesome title');
        //            $excel->setCreator('Maatwebsite')
        //               ->setCompany('Maatwebsite');
        //                $excel->setDescription('A demonstration to change the file properties');
        //                 $excel->sheet('Registro Inicial', function($sheet)  use ($startUp) {
        //                      if($startUp['Sector Industrial'] == 'Otros: especificar'){
        //                 $startUp['Sector Industrial'] = $startUp['especificar'];
        //                      }
        //                 if($startUp['Meses a Evaluar'] == '' ||  is_null($startUp['Meses a Evaluar'])){
        //                 $startUp['Meses a Evaluar'] = 0;
        //                 }
        //                 $posicionInicio = 2;
        //                 $posicionInicioFin = 3;
        //                 $registroInicial = $this->llenarStartUp($startUp);
        //                 if ($registroInicial != null) {
        //                         $posicionStartUp = $posicionInicioFin + 1;
        //                         $posicionStartUpFin = $posicionStartUp + 9;
        //                         $posicionNivelAvance = $posicionStartUpFin + 1;
        //                         $posicionNivelAvanceFin = $posicionNivelAvance + 1;
        //                 $registroInicial = $this->llenarNivelAvance($registroInicial,$startUp);
        //                   if ($registroInicial[sizeof($registroInicial) - 2][2] != 'Sin Registrar') {
        //                      $posicionFundadores = $posicionNivelAvanceFin + 3;
        //                   } else {
        //                     $posicionFundadores = $posicionNivelAvanceFin + 1;
        //                   }
        //                 $posicionFundadoresFin = $posicionFundadores + 1;
        //                 $posicionFundadoresContenido = $posicionFundadoresFin;
        //                 $fundadores = $this->llenarFundadores($registroInicial,$startUp);

        
    }

    public function llenarStartUp($startUp){
        if ($startUp != null) {
            return 
            array(
                    array('CODIGO DE REGISTRO DE LA STARTUP','UP'.$startUp['start_up_id']),
                    array('',''),//Salto de linea
                    array('Nombre',$startUp['name']),
                    array('Fase', $startUp['Fase']),
                    array('Año de Fundación',$startUp['Año de Fundación']),
                    array('Correo Electrónico',$startUp['Correo Electrónico']),
                    array('Teléfono',$startUp['Teléfono']),
                    array('Página Web',$startUp['Página Web']),
                    array('Industria/Sector',$startUp['Sector Industrial']),
                    array('Producto/Tipo',$startUp['Tipo de Producto']),
                    array('Detalles del producto:',$startUp['Detalles del producto']),
                    array('','')
            ); 
        }else{
            return null;
        }
    }

    public function llenarNivelAvance($registroInicial,$startUp){
        $nivelAvance = NivelAvance::where('start_up_id',$startUp->start_up_id)->where('fase',$startUp['Fase'])->first();
        if ($nivelAvance != null) {
            $registroInicial[] = array('Desarrollo del Negocio: Nivel de Avance');
            $registroInicial[] = array('MVP(Producto Mínimo Viable)','Product/market','Escalamiento');
            if ($nivelAvance->escalamiento == 1) {
                // $registroInicial = array_add($registroInicial,sizeof($registroInicial),array('Nivel de Avance:','Escalamiento'));
                // $registroInicial[] = array('Prueba Escalamiento:','Pudo concatenar');
                $registroInicial[] = array('','','X');
            } elseif ($nivelAvance->product_min_viable == 1) {
                // $registroInicial = array_add($registroInicial,sizeof($registroInicial),array('Nivel de Avance:','Producto Mínimo Viable'));
                // $registroInicial[] = array('Prueba Product:','Pudo concatenar');
                $registroInicial[] = array('X','','');
            } else {
                // $registroInicial = array_add($registroInicial,sizeof($registroInicial),array('Nivel de Avance:','Product Market Fit'));
                $registroInicial[] = array('','X','');
            }
        } else {
            $registroInicial[] = array('Nivel de Avance:','','Sin Registrar');
        }
        $registroInicial[] = array('','');
        return $registroInicial;
    }

    public function llenarFundadores($registroInicial,$startUp){
        $founders = Founder::select(
            'name as Nombre',
            'genre as Género',
            'email as Correo Electrónico',
            'phone as Teléfono',
            'dob as Fecha de nacimiento'
        )->where('start_up_id',$startUp['start_up_id'])->get();
        if (sizeof($founders) > 0) {
            // echo 'Fundadores:'.sizeof($founders);
            $registroInicial[] = array('Fundadores','',sizeof($founders));
            $nombresFundadores = array('Nombre');
            $generosFundadores = array('Género');
            $emailsFundadores = array('Correo Electrónico');
            $phoneFundadores = array('Teléfono');
            $dobFundadores = [];
            $dobFundadores[] = 'Fecha de nacimiento';
            foreach ($founders as $founder) {
                $nombresFundadores[] = $founder['Nombre'];
                $generosFundadores[] = $founder['Género'];
                $emailsFundadores[] = $founder['Correo Electrónico'];
                $phoneFundadores[] = $founder['Teléfono'];
                $dobFundadores[] = $founder['Fecha de nacimiento'];
            }
            $registroInicial[] = $nombresFundadores;
            $registroInicial[] = $generosFundadores;
            $registroInicial[] = $emailsFundadores;
            $registroInicial[] = $phoneFundadores;
            $registroInicial[] = $dobFundadores;
        } else {
            $registroInicial[] = array('Fundadores','','Fundadores no registrados');
        }
        $registroInicial[] = array('','');
        $cantidad = sizeof($founders);
        return [$registroInicial,$cantidad];
    }

    public function editar($id,Request $request)
    {
        $startUp = StartUp::where('id', $id)->first();
        $startUp->name = $request->input('name');
        $startUp->foundation_year = $request->input('foundation_year');
        $startUp->email = $request->input('email');
        $startUp->phone = $request->input('phone');
        $startUp->web_page = $request->input('web_page');
        $startUp->industry_sector = $request->input('industry_sector');
        $startUp->especificar = $request->input('especificar');
        $startUp->product_type = $request->input('product_type');
        $startUp->product_details = $request->input('product_details');
        $startUp->departamento_id = $request->input('region');
        $startUp->province_id = $request->input('province');
        $startUp->district_id = $request->input('district');
        /*$startUp->region_name = $request->input('region.name');
        $startUp->province_name = $request->input('province.name');
        $startUp->district_name = $request->input('district.name');
        $startUp->category = $request->input('category');*/
        try{
            $startUp->update();
            return response()->json(['msg' => 'Start Up actualizado con éxito' ,'success' => true, 'rpta' => $startUp], 201);
        }catch(\Exception $e){
            return response()->json(['msg' => 'Error al actualizar datos de la Start Up' ,'success' => false], 201);
        }
    }


     public function registrar(Request $request)
     {
        try{
            $startUp = new StartUp();
            $startUp->name = $request->input('name');
            $startUp->foundation_year = $request->input('foundation_year');
            $startUp->email = $request->input('email');
            $startUp->phone = $request->input('phone');
            $startUp->web_page = $request->input('web_page');
            $startUp->industry_sector = $request->input('industry_sector');
            $startUp->especificar = $request->input('especificar');
            $startUp->product_type = $request->input('product_type');
            $startUp->product_details = $request->input('product_details');
            $startUp->departamento_id = $request->input('region');
            $startUp->province_id = $request->input('province');
            $startUp->district_id = $request->input('district');
            /*$startUp->region_name = $request->input('region.name');
            $startUp->province_name = $request->input('province.name');
            $startUp->district_name = $request->input('district.name');*/

                // $startUp->save();
                
                // $user = new User();
                // $user = User::find($request->header('USER-ID'));
                // //$user->pasos = 2;
                // //$user->paso1 = true;
                // $user->start_up_id = $startUp->start_up_id;
                // $user->save();

        return response()->json(['msg' => 'Start Up registrada con éxito', 'success' => true, 'rpta' => $startUp], 201);
            } catch(\Exception $e){
                return response()->json(['msg' => 'Error al registrar la Start Up', 'success' => false], 201);
            }
 
     }


}
