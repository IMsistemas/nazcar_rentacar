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

    Route::get('index/logout', 'Index\IndexController@logout');
    Route::get('index/index_b', 'Index\IndexController@viewIndex');
    Route::resource('/', 'Index\IndexController');

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
    Route::get('rent/getCarBrands', 'Rent\RentController@getCarBrands');
    Route::get('rent/getListClients', 'Rent\RentController@getListClients');
    Route::get('rent/listRents', 'Rent\RentController@listRents');
    Route::resource('rent', 'Rent\RentController');

    //---------------LISTAR RENTAS--------------------///
    Route::get('client/activarInactivar/{data}', 'Client\ClientController@activarInactivar');
    Route::get('client/getListCountry', 'Client\ClientController@getListCountry');
    Route::get('client/getPaidForms', 'Client\ClientController@getPaidForms');
    Route::get('client/listClients', 'Client\ClientController@listClients');
    Route::resource('client', 'Client\ClientController');

    //---------------REGISTRAR LOS AUTOS--------------------///
    Route::get('car/estado/{data}', 'Car\CarController@modify_estado');
    Route::get('car/get_list_modelo/{id}', 'Car\CarController@get_list_modelo');
    Route::get('car/get_list_marca', 'Car\CarController@get_list_marca');
    Route::get('car/get_list_motor', 'Car\CarController@get_list_motor');
    Route::get('car/get_list_fuel', 'Car\CarController@get_list_fuel');
    Route::get('car/get_list_transmission', 'Car\CarController@get_list_transmission');
    Route::get('car/listCars', 'Car\CarController@listCars');
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
    Route::get('Modelo/listMarcas', 'ModeloAuto\ModeloController@listMarcas');
	Route::get('Modelo/estado/{texto}', 'ModeloAuto\ModeloController@modify_estado');
	Route::get('Modelo/get_list_modelo', 'ModeloAuto\ModeloController@get_list_modelo');
	Route::resource('Modelo', 'ModeloAuto\ModeloController');
	//-------------------Paypal-------------------////
	Route::get('paypal', array('as' => 'payment.status','uses' => 'Pago\PaypalLaravelController@getPaymentStatus',));
    Route::resource('Paypallaravel2', 'Pago\PaypalLaravelController');	
	//-------------------Paypal-------------------////	

/*
 * --------------------------------------Raidel Berrillo Gonzalez-------------------------------------------------------
 */

    Route::get('slider/getDataSlider', 'Slider\SliderController@getDataSlider');
    Route::resource('slider', 'Slider\SliderController');

    Route::get('configpaypal/getDataPaypal', 'Paypal\PaypalController@getDataPaypal');
    Route::resource('configpaypal', 'Paypal\PaypalController');

    Route::get('company/getDataCompany', 'Company\CompanyController@getDataCompany');
    Route::resource('company', 'Company\CompanyController');

    Route::get('user/getUser', 'User\UserController@getUser');
    Route::put('user/updateState/{id}', 'User\UserController@updateState');
    Route::resource('user', 'User\UserController');

    Route::get('place/getPlace', 'Place\PlaceController@getPlace');
    Route::put('place/updateState/{id}', 'Place\PlaceController@updateState');
    Route::resource('place', 'Place\PlaceController');

    Route::get('typetime/getTypeTime', 'TypeTime\TypeTimeController@getTypeTime');
    Route::put('typetime/updateState/{id}', 'TypeTime\TypeTimeController@updateState');
    Route::resource('typetime', 'TypeTime\TypeTimeController');

    Route::get('service/getService', 'Service\ServiceController@getService');
    Route::put('service/updateState/{id}', 'Service\ServiceController@updateState');
    Route::resource('service', 'Service\ServiceController');

    Route::get('motor/getMotor', 'Motor\MotorController@getMotor');
    Route::put('motor/updateState/{id}', 'Motor\MotorController@updateState');
    Route::resource('motor', 'Motor\MotorController');

    Route::get('fuel/getFuel', 'Fuel\FuelController@getFuel');
    Route::put('fuel/updateState/{id}', 'Fuel\FuelController@updateState');
    Route::resource('fuel', 'Fuel\FuelController');

    Route::get('transmission/getTransmission', 'Transmission\TransmissionController@getTransmission');
    Route::put('transmission/updateState/{id}', 'Transmission\TransmissionController@updateState');
    Route::resource('transmission', 'Transmission\TransmissionController');

    Route::get('reservation/getCalculate', 'IndexReservation\IndexReservationController@getCalculate');
    Route::get('reservation/getOtherServices', 'IndexReservation\IndexReservationController@getOtherServices');
    Route::get('reservation/getAditionalServices', 'IndexReservation\IndexReservationController@getAditionalServices');
    Route::get('reservation/getCar/{categories}', 'IndexReservation\IndexReservationController@getCar');
    Route::get('reservation/getCategories', 'IndexReservation\IndexReservationController@getCategories');
    Route::get('reservation/getPlaces', 'IndexReservation\IndexReservationController@getPlaces');
    Route::resource('reservation', 'IndexReservation\IndexReservationController');