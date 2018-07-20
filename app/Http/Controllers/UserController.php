<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StartUp;
use App\Persona;
use App\Servicio;
use Illuminate\Support\Facades\Hash;
use App\Mail\CambioContrasena\CambioContrasenaAdministrador;
use Illuminate\Support\Facades\Log;
use Mail;
use App\UserEspecialidad;
use DateTime;
use DB;

class UserController extends Controller
{
    //

    public function listar(){
    $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.category','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[0,1,2])->get();

     for ($i=0; $i < $user->count(); $i++) {
     	 $var = $user[$i]["Fecha de nacimiento"];
          $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
     }
     return response()->json(['rpta' => $user , 'success' => true], 201);
    }

    public function listarActivos(){
      $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.category','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[1])->get();
         for ($i=0; $i < $user->count(); $i++) {
         $var = $user[$i]["Fecha de nacimiento"];
          $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
         }
         return response()->json(['rpta' => $user , 'success' => true], 201);
    }

    public function listarInactivos(){    
      $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.category','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[0])->get();
      for ($i=0; $i < $user->count(); $i++) {
         $var = $user[$i]["Fecha de nacimiento"];
          $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
     }
     return response()->json(['rpta' => $user , 'success' => true], 201);
    }


    public function cambiarPassword($id,Request $request){

      $user = User::where('user_id',$id)->first();
      $user->password = bcrypt($request->input('password'));

     try{
      $user->update();
            if ($user->category != null && app('env') == 'prod' ) {
                if($user->category == 1){                	
                    // Mail::to($user->email)->send(new CambioContrasenaAdministrador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new CambioContrasenaAdministrador($user,$request->input('password'),$request->header('URL')));
                } else if($user->category == 2 ){
                    // Mail::to($user->email)->send(new CambioContrasenaEvaluador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new CambioContrasenaEvaluador($user,$request->input('password'),$request->header('URL')));
                } else if($user->category > 2) { // $user->category == 3 || $user->category == 4 || $user->category == 5 || $user->category == 6
                    // Mail::to($user->email)->send(new CambioContrasenaIncubado($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new CambioContrasenaIncubado($user,$request->input('password'),$request->header('URL')));
                }
            }
          return response()->json(['msg' => 'Contraseña cambiada' , 'success' => true, 'rpta'=> ''], 201);
    }catch(\Exception $e){
       return response()->json(['msg' => 'Error:'.$e->getMessage() , 'success' => false], 500);
        }
    }
    
    public function cambiarEstado($id,Request $request){
        $user = User::where('user_id', $id)->first();
        $user->activity = $request->input('activity');
        $user->update();

        if($user->start_up_id != null){
            $startUp = StartUp::where('id',$user->start_up_id)->first();
            $startUp->activity = $request->input('activity');
            $startUp->update();
        }
        switch ($request->input('activity')){
            case '1':
                return response()->json(['msg' => 'Usuario habilitado', 'success' => true ], 201);
                break;
            
            case '0':
                return response()->json(['msg' => 'Usuario deshabilitado', 'success' => true ], 201);
                break;
            
            case '3':
                return response()->json(['msg' => 'Usuario eliminado', 'success' => true ], 201);
                break;
            }
     
     }

     public function registrar(Request $request){
       try{       
        $soporte = 'soporte@disnovo.com';   
        $personaname = $request->input('name');
        $user_password = bcrypt($request->input('register_password'));
        $user_email = $request->input('email');
        $personaphone = $request->input('phone');
        $personagenre = $request->input('genre');
        $personadob = $request->input('dob');

        if ($request->input('category') == 3){
            if($request->input('sub_category') == null || $request->input('sub_category') == '' || $request->input('sub_category') == -1){
                    $user_category = $request->input('category') + 0;
                // return response()->json(['msg' => 'No se pudo crear el usuario incubado falta asignarle su subcategoria','success' => false], 201);
            }else {
                    $user_category = $request->input('category') + $request->input('sub_category');
         }                
         $startup_fecha_inicio = $request->input('fecha_inicio');//Solo aparecera el campo si en categoria se escoje incubado
         $startup_fecha_inicio_historico = $request->input('fecha_inicio');

                $date =new DateTime($startup_fecha_inicio);
                if($date != null && $date->format('Y') < 2012){
                    return response()->json(['msg' => 'La fecha de inicio no puede ser menor al 2012','success' => false, 'rpta'=>''], 201);
                }else{
                    if ($user_category != null && app('env') == 'prod') {
                        // Mail::to($user->email)->send(new RegistroIncubado($user,$request->input('password'),$request->header('URL')));
                        // Mail::to($soporte)->send(new RegistroIncubado($user,$request->input('password'),$request->header('URL')));
                    }
                }


           $personaid=Persona::create([
            'name' => $personaname,
            'phone' => $personaphone,
            'genre' => $personagenre,
            'dob' =>  $personadob,
            ]);           
            $startupid=StartUp::create([
            'fecha_inicio'=> $startup_fecha_inicio,
            'fecha_inicio_historico'=> $startup_fecha_inicio_historico,
            ]);

            $user_persona_id=$personaid->person_id;
            $user_start_up_id=$startupid->id;
            
            $user=User::create([
            'email'=> $user_email,
            'password'=> $user_password,           
           
            'start_up_id'=> $user_start_up_id,
            'persona_id'=> $user_persona_id,
            'category'=> $user_category,            
            ]);

           }else if($request->input('category')==2){
                $user_category= $request->input('category');
                if ($request->input('especialidades') != null) {

                    $user_especialidades = $request->input('especialidades');
               
                     $personaid=Persona::create([
                      'name' => $personaname,
                      'phone' => $personaphone,
                      'genre' => $personagenre,
                      'dob' =>  $personadob,
                      ]);

                      $user_persona_id=$personaid->person_id;                

                      
                      $user=User::create([
                      'email'=> $user_email,
                      'password'=> $user_password,           
                      'persona_id'=> $user_persona_id,
                       'category'=> $user_category,
                      
                      ]);
                      $userid=$user->user_id;

                      for ($i=0;$i<count($user_especialidades);$i++){                 
                         UserEspecialidad::create([
                            'user_id' => $userid,
                            'idespecialidad' => $user_especialidades[$i],                
                      ]);
                 }
            }
              
            if ($user_category != null && app('env') == 'prod') {
                    // Mail::to($user->email)->send(new RegistroEvaluador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new RegistroEvaluador($user,$request->input('password'),$request->header('URL')));
            }
          }else{

            $user_category = $request->input('category');
                // Mail::to($user->email)->send(new RegistroAdministrador($user,$request->input('password'),$request->header('URL')));
                // Mail::to($soporte)->send(new RegistroAdministrador($user,$request->input('password'),$request->header('URL')));
            $personaid=Persona::create([
            'name' => $personaname,
            'phone' => $personaphone,
            'genre' => $personagenre,
            'dob' =>  $personadob,
            ]);           

            $user_persona_id=$personaid->person_id;     
            
            $user=User::create([
            'email'=> $user_email,
            'password'=> $user_password,           
            'persona_id'=> $user_persona_id,
             'category'=> $user_category,
            
            ]);   
            

          }
            //$persona->save();
            // $Idpersona=DB::table('personas')->insertGetId(['name'=>$persona->name,'phone'=>$persona->phone,'genre'=>$persona->genre,'dob'=>$persona->dob],,'person_id');
        
                  

        return response()->json(['msg' => 'Usuario registrado con éxito ', 'rpta' => $user,'success' => true], 201);

        }catch(\Exception $e){

          echo $e->getMessage();
            if ($e->errorInfo[1] == '1062' ) //Para duplicados y 1048 al haber un error en el nombre de la columna a insertar
            {
                $error = 'Error, la cuenta de usuario ya existe';
                return response()->json(['msg' => $error,'success' => false], 201);
            }
            
            Log::info('Error '.$e->getMessage());
            return response()->json(['msg' => 'No se pudo crear el usuario','success' => false], 201);

         }
    }


    public function actualizar($id,Request $request)
    {

        try{
    		$user = User::where('user_id', $id)->first();
            
            $persona=Persona::where('person_id',$user->persona_id)->first();

            $user->email = $request->input('email');

            $persona->name = $request->input('name');
            $persona->phone = $request->input('phone');
            $persona->genre = $request->input('genre');
            $persona->dob = $request->input('dob');

            $user->category = $request->input('category');

            if ($request->input('fecha_inicio') != null) {
                $fecha_inicio= $request->input('fecha_inicio'); //Solo aparecera el campo si en categoria se escoje incubado
                if( $fecha_inicio != null){
                    $startup=new StartUp();
                    // $user->fecha_inicio = $fecha_inicio;
                    $startup->fecha_inicio=$fecha_inicio;
                }
            }
            if ($request->input('especialidades') != null) {
               

                // $user->especialidades = implode(",",$request->input('especialidades'));
                // $user->especialidades = implode(",",$request->input('especialidades')); //script
            
              $especialidadesevaluador=$request->input('especialidades');
               
         

              for ($i=0; $i <count($especialidadesevaluador); $i++) { 
                

                UserEspecialidad::create([
                  'user_id' => $user->user_id,
                  'idespecialidad' => $especialidadesevaluador[$i],                
                ]);

              
              }

            }

        $user->update();
        $persona->update();
        return response()->json(['msg' => 'Usuario actualizado con éxito', 'success' => true, 'rpta'=> ''], 201);

    	 }catch(\Exception $e){
            return response()->json(['msg' => 'Error al actualizar datos del usuario '.$e, 'success' => false], 201);
    	}      

    }
    public function listarIncubados(){

      $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.category','=','rol.idroles')->select('stup.name as StartUp ','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[0,1,2])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));            
        }       

        return response()->json(['rpta'=> $user, 'success' => true],200);        
    }

     public function listarIncubadosActivos(){

       $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.category','=','rol.idroles')->select('stup.name as StartUp','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[1])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
            
        }       
        return response()->json(['rpta'=> $user, 'success' => true],200);  
    }

     public function listarIncubadosInactivos(){

      $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.category','=','rol.idroles')->select('stup.name as StartUp','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[0])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
            
        }       
        return response()->json(['rpta'=> $user, 'success' => true],200);  
    }


    public function login(Request $request)
    {

        $user = User::where('email', $request->input('email'))->first();
        // $user = User::join('','','','');

        $sidebar1 = '';
        $sidebar2='';
        $sidebar3='';
        
        if ($user != null)
        {
            if($user->activity !== 1){
                return response()->json(['msg' => 'Este usuario se encuentra inactivo' , 'rpta' =>null ,'success' => false ], 200);
            } else {

                if (Hash::check($request->input('password'), $user->password )) {
                    /*if($user->category == 1){
                    Mail::send(['text'=>'mail'],['name','Administración Emprende UP'],function($message){
                        $message->to($user->email,$user->name)->subject('Notificación');
                        $message->from('[correo-electronico]','AdminUP');
                    } );
                }*/
                if($user->category > 2) {
                       // echo 'Entro a usuario de tipo incubado';
                    // $startUp = StartUp::where('id',$user->start_up_id)->first();                    
                    $startUp = StartUp::join('meses','startup.id','=','meses.startup_id')->join('fase','meses.fase_id','=','fase_id')->where()->get();

                    if($startUp != null){
                            //echo 'Tiene registrada una startup';
                        // $user['cambio_fase'] = $startUp->cambio_fase;

                        $user['fase'] = $startUp->nombre;

                        $evaluacionesActivadas = DB::table('aspectos')
                        ->join('evaluacion_aspectos', function($join){
                            $join->on('aspectos.idaspectos','=','evaluacion_aspectos.aspectos_idaspectos')
                            ->join('meses','evaluacion_aspectos.meses_id','=','meses.idmes');
                            }
                        )
                        ->select(
                            'evaluacion_aspectos.porcentaje as porcentaje',
                            'meses.month_id as month',
                            'meses.startup_id as start_up_id',
                            'meses.fase as fase'
                         )
                        ->where('meses.start_up_id','=',$user->start_up_id)
                        ->where('meses.fase','=',$startUp->fase)
                        ->distinct()
                        ->get();

                        $evaluacionesEvaluadas = $evaluacionesActivadas->where('porcentaje','<>',0);
                        
                        $cantidadEvaluacionesActivadas = sizeof(json_decode($evaluacionesActivadas,true));
                        $cantidadEvaluacionesEvaluadas = sizeof(json_decode($evaluacionesEvaluadas,true));
                            // echo '******************* Evaluaciones Activadas *******************';
                            // echo $evaluacionesActivadas;
                            // echo '**************************************************************';
                            // echo '******************* Cantidad de Evaluaciones Activadas *******************';
                            // echo $cantidadEvaluacionesActivadas;
                            // echo '**************************************************************';
                            // echo '******************* Cantidad de Evaluaciones Evaluadas *******************';
                            // echo $cantidadEvaluacionesEvaluadas;
                            // echo '**************************************************************';
                        $notificacion = 'No olvide registrar la información correspondiente para los formularios';
                            //echo 'Sin problemas al traer evaluaciones';
                        if($cantidadEvaluacionesActivadas >  $cantidadEvaluacionesEvaluadas){
                            $notificacion = $notificacion.' de evaluacion';
                                //echo 'Le faltan completar evaluaciones';


                            $indicadoresActivados = DB::table('rendimientos_economico_montos')
                            ->join('meses', function($join){
                                    //echo '***********Entro a empleos creado empleados*********';
                                $join->on('rendimientos_economico_montos.meses_id','=','meses.idmes')
                                ->where('meses.estado_activo','=',1);
                            })
                            ->join('empleados', function($join){
                                $join->on('meses.idmes','=','empleados.meses_id')
                                ->where('empleados.estado_activo','=', 1);
                            })
                            ->select(
                                'meses.month_id as month_month_id',
                                'meses.startup_id as rend_start_up_id',
                                'empleados.tiempo_parcial as emp_hombres_tiempo_parcial'                       
                            )
                            ->where('meses.startup_id','=',$user->start_up_id)
                            ->where('rendimientos_economico_montos.fase','=',$startUp->fase)
                            ->where('rendimientos_economico_montos.estado_activo','=', 1)
                            ->distinct()
                            ->get();
                            
                            //echo $indicadoresActivados;                            
                            //echo 'Termino de cargar indicadores';
                            $indicadoresEvaluados =
                            $indicadoresActivados->where('facturacion','<>', NULL)
                            ->where('emp_hombres_tiempo_parcial','<>', NULL);

                            //////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////

                            $cantidadIndicadoresActivados = sizeof(json_decode($indicadoresActivados,true));
                            $cantidadIndicadoresEvaluados = sizeof(json_decode($indicadoresEvaluados,true));
                            
                                // echo '*******************Cantidad de Indicadores Activados********************';
                                // echo '*******************'.$cantidadIndicadoresActivados.'********************';
                                // echo '*******************Cantidad de Indicadores Evaluados********************';
                                // echo '*******************'.$cantidadIndicadoresEvaluados.'********************';
                            if ($cantidadIndicadoresActivados > $cantidadIndicadoresEvaluados) {
                                $notificacion = $notificacion.' e indicadores';
                            } else {
                                $asesoriasActivadas=Servicio::join('evaluacion_incubadora','servicio.id','=','evaluacion_incubadora.asesoria_tipo_idasesoria_tipo')->join('meses','evaluacion_incubadora.meses_id','=','meses.idmes')
                                ->where('fase_id',$startUp->fase)->get();
                              
                                $asesoriasEvaluadas = $asesoriasActivadas->where('satisfaccion','<>',NULL);
                                $cantAsesoriasActivadas = sizeof(json_decode($asesoriasActivadas,true));
                                $cantAsesoriasEvaluadas = sizeof(json_decode($asesoriasEvaluadas,true));
                                if ($cantAsesoriasActivadas > $cantAsesoriasEvaluadas) {
                                    $notificacion = $notificacion.' e indicadores';
                                } else {                                  
                                    // $mentoriasActivadas = Persona::where('start_up_id',$user->start_up_id)
                                    // ->where('estado_activo',1)->get();
                                    
                                    $mentoriasActivadas=Persona::join('persona_startup','personas.person_id','=','persona_startup.persona_id')->where('persona_startup.startup_id',$user->start_up_id)->where('',1)->get();

                                    // $mentoriasEvaluadas = $mentoriasActivadas->where('especialidad','<>',NULL);
                                    $cantMentoriasActivadas = sizeof(json_decode($mentoriasActivadas,true));
                                    $cantMentoriasEvaluadas = sizeof(json_decode($mentoriasEvaluadas,true));
                                    if ($cantMentoriasActivadas > $cantMentoriasEvaluadas) {
                                        $notificacion = $notificacion.' e indicadores';
                                    }
                                }
                            }
                            return response()->json(
                                [
                                    'success' => true,
                                    'msg' => $notificacion.' de sus meses activados' ,
                                    'rpta' =>$user
                                ],201
                            );
                        } else{
                                // echo '*********************************';
                                // echo 'LLENO SUS EVALUACIONES';
                                // echo '****************************************';
                        
                            $indicadoresActivados = DB::table('rendimientos_economico_montos')
                            ->join('meses', function($join){
                                    //echo '***********Entro a empleos creado empleados*********';
                                $join->on('rendimientos_economico_montos.meses_id','=','meses.idmes')
                                ->where('meses.estado_activo','=',1);
                            })
                            ->join('empleados', function($join){
                                $join->on('meses.idmes','=','empleados.meses_id')
                                ->where('empleados.estado_activo','=', 1);
                            })
                            ->select(
                                'meses.month_id as month_month_id',
                                'meses.startup_id as rend_start_up_id',
                                'empleados.tiempo_parcial as emp_hombres_tiempo_parcial'                       
                            )
                            ->where('meses.startup_id','=',$user->start_up_id)
                            ->where('rendimientos_economico_montos.fase','=',$startUp->fase)
                            ->where('rendimientos_economico_montos.estado_activo','=', 1)
                            ->distinct()
                            ->get();
                                //echo $indicadoresActivados;
                            
                                //echo 'Termino de cargar indicadores';
                               $indicadoresEvaluados =
                            $indicadoresActivados->where('facturacion','<>', NULL)
                            ->where('emp_hombres_tiempo_parcial','<>', NULL);

                            $cantidadIndicadoresActivados = sizeof(json_decode($indicadoresActivados,true));
                            $cantidadIndicadoresEvaluados = sizeof(json_decode($indicadoresEvaluados,true));
                            
                                // echo '*******************Cantidad de Indicadores Activados********************';
                                // echo '*******************'.$cantidadIndicadoresActivados.'********************';
                                // echo '*******************Cantidad de Indicadores Evaluados********************';
                                // echo '*******************'.$cantidadIndicadoresEvaluados.'********************';
                            
                            
                            if ($cantidadIndicadoresActivados > $cantidadIndicadoresEvaluados) {
                                $notificacion = $notificacion.' de indicadores';
                                return response()->json(
                                    [
                                        'success' => true,
                                        'msg' => $notificacion.' de sus meses activados' ,
                                        'rpta' =>$user
                                    ],201
                                );
                            } else {                                  

                                $asesoriasActivadas=Servicio::join('evaluacion_incubadora','servicio.id','=','evaluacion_incubadora.asesoria_tipo_idasesoria_tipo')->join('meses','evaluacion_incubadora.meses_id','=','meses.idmes')
                                ->where('fase_id',$startUp->fase)->get();
                              
                                $asesoriasEvaluadas = $asesoriasActivadas->where('satisfaccion','<>',NULL);
                                $cantAsesoriasActivadas = sizeof(json_decode($asesoriasActivadas,true));
                                $cantAsesoriasEvaluadas = sizeof(json_decode($asesoriasEvaluadas,true));
                                    // echo '*********************************Asesorias Activadas********************************';
                                    // echo '*****************************'.$asesoriasActivadas.'*******************************';
                                    // echo '***************************************************************************';
                                    // echo '*******************Cantidad de Asesorias Activadas********************';
                                    // echo '*******************'.$cantAsesoriasActivadas.'********************';
                                    // echo '*******************Cantidad de Asesorias Evaluadas********************';
                                    // echo '*******************'.$cantAsesoriasEvaluadas.'********************';
                                if ($cantAsesoriasActivadas > $cantAsesoriasEvaluadas) {
                                    $notificacion = $notificacion.' de indicadores';
                                    return response()->json(
                                        [
                                            'success' => true,
                                            'msg' => $notificacion.' de sus meses activados' ,
                                            'rpta' =>$user
                                        ],201
                                    );
                                }else{

                                    $mentoriasActivadas=Persona::join('persona_startup','personas.person_id','=','persona_startup.persona_id')->where('persona_startup.startup_id',$user->start_up_id)->where('',1)->get();

                                    // $mentoriasEvaluadas = $mentoriasActivadas->where('especialidad','<>',NULL);
                                    $cantMentoriasActivadas = sizeof(json_decode($mentoriasActivadas,true));
                                    $cantMentoriasEvaluadas = sizeof(json_decode($mentoriasEvaluadas,true));

                                    if ($cantMentoriasActivadas > $cantMentoriasEvaluadas) {
                                        $notificacion = $notificacion.' de indicadores';
                                        return response()->json(
                                            [
                                                'success' => true,
                                                'msg' => $notificacion.' de sus meses activados' ,
                                                'rpta' =>$user
                                            ],201
                                        );
                                    } else {
                                        return response()->json(['success' => true,'msg' => 'Usuario logueado con exito' , 'rpta' =>$user], 201);
                                    }
                                }
                            }
                        }
                            /*if($eva){
                                return response()->json(
                                    [
                                        'success' => true,
                                        'msg' => 'Usuario logueado con exito' ,
                                        'rpta' =>$user,
                                        'notificacion'=>'No olvide registrar la información correspondiente para los formularios de 
                                        evaluacion e indicadores en sus meses activados'
                                    ],201
                                );
                            }*/
                        } 
                        
                    } else {
                        $user['cambio_fase'] = null;
                        $user['fase'] = null;
                    }
                    return response()->json(['success' => true,'msg' => 'Usuario logueado con exito' , 'rpta' =>$user], 201);
                } else {
                    return response()->json(['msg' => 'Contraseña incorrecta','success' => false, 'rpta'=>''], 201);
                }
            }
            
        } else {
            return response()->json(['msg' => 'La cuenta de ususario no existe','success' => false, 'rpta'=>''], 201);
        }
        
    }

    public function guardarUserStarup(){
           
      $User = User::find(72);
      $Startup = StartUp::find(43);

      $User->startups()->attach($Startup->id);



    }

    public function ListadoRelacionPersona(){
      // $tags = $user->startups()->get();

     $user = User::all();
      
      // if($user->startups()->count() > 0) {
      //    echo "varios usuarios";
      // }else{
      //    echo "no hay usuarios";
      // }
       // $all = Item::all();
     foreach($user as $item){

            $tags=$item->startups()->get();
            foreach ($tags as $tag) {
               echo $tag->name;
               echo "<br>";
            }
          // $tags=$item->startups;

          // foreach ($tags as $listas) {
          //     echo $listas->name;
          //     echo "<br>";
          // }
        }
      // foreach ($user as $listas) {
      //      echo $listas->email;
      // }
     // $user = User::all();
     // foreach ($user->startup()->get() as $show){
     // echo $show->start_up_id;
     // }     
        // foreach ($user->startups as $startup) {
        // //
        //   echo $startup->name;
        //   echo "<br>";
        //   echo $startup->id;
        //   echo "<br>";
        // }
     
     }


}
