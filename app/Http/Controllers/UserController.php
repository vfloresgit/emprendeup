<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StartUp;
use App\Persona;
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
    $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[0,1,2])->get();

     for ($i=0; $i < $user->count(); $i++) {
     	 $var = $user[$i]["Fecha de nacimiento"];
          $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
     }
     return response()->json(['rpta' => $user , 'success' => true], 201);
    }

    public function listarActivos(){
      $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[1])->get();
         for ($i=0; $i < $user->count(); $i++) {
         $var = $user[$i]["Fecha de nacimiento"];
          $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
         }
         return response()->json(['rpta' => $user , 'success' => true], 201);
    }

    public function listarInactivos(){    
      $user=User::join('personas as p','users.persona_id','=','p.person_id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('users.email as Cuenta de usuario','p.name as Nombre','rol.rolescol as Categoria','p.dob as Fecha de nacimiento','p.phone as Telefono','p.genre as Genero','users.activity as Estado','users.user_id')->whereIn('users.activity',[0])->get();
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
            if ($user->rol_id != null && app('env') == 'prod' ) {
                if($user->rol_id == 1){                	
                    // Mail::to($user->email)->send(new CambioContrasenaAdministrador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new CambioContrasenaAdministrador($user,$request->input('password'),$request->header('URL')));
                } else if($user->rol_id == 2 ){
                    // Mail::to($user->email)->send(new CambioContrasenaEvaluador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new CambioContrasenaEvaluador($user,$request->input('password'),$request->header('URL')));
                } else if($user->rol_id > 2) { // $user->category == 3 || $user->category == 4 || $user->category == 5 || $user->category == 6
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
                    $user_rol_id = $request->input('category') + 0;
                // return response()->json(['msg' => 'No se pudo crear el usuario incubado falta asignarle su subcategoria','success' => false], 201);
            }else {
                    $user_rol_id = $request->input('category') + $request->input('sub_category');
         }                
         $startup_fecha_inicio = $request->input('fecha_inicio');//Solo aparecera el campo si en categoria se escoje incubado
         $startup_fecha_inicio_historico = $request->input('fecha_inicio');

                $date =new DateTime($startup_fecha_inicio);
                if($date != null && $date->format('Y') < 2012){
                    return response()->json(['msg' => 'La fecha de inicio no puede ser menor al 2012','success' => false, 'rpta'=>''], 201);
                }else{
                    if ($user_rol_id != null && app('env') == 'prod') {
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
             'rol_id'=> $user_rol_id,
            
            ]);


           }else if($request->input('category')==2){
                $user_rol_id = $request->input('category');
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
                       'rol_id'=> $user_rol_id,
                      
                      ]);
                      $userid=$user->user_id;

                      for ($i=0;$i<count($user_especialidades);$i++){                 
                         UserEspecialidad::create([
                            'user_id' => $userid,
                            'idespecialidad' => $user_especialidades[$i],                
                      ]);
                 }
            }
              
            if ($user_rol_id != null && app('env') == 'prod') {
                    // Mail::to($user->email)->send(new RegistroEvaluador($user,$request->input('password'),$request->header('URL')));
                    // Mail::to($soporte)->send(new RegistroEvaluador($user,$request->input('password'),$request->header('URL')));
            }
          }else{

            $user_rol_id = $request->input('category');
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
             'rol_id'=> $user_rol_id,
            
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

            $user->rol_id = $request->input('category');

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

      $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('stup.name as StartUp ','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[0,1,2])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));            
        }       

        return response()->json(['rpta'=> $user, 'success' => true],200);        
    }

     public function listarIncubadosActivos(){

       $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('stup.name as StartUp','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[1])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
            
        }       
        return response()->json(['rpta'=> $user, 'success' => true],200);  
    }

     public function listarIncubadosInactivos(){

      $user = User::join('personas as p','users.persona_id','=','p.person_id')->join('startup as stup','users.start_up_id','=','stup.id')->join('roles as rol','users.rol_id','=','rol.idroles')->select('stup.name as StartUp','stup.fecha_inicio as Fecha de inicio','users.activity','users.email as Cuenta de usuario','p.name as Nombre','p.dob as Fecha de nacimiento','p.phone as Telefono','rol.idroles')->whereIn('users.activity',[0])->whereIn('rol.idroles',[3,4,5,6,7])->get();
        
      for ($i=0; $i < $user->count(); $i++){        

            $var = $user[$i]["Fecha de nacimiento"];
            $user[$i]["Fecha de nacimiento"] = date("d/m/Y", strtotime($var));
            
        }       
        return response()->json(['rpta'=> $user, 'success' => true],200);  
    }


}
