<!doctype html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="<?= asset('../lib/bootstrap-4/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">

    <style>

        select, textarea, input, .btn, .card {
            border-radius: 0 !important;
        }

        .form-control-feedback {
            float: right;
            margin-right: 6px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
            color: #6c757d;
        }

        hr{
            height:2px;
            background-color:#6c757d;
        }

    </style>


</head>
<body>


    <div class="container" style="margin-top: 3%;" ng-controller="IndexReservationController">

        <!-- FORMULARIO RESERVA PASO 1 -->

        <div class="card" style="width: 35%;" ng-show="reserva_1 == 1">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_1" novalidate="">

                    <div class="col-12 form-group" style="margin-top: 30px !important;">
                        <label for="lugar_retiro">LUGAR DE RETIRO *</label>
                        <input class="form-control" name="lugar_retiro" id="lugar_retiro" ng-model="lugar_retiro"
                               placeholder="Lugar de Retiro" required ng-click="showListPlace(0)" readonly />
                        <span class="help-block error" ng-show="formReserva_1.lugar_retiro.$invalid && formReserva_1.lugar_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                        </span>
                    </div>

                    <div class="col-12 form-group" style="margin-top: 3px;">
                        <label for="fecha_retiro">DIA Y HORA DE RETIRO *</label>

                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="form-control datepickerA" name="fecha_retiro" id="fecha_retiro" ng-model="fecha_retiro" placeholder="Día" required />
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                <span class="help-block error" ng-show="formReserva_1.fecha_retiro.$invalid && formReserva_1.fecha_retiro.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Apellido es requerido</small>
                                </span>
                            </div>

                            <div class="col-6">
                                <input type="time" class="form-control" name="hora_retiro" id="hora_retiro" ng-model="hora_retiro" placeholder="Hora" required />
                                <span class="help-block error" ng-show="formReserva_1.hora_retiro.$invalid && formReserva_1.hora_retiro.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">El Apellido es requerido</small>
                            </span>
                            </div>
                        </div>


                    </div>

                    <div class="col-12 form-group" style="margin-top: 3px">
                        <label for="lugar_entrega">LUGAR DE ENTREGA *</label>
                        <input class="form-control" name="lugar_entrega" id="lugar_entrega" ng-model="lugar_entrega"
                               placeholder="Lugar de Entrega" required ng-click="showListPlace(1)" readonly />
                        <span class="help-block error" ng-show="formReserva_1.lugar_entrega.$invalid && formReserva_1.lugar_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <label for="fecha_entrega">DIA Y HORA DE ENTREGA *</label>

                        <div class="row">
                            <div class="col-6">

                                <div class="input-group">
                                    <input class="form-control datepickerA" name="fecha_entrega" id="fecha_entrega" ng-model="fecha_entrega" placeholder="Día" required />
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                <span class="help-block error" ng-show="formReserva_1.fecha_entrega.$invalid && formReserva_1.fecha_entrega.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">El Apellido es requerido</small>
                            </span>
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" name="hora_entrega" id="hora_entrega" ng-model="hora_entrega" placeholder="Hora" required />
                                <span class="help-block error" ng-show="formReserva_1.hora_entrega.$invalid && formReserva_1.hora_entrega.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">El Apellido es requerido</small>
                            </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-12" style="margin-top: 30px !important;">

                        <div class="form-group row">
                            <label for="edad" class="col-sm-4 col-form-label">EDAD: *</label>
                            <div class="col-sm-8">
                                <select name="edad" id="edad" class="form-control">
                                    <option value="">Seleccione edad</option>
                                </select>
                                <span class="help-block error" ng-show="formReserva_1.edad.$invalid && formReserva_1.edad.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!--<div class="col-12" style="margin-top: 30px !important;">
                        <input class="form-control" name="nombre" id="nombre" ng-model="nombre" placeholder="Nombre *" required />
                        <span class="help-block error" ng-show="formReserva_1.nombre.$invalid && formReserva_1.nombre.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" name="apellidos" id="apellidos" ng-model="apellidos" placeholder="Apellidos *" required />
                        <span class="help-block error" ng-show="formReserva_1.apellidos.$invalid && formReserva_1.apellidos.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Apellido es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" name="pais" id="pais" ng-model="pais" placeholder="País *" required />
                        <span class="help-block error" ng-show="formReserva_1.pais.$invalid && formReserva_1.pais.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El País es requerido</small>
                        </span>
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <input type="email" class="form-control" name="email" id="email" ng-model="email" placeholder="Email *" required />
                        <span class="help-block error" ng-show="formReserva_1.email.$invalid && formReserva_1.email.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El País es requerido</small>
                        </span>
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" name="telefono" id="telefono" ng-model="telefono" placeholder="Teléfono *" required />
                        <span class="help-block error" ng-show="formReserva_1.telefono.$invalid && formReserva_1.telefono.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Télefono es requerido</small>
                        </span>
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control datepickerA" placeholder="Fecha estimada para el Alquiler *" />
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" placeholder="Tiempo *" />
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <textarea cols="30" rows="5" class="form-control" placeholder="Comentarios Adicionales" ></textarea>
                    </div>-->
                </form>

                <div class="col-12" style="margin-top: 10px;" ng-disabled="formReserva_1.$invalid">
                    <button type="button" class="btn btn-danger btn-lg btn-block" ng-click="showModal(2)">RESERVAR</button>
                </div>

                <div class="col-12" style="margin-top: 3px;">

                    <div class="row">
                        <div class="col-4">
                            <!--Resetear -->
                        </div>
                        <div class="col-8 text-right">
                            <small id="emailHelp" class="form-text text-muted">Los campos con * son obligatorios.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="container" ng-show="reserva_1 == 2">

            <div class="row">
                <div class="col-3" style="color: red !important;">
                    1. Seleccionar
                    <hr>
                </div>
                <div class="col-3">
                    2. Servicios
                    <hr>
                </div>
                <div class="col-3">
                    3. Datos Personales
                    <hr>
                </div>
                <div class="col-3">
                    4. Datos de Pagos
                    <hr>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">

                <div class="col-12">

                    <div class="row">
                        <div class="col-12 col-sm-5" style="background-color: #e0e0e0; height: 100px;">

                        </div>
                        <div class="col-12 col-sm-2">

                        </div>
                        <div class="col-12 col-sm-5" style="background-color: #e0e0e0; height: 100px;">

                        </div>
                    </div>



                </div>

                <div class="col-12" style="margin-top: 20px;">
                    RESERVA DE VEHICULO
                </div>

                <div class="col-12" style="margin-top: 10px;">
                    <button type="button" class="btn btn-secondary" ng-repeat="item_cat in categorieslist" style="margin-right: 5px;">
                        {{item_cat.namecarbrand}}
                    </button>
                    <hr>
                </div>

                <div class="row">

                    <div class="col-12 col-sm-2" style="padding: 0; margin: 25px;" ng-repeat="item_car in carlist">
                        <div class="col-12 text-center">
                            <span style="font-size: 16px; font-weight: bold;">{{item_car.namecarmodel}}</span>
                        </div>
                        <div class="col-12 text-center">
                            <span style="font-size: 16px; font-weight: bold; color: #6c757d;">{{item_car.namecarbrand}}</span>
                        </div>

                        <div class="col-12 text-center" style="padding: 0; margin-top: 10px;">
                            <img class="img-fluid" src="{{item_car.image}}" alt="" style="max-width: 100%;">
                        </div>

                        <div class="row" style="margin-top: 5px; font-size: 12px;">
                            <div class="col-12 col-sm-6">
                                {{item_car.amountpassengers}} Puestos <br>
                                {{item_car.amountluggage}} Equipajes <br>
                                <a href="#" ng-click="getDetails(item_car)">Detalles</a>
                            </div>
                            <div class="col-12 col-sm-6" style="padding: 0;">
                                <div class="col-12 text-right">COSTO</div>
                                <div class="col-12 text-right">
                                    $
                                    <span style="font-weight: bold; font-size: 20px; color: #6c757d;">
                                        {{item_car.price}}
                                    </span>
                                </div>
                                <div class="col-12 text-right">DIARIO</div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12 col-sm-6" style="padding-right: 0;">
                                <button type="button" class="btn btn-outline-dark btn-sm" ng-click="showModal(3)" style="font-size: 12px !important; ">
                                    PAGO CAJA
                                </button>
                            </div>
                            <div class="col-12 col-sm-6" style="padding-left: 0;">
                                <button type="button" class="btn btn-danger btn-sm" ng-click="showModal(3)" style="font-size: 12px !important; ">
                                    PAGO AHORA
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <div class="container" ng-show="reserva_1 == 3">

            <div class="row">
                <div class="col-3">
                    1. Seleccionar
                    <hr>
                </div>
                <div class="col-3" style="color: red !important;">
                    2. Servicios
                    <hr>
                </div>
                <div class="col-3">
                    3. Datos Personales
                    <hr>
                </div>
                <div class="col-3">
                    4. Datos de Pagos
                    <hr>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">

                <div class="col-sm-6 col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="color: red !important;">SERVICIOS ADICIONALES</th>
                                <th style="width: 15% !important;"></th>
                                <th style="width: 1% !important;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item_aditionalservice in aditionalServiceList">
                                <td>{{item_aditionalservice.service}}</td>
                                <td class="text-right" style="font-weight: bold;">$ {{item_aditionalservice.price}}</td>
                                <td>
                                    <label class="custom-control custom-radio">
                                        <input name="item_aditionalservice.idservice" id="item_aditionalservice.idservice"
                                               ng-model="item_aditionalservice.idservice" type="radio"
                                               class="custom-control-input" ng-click="selectServicesClick(item_aditionalservice)">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th style="color: red !important;">OTROS SERVICIOS</th>
                                <th style="width: 15% !important;"></th>
                                <th style="width: 1% !important;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item_otherservice in otherServiceList">
                                <td>{{item_otherservice.service}}</td>
                                <td class="text-right" style="font-weight: bold;">$ {{item_otherservice.price}}</td>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input name="item_otherservice.idservice" id="item_otherservice.idservice"
                                               ng-model="item_otherservice.idservice" type="checkbox"
                                               class="custom-control-input" ng-click="selectServicesClick(item_otherservice)">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6 col-12">

                    <table class="table table-bordered border-left-0 border-right-0 border-bottom-0">
                        <tbody>
                            <tr ng-repeat="item_selectservice in selectServiceList">
                                <td class="border-0" style="font-weight: bold; text-transform: uppercase;">{{item_selectservice.service}}</td>
                                <td class="border-0 text-right" style="width: 15% !important;">$ {{item_selectservice.price}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered border-left-0 border-right-0">
                        <tbody>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">SUBTOTAL</td>
                                <td class="border-0 text-right" style="color: red;">$ {{subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">IVA</td>
                                <td class="border-0 text-right" style="color: red;">$ {{iva}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">TOTAL</td>
                                <td class="border-0 text-right" style="color: red; font-weight: bold; font-size: 28px;">$ {{total}}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>


        </div>




        <!-- FORMULARIO RESERVA PASO 2 -->

        <div class="card" style="width: 35%;" ng-show="reserva_1 == 5">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_2" novalidate="">

                    <div class="col-12" style="margin-top: 30px !important;">
                        <select class="form-control" name="lugar_retiro" id="lugar_retiro" ng-model="lugar_retiro"
                                ng-options="value.id as value.label for value in placelist" required></select>
                        <span class="help-block error" ng-show="formReserva_2.lugar_retiro.$invalid && formReserva_2.lugar_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Retiro es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input type="datetime-local" class="form-control" name="fecha_retiro" id="fecha_retiro" ng-model="fecha_retiro" placeholder="Fecha y Hora para el Retiro *" required />
                        <span class="help-block error" ng-show="formReserva_2.fecha_retiro.$invalid && formReserva_2.fecha_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">La Fecha y Hora de Retiro es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <!--<div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Mismo Lugar de Entrega
                            </label>
                        </div>-->

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Mismo Lugar de Entrega</span>
                        </label>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <select class="form-control" name="lugar_entrega" id="lugar_entrega" ng-model="lugar_entrega"
                                ng-options="value.id as value.label for value in placelist" required></select>
                        <span class="help-block error" ng-show="formReserva_2.lugar_entrega.$invalid && formReserva_2.lugar_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Entrega es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control datepicker" name="fecha_entrega" id="fecha_entrega" ng-model="fecha_entrega" placeholder="Fecha y Hora para la Entrega *" required />
                        <span class="help-block error" ng-show="formReserva_2.fecha_entrega.$invalid && formReserva_2.fecha_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">La Fecha y Hora de Entrega es requerido</small>
                        </span>
                    </div>



                </form>

                <div class="col-12 text-center" style="margin-top: 10px;" ng-disabled="formReserva_2.$invalid">
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(1)">ANTERIOR</button>
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(3)">SIGUIENTE</button>
                </div>

                <div class="col-12" style="margin-top: 3px;">

                    <div class="row">
                        <div class="col-4">
                            <!--Resetear -->
                        </div>
                        <div class="col-8 text-right">
                            <small id="emailHelp" class="form-text text-muted">Los campos con * son obligatorios.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- FORMULARIO RESERVA PASO 3 -->

        <div class="card" style="width: 45%;" ng-show="reserva_1 == 6">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_3" novalidate="">

                    <div class="col-12" style="margin-top: 30px !important;">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>RETIRO</th>
                                <th>RETORNO</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">FECHA</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">HORA</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">LUGAR</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12" style="margin-top: 10px">
                        <h4>
                            Reserva de vehiculo
                        </h4>
                    </div>

                    <div class="row" style="margin-top: 10px">
                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="margin-top: 10px">
                            <div class="card rounded">
                                <img class="card-img-top" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                                <div class="card-body">
                                    <span class="badge badge-dark">Categoria</span>
                                    <p class="card-text">
                                        Costo:
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>

                <div class="col-12 text-center" style="margin-top: 10px;" ng-disabled="formReserva_3.$invalid">
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(2)">ANTERIOR</button>
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(4)">SIGUIENTE</button>
                </div>

                <div class="col-12" style="margin-top: 3px;">

                    <div class="row">
                        <div class="col-4">
                            <!--Resetear -->
                        </div>
                        <div class="col-8 text-right">
                            <small id="emailHelp" class="form-text text-muted">Los campos con * son obligatorios.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- FORMULARIO RESERVA PASO 4 -->

        <div class="card" style="width: 45%;" ng-show="reserva_1 == 4">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_3" novalidate="">

                    <div class="col-12" style="margin-top: 30px !important;">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>RETIRO</th>
                                <th>RETORNO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">FECHA</th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">HORA</th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">LUGAR</th>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12" style="margin-top: 5px">
                        <div class="card border-0">
                            <div class="card-body">
                                <h4>
                                    Nombre del vehiculo
                                </h4>
                            </div>
                            <img class="card-img-bottom" src="http://www.toyota.com.ec/gt86/web/css/images/auto-home.png" alt="Card image cap">
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 5px">
                        <h4>
                            Servicios Adicionales
                        </h4>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">

                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                    </label>
                                </td>
                                <td style="width: 89% !important;">Protección y cobertura 1 daño a terceros</td>
                                <td style="width: 10% !important;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                    </label>
                                </td>
                                <td>Protección y cobertura 2 PAI</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-12" style="margin-top: 5px">
                        <h4>
                            Otros Servicios
                        </h4>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">

                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                        </label>
                                    </td>
                                    <td style="width: 89% !important;">Asiento(s) de Bebe</td>
                                    <td style="width: 15% !important;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                        </label>
                                    </td>
                                    <td>Conductor Autorizado</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                        </label>
                                    </td>
                                    <td>GPS</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <!--<span class="custom-control-description">Mismo Lugar de Entrega</span>-->
                                        </label>
                                    </td>
                                    <td>Servicio de Chofer</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </form>

                <div class="col-12 text-center" style="margin-top: 10px;" ng-disabled="formReserva_3.$invalid">
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(3)">ANTERIOR</button>
                    <button type="button" class="btn btn-danger btn-lg" ng-click="showModal(4)">PROCESAR</button>
                </div>

                <div class="col-12" style="margin-top: 3px;">

                    <div class="row">
                        <div class="col-4">
                            <!--Resetear -->
                        </div>
                        <div class="col-8 text-right">
                            <small id="emailHelp" class="form-text text-muted">Los campos con * son obligatorios.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>





        <div class="modal fade" id="modalMessagePlace" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-info">
                        <h5 class="modal-title">Lugar de {{type_place}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group">
                                    <!--<a href="#" class="list-group-item"></a>-->
                                    <a href="#" class="list-group-item list-group-item-action"
                                            ng-repeat="item in placelist" ng-click="selectOptionPlace(item)">{{item.nameplace}}</a>
                                    <!--<a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                                    <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>-->
                                </div>
                            </div>
                            <div class="col-8"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalMessageInfoCar" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-info">
                        <h5 class="modal-title">{{title_carbrand}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <span>{{title_carmodel}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <img class="img-fluid" src="{{title_carimage}}" alt="" style="max-width: 100%;">
                            </div>
                            <div class="col-6">

                                <div class="row">
                                    {{cant_pasajeros}} Pasajero(s) <br>
                                    {{cant_equipajes}} Equipaje(s) <br>
                                    {{tipo_fuel}} <br>
                                    {{tipo_transmission}}
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    COSTO <br><br>
                                    $<span style="font-weight: bold; font-size: 20px; color: #6c757d;">
                                        {{title_rentcost}}
                                    </span> <br>
                                    DIARIO
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm" ng-click="showModal(3)" style="font-size: 12px !important; ">
                            PAGO CAJA
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" ng-click="showModal(3)" style="font-size: 12px !important; ">
                            PAGO AHORA
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalMessageError" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-info">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{Mensaje}}
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

<script src="<?= asset('../lib/jquery/jquery-3.2.1.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script src="<?= asset('../lib/bootstrap-4/dist/js/bootstrap.min.js') ?>"></script>

<script src="<?= asset('../lib/bootstrap-datetimepicker/moment.min.js') ?>"></script>
<script src="<?= asset('../lib/bootstrap-datetimepicker/es.js') ?>"></script>
<script src="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>


<script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
<script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
<script src="<?= asset('../lib/dirPagination.js') ?>"></script>

<script src="<?= asset('../app/js/app_system.js') ?>"></script>

<script src="<?= asset('../app/js/controllers/indexReservation/indexReservationController.js') ?>"></script>

</html>