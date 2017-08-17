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

/*Route::get('/', function () {
    return view('welcome');
});*/

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

    //---------------LISTAR RENTAS--------------------///
    Route::get('rent/listRents', 'Rent\RentController@listRents');
    Route::resource('rent', 'Rent\RentController');

    //---------------REGISTRAR LOS AUTOS--------------------///
    Route::get('car/getListCars', 'Car\CarController@getListCars');
    Route::resource('car', 'Car\CarController');


/*
 * --------------------------------------Jean Carlos Ramos--------------------------------------------------------------
 */



/*
 * --------------------------------------Darwin Tarapuez Tarapues-------------------------------------------------------
 */

	//-------------------LOGICA MARCA DE AUTO-------------------////
	Route::get('Marca/estado/{texto}', 'MarcaAuto\MarcaController@modify_estado');
	Route::get('Marca/get_list_marca', 'MarcaAuto\MarcaController@get_list_marca');
	Route::resource('Marca', 'MarcaAuto\MarcaController');
	//-------------------LOGICA FORMA PAGO-------------------////
	Route::get('FormPago/estado/{texto}', 'FormaPago\FormaPagoController@modify_estado');
	Route::get('FormPago/get_list_pago', 'FormaPago\FormaPagoController@get_list_pago');
	Route::resource('FormPago', 'FormaPago\FormaPagoController');
	//-------------------LOGICA MODELO DE AUTO-------------------////
	Route::get('Modelo/estado/{texto}', 'ModeloAuto\ModeloController@modify_estado');
	Route::get('Modelo/get_list_modelo', 'ModeloAuto\ModeloController@get_list_modelo');
	Route::resource('Modelo', 'ModeloAuto\ModeloController');
	

/*
 * --------------------------------------Raidel Berrillo Gonzalez-------------------------------------------------------
 */

    Route::resource('/', 'IndexReservation\IndexReservationController');