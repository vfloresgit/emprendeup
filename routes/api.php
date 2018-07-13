<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//METODOS USUARIO
Route::post('/registrarUsuario',[
    'uses'  => 'UserController@registrar'
]);
//});
Route::post('/loginUsuario',[
    'uses'  => 'UserController@login'
]);

Route::put('/actualizarUsuario/{id}',[
    'uses'  => 'UserController@actualizar'
]);
Route::get('/listarUsuario',[
    'uses'  => 'UserController@listar'
]);

Route::get('/listarUsuarioActivos',[
    'uses'  => 'UserController@listarActivos'
]);

Route::get('/listarUsuarioInactivos',[
    'uses'  => 'UserController@listarInactivos'
]);

Route::get('/obtenerUsuario/{id}',[
    'uses'  => 'UserController@obtener'
]);

Route::put('/estadoUsuario/{id}',[
    'uses'  => 'UserController@cambiarEstado'
]);

Route::put('/rolUsuario/{id}',[
    'uses'  => 'UserController@cambiarRol'
]);

Route::put('/cambiarpasoUsuario/{id}',[
    'uses'  => 'UserController@cambiarPaso'
]);

Route::get('/listarIncubados',[
    'uses'  => 'UserController@listarIncubados'
]);

Route::get('/listarIncubadosActivos',[
    'uses'  => 'UserController@listarIncubadosActivos'
]);

Route::get('/listarIncubadosInactivos',[
    'uses'  => 'UserController@listarIncubadosInactivos'
]);

Route::put('/cambiarPassword/{id}',[
    'uses'  => 'UserController@cambiarPassword'
]);


///METODO ESPECIALIDAD
Route::get('/listarEspecialidades',[
    'uses'  => 'EspecialidadController@listar'
]);