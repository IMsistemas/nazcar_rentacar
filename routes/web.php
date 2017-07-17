<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 *
 * --------------------------------------IMPORTANTE !!!!!---------------------------------------------------------------
 *
 * Se realiza la division y se solicita a cada desarrollador respetar su espacio de trabajo en este archivo que es de
 * comun acceso. Se requiere de LIMPIEZA y TRANSPARENCIA en la codificacion.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 *
 */

/*
 * --------------------------------------Ana Dayana Yero Cardoso--------------------------------------------------------
 */




/*
 * --------------------------------------Jean Carlos Ramos--------------------------------------------------------------
 */



/*
 * --------------------------------------Darwin Tarapuez Tarapuez-------------------------------------------------------
 */

	//-------------------LOGICA MARCA DE AUTO-------------------////
	Route::get('Marca/estado/{texto}', 'MarcaAuto\MarcaController@modify_estado');
	Route::get('Marca/get_list_marca', 'MarcaAuto\MarcaController@get_list_marca');
	Route::resource('Marca', 'MarcaAuto\MarcaController');
	

/*
 * --------------------------------------Raidel Berrillo Gonzalez-------------------------------------------------------
 */
