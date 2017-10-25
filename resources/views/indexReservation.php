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

        hr.estilo {
            height: 3px;
            border: 0;
            background-color: darkred;
        }

        hr.estilo2 {
            height: 2px;
            border: 0;
            background-color: darkred;
        }

        input.colours { background: #eeeeee; }

        select.colours { background: #eeeeee; }

        label {
            /*font-weight: bold;*/
        }

        .btn_menu {
            /*margin-right: 5px;*/
            width: 100% !important;
            height: 70px;
            font-size: 11px;
            font-weight: bold;
            word-wrap: break-word !important;
        }

        .text_style {
            color: #6c757d;
            font-size: 12px;
            font-family: "Andale Mono", monospace, sans-serif;
        }

        .text_style2 {
            color: #6c757d;
            font-weight: bold;
        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>


</head>

<body>


    <div class="container-fluid" style="margin-top: 3%;" ng-controller="IndexReservationController">

        <!-- FORMULARIO RESERVA PASO 1 -->

        <div class="row" ng-show="reserva_1 == 1">

            <div class="col-sm-4 col-12">
                <div class="card" style="width: 100%;">
                    <div class="card-body">

                        <h4 class="card-title text-center">Haz tu Reserva</h4>

                        <form class="form-horizontal" name="formReserva_1" novalidate="">

                            <div class="col-12 form-group" style="margin-top: 30px !important;">
                                <label for="lugar_retiro">LUGAR DE RETIRO *</label>
                                <input class="form-control" name="lugar_retiro" id="lugar_retiro" ng-model="lugar_retiro"
                                       placeholder="Lugar de Retiro" required ng-click="showListPlace(0)" readonly />
                                <span class="help-block error" ng-show="formReserva_1.lugar_retiro.$invalid && formReserva_1.lugar_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Retiro es requerido</small>
                        </span>
                            </div>

                            <div class="col-12 form-group" style="">
                                <label for="fecha_retiro">DIA Y HORA DE RETIRO *</label>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <input class="form-control datepickerA colours" name="fecha_retiro" id="fecha_retiro"
                                                   ng-model="fecha_retiro" placeholder="Día" ng-blur="reafirmDate(0)" required />
                                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="help-block error" ng-show="formReserva_1.fecha_retiro.$invalid && formReserva_1.fecha_retiro.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">La Fecha es requerida</small>
                                </span>
                                    </div>

                                    <div class="col-6">
                                        <input type="time" class="form-control colours" name="hora_retiro" id="hora_retiro"
                                               ng-model="hora_retiro" placeholder="Hora" ng-blur="reafirmHours(0)"  required />
                                        <span class="help-block error" ng-show="formReserva_1.hora_retiro.$invalid && formReserva_1.hora_retiro.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">La Hora es requerida</small>
                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group" style="">
                                <label for="lugar_entrega">LUGAR DE ENTREGA *</label>
                                <input class="form-control" name="lugar_entrega" id="lugar_entrega" ng-model="lugar_entrega"
                                       placeholder="Lugar de Entrega" required ng-click="showListPlace(1)" readonly />
                                <span class="help-block error" ng-show="formReserva_1.lugar_entrega.$invalid && formReserva_1.lugar_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Entrega es requerido</small>
                        </span>
                            </div>

                            <div class="col-12" style="">
                                <label for="fecha_entrega">DIA Y HORA DE ENTREGA *</label>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <input class="form-control datepickerB colours" name="fecha_entrega" id="fecha_entrega"
                                                   ng-model="fecha_entrega" placeholder="Día" ng-blur="reafirmDate(1)" required />
                                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="help-block error" ng-show="formReserva_1.fecha_entrega.$invalid && formReserva_1.fecha_entrega.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">La Fecha es requerida</small>
                            </span>
                                    </div>

                                    <div class="col-6">
                                        <input type="time" class="form-control colours" name="hora_entrega" id="hora_entrega"
                                               ng-model="hora_entrega" placeholder="Hora" ng-blur="reafirmHours(1)" required />
                                        <span class="help-block error" ng-show="formReserva_1.hora_entrega.$invalid && formReserva_1.hora_entrega.$touched">
                                <small id="emailHelp" class="form-text text-danger text-right">La Hora es requerida</small>
                            </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12" style="margin-top: 20px !important;">

                                <div class="form-group row">
                                    <label for="edad" class="col-sm-4 col-form-label">EDAD: *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="edad" id="edad" ng-model="edad"
                                                ng-options="value.id as value.label for value in listEdad" required></select>
                                        <span class="help-block error" ng-show="formReserva_1.edad.$invalid && formReserva_1.edad.$touched">
                                            <small id="emailHelp" class="form-text text-danger text-right">La Edad es requerida</small>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 text-center" style="margin-top: 5px;">
                                <p style="color: #014c8c;">
                                    <a href="" ng-click="showDataRegister(true)">¿Está Registrado?</a>
                                </p>
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

                        <div class="col-12" style="margin-top: 10px;">
                            <button type="button" class="btn btn-danger btn-lg btn-block"
                                    ng-click="showModal(2)" ng-disabled="formReserva_1.$invalid">RESERVAR</button>
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
            </div>

            <div class="col-sm-8 col-12">
                <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item" ng-class="$index == 0 ? 'active' : ''" ng-repeat="item_image in sliderlist">
                            <img class="d-block w-100" src="{{item_image.image_url}}" alt="{{$index}}" style="">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- FORMULARIO RESERVA PASO 2 -->

        <div class="col-12" ng-show="reserva_1 == 2">

            <div class="row">
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: darkred !important; font-weight: bold; text-decoration: none;">1. Seleccionar</a>
                    <hr class="estilo">
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">2. Servicios</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">3. Datos Personales</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">4. Datos de Pagos</a>
                    <hr>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">

                <div class="col-12">

                    <div class="row">
                        <div class="col-12 col-sm-5" style="background-color: #e0e0e0; height: 100px; color: #1a237e;">
                            <div class="col-12 text-center">
                                <span style="font-size: 24px; font-weight: bold;">{{data_retiro_code}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <span>{{data_retiro_place}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <span>{{data_retiro_date}} a las {{data_retiro_hour}}</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2 text-center" style="color: darkred; font-weight: bold;">

                            <div class="col-12 text-center" style="margin-top: 15px; font-size: 24px;">
                                Renta por:
                            </div>
                            <div class="col-12 text-center">
                                <span style="font-size: 32px;">{{rest_day}} DIAS</span>
                            </div>

                        </div>
                        <div class="col-12 col-sm-5" style="background-color: #e0e0e0; height: 100px; color: #1a237e;">
                            <div class="col-12 text-center">
                                <span style="font-size: 24px; font-weight: bold;">{{data_entrega_code}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <span>{{data_entrega_place}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <span>{{data_entrega_date}} a las {{data_entrega_hour}}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12" style="margin-top: 20px; color: darkred; font-weight: bold;">
                    RESERVA DE VEHICULO
                </div>

                <div class="col-12 text-center" style="margin-top: 10px;">

                    <div class="row" style="padding-left: 15px;">
                        <div class="" style="margin-right: 2px; width: 7%;">
                            <button type="button" class="btn_menu" ng-click="getCar(0)">
                                TODOS
                            </button>
                        </div>
                        <div class="" ng-repeat="item_cat in categorieslist" style="padding: 0; margin-right: 2px; width: 7%;">
                            <button type="button" class="btn_menu" ng-click="getCar(item_cat.idcarbrand)">
                                {{item_cat.namecarbrand}}
                            </button>
                        </div>
                    </div>

                    <hr class="estilo2">
                </div>

                <div class="col-12">

                    <div class="row">
                        <div class="col-12 col-sm-2" style="padding: 0; margin-bottom: 10px;" ng-repeat="item_car in carlist">

                            <div class="col-12 text-center">
                                <span style="font-size: 16px; font-weight: bold;">{{item_car.namecarmodel}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <span style="font-size: 12px; font-weight: bold; color: #6c757d;">{{item_car.namecarbrand}}</span>
                            </div>

                            <div class="col-12 text-center" style="padding: 0; margin-top: 10px;">
                                <img class="img-fluid" src="{{item_car.image}}" alt="image" style="max-width: 100% !important; height: 150px !important;">
                                <!--<img class="img-fluid" src="{{item_car.image}}" alt="" style="max-width: 100%; border: 1px solid;">-->
                            </div>

                            <div class="col-12" style="margin-top: 5px; font-size: 12px;">
                                <div class="row" style="padding: 5px;">
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
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="row">
                                    <div class="col-12 col-sm-6" style="padding-right: 0;">
                                        <button type="button" class="btn btn-outline-dark btn-sm" ng-click="intermediateStep(item_car, 'caja')" style="font-size: 12px !important; ">
                                            PAGO CAJA
                                        </button>
                                    </div>
                                    <div class="col-12 col-sm-6" style="padding-left: 0;">
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="intermediateStep(item_car, 'paypal')" style="font-size: 12px !important; ">
                                            PAGO AHORA
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <!-- FORMULARIO RESERVA PASO 3 -->

        <div class="col-12" ng-show="reserva_1 == 3">

            <div class="row">

                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">1. Seleccionar</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: darkred !important; font-weight: bold; text-decoration: none;">2. Servicios</a>
                    <hr class="estilo">
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">3. Datos Personales</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">4. Datos de Pagos</a>
                    <hr>
                </div>

            </div>

            <div class="row" style="margin-top: 20px;">

                <div class="col-sm-6 col-12">
                    <table class="table border-0">
                        <thead>
                            <tr>
                                <th class="border-0" style="color: darkred !important; font-size: 20px;">SERVICIOS ADICIONALES</th>
                                <th class="border-0" style="width: 15% !important;"></th>
                                <th class="border-0" style="width: 1% !important;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item_aditionalservice in aditionalServiceList">
                                <td>{{item_aditionalservice.service}}</td>
                                <td class="text-right" style="font-weight: bold;">$ {{item_aditionalservice.price}}</td>
                                <td>
                                    <label class="custom-control custom-radio">
                                        <input name="radio" id="radio"
                                               ng-model="item_aditionalservice.idservice" type="radio" value="{{item_aditionalservice.idservice}}"
                                               class="custom-control-input" ng-click="selectServicesClick(item_aditionalservice, 'radio_' + item_aditionalservice.idservice)">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-0" style="color: darkred !important; font-size: 20px;">OTROS SERVICIOS</th>
                                <th class="border-0" style="width: 15% !important;"></th>
                                <th class="border-0" style="width: 1% !important;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item_otherservice in otherServiceList">
                                <td>{{item_otherservice.service}}</td>
                                <td class="text-right" style="font-weight: bold;">$ {{item_otherservice.price}}</td>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input name="item_otherservice.idservice" id="checkbox_{{item_otherservice.idservice}}"
                                               ng-model="item_otherservice.idservice" type="checkbox"
                                               class="custom-control-input" ng-click="selectServicesClick(item_otherservice, 'checkbox_' + item_otherservice.idservice)">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-6 col-12">

                    <div class="row">
                        <div class="col-12">
                            {{title_carmodel}} <br>
                            {{title_carbrand}}
                        </div>

                        <div class="col-12 text-center">
                            <img class="img-fluid" src="{{title_carimage}}" alt="" style="max-width: 60%;">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6" style="">
                                            <div class="col-12" style="padding: 5px; background-color: #e0e0e0; height: 140px; color: #1a237e;">
                                                <div class="col-12 text-center">
                                                    <span style="font-size: 18px; font-weight: bold; color: darkred;">Retiro</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span style="font-size: 24px; font-weight: bold;">{{data_retiro_code}}</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span>{{data_retiro_place}}</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span>{{data_retiro_date}} a las {{data_retiro_hour}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-12" style="padding: 5px; background-color: #e0e0e0; height: 140px; color: #1a237e;">
                                                <div class="col-12 text-center">
                                                    <span style="font-size: 18px; font-weight: bold; color: darkred;">Entrega</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span style="font-size: 24px; font-weight: bold;">{{data_entrega_code}}</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span>{{data_entrega_place}}</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span>{{data_entrega_date}} a las {{data_entrega_hour}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-12" style="color: darkred; margin-top: 15px; margin-bottom: 10px;">
                        Renta por: {{rest_day}} días
                    </div>
                    <table class="table table-bordered border-left-0 border-right-0 border-bottom-0">
                        <tbody>
                            <tr ng-repeat="item_selectservice in selectServiceList">
                                <td class="border-0" style="font-weight: bold; text-transform: uppercase;">{{item_selectservice.service}}</td>
                                <td class="border-0 text-right" style="width: 20% !important;">$ {{item_selectservice.price}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered border-left-0 border-right-0">
                        <tbody>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">SUBTOTAL</td>
                                <td class="border-0 text-right" style="color: darkred;">$ {{subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">IVA</td>
                                <td class="border-0 text-right" style="color: darkred;">$ {{iva}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">TOTAL</td>
                                <td class="border-0 text-right" style="color: darkred; font-weight: bold; font-size: 28px;">$ {{total}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-12 text-right" style="margin-bottom: 50px;">
                        <button type="button" class="btn btn-outline-dark" ng-click="showModal(2)" style="font-size: 12px !important; ">
                            Regresar
                        </button>

                        <button type="button" class="btn btn-danger" ng-click="showModal(4)" style="font-size: 12px !important; ">
                            CONTINUAR
                        </button>
                    </div>

                </div>

            </div>


        </div>

        <!-- FORMULARIO RESERVA PASO 4 -->

        <div class="col-12" ng-show="reserva_1 == 4">

            <div class="row">

                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">1. Seleccionar</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">2. Servicios</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: darkred !important; font-weight: bold; text-decoration: none;">3. Datos Personales</a>
                    <hr class="estilo">
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">4. Datos de Pagos</a>
                    <hr>
                </div>

            </div>

            <div class="row" style="margin-top: 20px;">

                <div class="col-12">

                    <div class="col-12">
                        <form class="form-horizontal" name="formDataClient" novalidate="">

                            <div class="form-group row">
                                <label for="docident" class="col-sm-3 col-form-label" style="font-weight: bold;">Tipo de Documento *</label>
                                <div class="col-sm-9">
                                    <label class="custom-control custom-radio">
                                        <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Cédula</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Pasaporte</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="docident" class="col-sm-3 col-form-label" style="font-weight: bold;">Documento de Identidad *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="docident" id="docident" ng-model="docident"
                                           placeholder="Cédula / Pasaporte" ng-maxlength="10" required />

                                    <span class="help-block error" ng-show="formDataClient.docident.$invalid && formDataClient.docident.$touched">
                                        <small class="form-text text-danger text-right">El Documento de Identidad es requerido</small>
                                    </span>
                                    <span class="help-block error" ng-show="formDataClient.docident.$invalid && formDataClient.docident.$error.maxlength">
                                        <small class="form-text text-danger text-right">La longitud máxima es de 10 caracteres</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="names" class="col-sm-3 col-form-label" style="font-weight: bold;">Nombre(s) *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="names" id="names" ng-model="names" placeholder="Nombre(s)" required />
                                    <span class="help-block error" ng-show="formDataClient.names.$invalid && formDataClient.names.$touched">
                                        <small class="form-text text-danger text-right">Nombre(s) es requerido</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastnames" class="col-sm-3 col-form-label" style="font-weight: bold;">Apellidos *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="lastnames" id="lastnames" ng-model="lastnames" placeholder="Apellidos" required />
                                    <span class="help-block error" ng-show="formDataClient.lastnames.$invalid && formDataClient.lastnames.$touched">
                                        <small class="form-text text-danger text-right">Apellidos es requerido</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label" style="font-weight: bold;">Correo *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="email" id="email" ng-model="email" placeholder="Correo" required />
                                    <span class="help-block error" ng-show="formDataClient.email.$invalid && formDataClient.email.$touched">
                                        <small class="form-text text-danger text-right">Correo es requerido</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="lastnames" class="col-sm-3 col-form-label" style="font-weight: bold;"></label>
                                <div class="col-sm-9">
                                    <div class="col-12" style="padding: 0;">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Deseo recibir promociones en mi mail</span>
                                        </label>
                                    </div>
                                    <div class="col-12" style="padding: 0;">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">* Acepto ser mayor de edad y poseer licencia de conducir</span>
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="pais" class="col-sm-3 col-form-label" style="font-weight: bold;">País *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="pais" id="pais" ng-model="pais" placeholder="Pais" required />
                                    <span class="help-block error" ng-show="formDataClient.pais.$invalid && formDataClient.pais.$touched">
                                        <small class="form-text text-danger text-right">País es requerido</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label" style="font-weight: bold;">Ciudad *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="city" id="city" ng-model="city" placeholder="Ciudad" required />
                                    <span class="help-block error" ng-show="formDataClient.city.$invalid && formDataClient.city.$touched">
                                        <small class="form-text text-danger text-right">Ciudad es requerida</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-3 col-form-label" style="font-weight: bold;">Teléfono *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control colours" name="phone" id="phone" ng-model="phone" placeholder="Teléfono" required />
                                    <span class="help-block error" ng-show="formDataClient.phone.$invalid && formDataClient.phone.$touched">
                                        <small class="form-text text-danger text-right">Teléfono es requerido</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastnames" class="col-sm-3 col-form-label" style="font-weight: bold;"></label>
                                <div class="col-sm-9">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" name="term_cond" class="custom-control-input" required />
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description" style="color: darkred;"> * Acepto Términos y Condiciones</span>
                                    </label>
                                    <span class="help-block error" ng-show="formDataClient.term_cond.$invalid && formDataClient.term_cond.$touched">
                                        <small class="form-text text-danger text-right">Es requerido</small>
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>


                <div class="row">

                    <div class="col-sm-6 col-12">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12" style="background-color: #e0e0e0; height: 130px; color: #1a237e;">
                                    <div class="col-12 text-center">
                                        <span style="font-size: 12px; font-weight: bold;">Retiro</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span style="font-size: 24px; font-weight: bold;">{{data_retiro_code}}</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span>{{data_retiro_place}}</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span>{{data_retiro_date}} a las {{data_retiro_hour}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="col-12" style="background-color: #e0e0e0; height: 130px; color: #1a237e;">
                                    <div class="col-12 text-center">
                                        <span style="font-size: 12px; font-weight: bold;">Entrega</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span style="font-size: 24px; font-weight: bold;">{{data_entrega_code}}</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span>{{data_entrega_place}}</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span>{{data_entrega_date}} a las {{data_entrega_hour}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 text-center">
                                <img class="img-fluid" src="{{title_carimage}}" alt="" style="max-width: 60%;">
                            </div>

                            <div class="col-12 text-center">
                                <span style="font-size: 18px; font-weight: bold;">{{title_carmodel}} </span>
                                <br>
                                {{title_carbrand}}
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-12">
                        <div class="col-12" style="color: darkred;">
                            Renta por: {{rest_day}} días
                        </div>
                        <table class="table table-bordered border-left-0 border-right-0 border-bottom-0 w-100">
                            <tbody>
                            <tr ng-repeat="item_selectservice in selectServiceList">
                                <td class="border-0" style="font-weight: bold; text-transform: uppercase;">{{item_selectservice.service}}</td>
                                <td class="border-0 text-right" style="width: 25% !important;">$ {{item_selectservice.price}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered border-left-0 border-right-0 w-100">
                            <tbody>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">SUBTOTAL</td>
                                <td class="border-0 text-right" style="color: darkred;">$ {{subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">IVA</td>
                                <td class="border-0 text-right" style="color: darkred;">$ {{iva}}</td>
                            </tr>
                            <tr>
                                <td class="border-0" style="font-weight: bold;">TOTAL</td>
                                <td class="border-0 text-right" style="color: darkred; font-weight: bold; font-size: 28px;">$ {{total}}</td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="col-12 text-right w-100" style="margin-bottom: 50px;">
                            <button type="button" class="btn btn-outline-dark" ng-click="showModal(3)" style="font-size: 12px !important; ">
                                Regresar
                            </button>

                            <button type="button" class="btn btn-danger" ng-disabled="formDataClient.$invalid" ng-click="showModal(5)" style="font-size: 12px !important; ">
                                PROCESAR
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- FORMULARIO RESERVA PASO 5 -->

        <div class="col-12" ng-show="reserva_1 == 5">

            <div class="row">

                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">1. Seleccionar</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">2. Servicios</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: #6c757d !important; font-weight: bold; text-decoration: none;">3. Datos Personales</a>
                    <hr>
                </div>
                <div class="col-12 col-sm-3">
                    <a href="" ng-click="" style="color: darkred !important; font-weight: bold; text-decoration: none;">4. Datos de Pagos</a>
                    <hr class="estilo">
                </div>

            </div>

            <div class="row" style="margin-top: 20px;">

                <div class="col-sm-6 col-12">
                    <table class="table table-bordered border-left-0 border-right-0 border-top-0  border-bottom-0 table-sm">
                        <tbody>
                        <tr>
                            <th class="border-0" scope="row">Nombre</th>
                            <td class="border-0">{{names}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Apellidos</th>
                            <td class="border-0">{{lastnames}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Correo</th>
                            <td class="border-0">{{email}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Agencia Retiro</th>
                            <td class="border-0">{{data_retiro_place}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Agencia Entrega</th>
                            <td class="border-0">{{data_entrega_place}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Fecha Retiro</th>
                            <td class="border-0">{{data_retiro_date}} - {{data_retiro_hour}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Fecha Devolución</th>
                            <td class="border-0">{{data_entrega_date}} - {{data_entrega_hour}}</td>
                        </tr>
                        <tr>
                            <th class="border-0" scope="row">Renta por</th>
                            <td class="border-0">{{rest_day}} días</td>
                        </tr>
                        </tbody>
                    </table>


                    <div class="col-12 text-center" style="margin-top: 5px;" id="accRegister">
                        <p style="color: #014c8c; font-size: 20px;">
                            <a href="" ng-click="showDataRegister()">¿Desea quedar registrado con nosotros para futuras rentas?</a>
                        </p>
                    </div>

                </div>

                <div class="col-sm-6 col-12">

                    <table class="table table-bordered border-left-0 border-right-0 border-bottom-0">
                        <tbody>
                        <tr ng-repeat="item_selectservice in selectServiceList">
                            <td class="border-0" style="font-weight: bold; text-transform: uppercase;">{{item_selectservice.service}}</td>
                            <td class="border-0 text-right" style="width: 25% !important;">$ {{item_selectservice.price}}</td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered border-left-0 border-right-0">
                        <tbody>
                        <tr>
                            <td class="border-0" style="font-weight: bold;">SUBTOTAL</td>
                            <td class="border-0 text-right" style="color: darkred;">$ {{subtotal}}</td>
                        </tr>
                        <tr>
                            <td class="border-0" style="font-weight: bold;">IVA</td>
                            <td class="border-0 text-right" style="color: darkred;">$ {{iva}}</td>
                        </tr>
                        <tr>
                            <td class="border-0" style="font-weight: bold;">TOTAL</td>
                            <td class="border-0 text-right" style="color: darkred; font-weight: bold; font-size: 28px;">$ {{total}}</td>
                        </tr>

                        </tbody>
                    </table>

                </div>

            </div>

            <div class="row">
                <div class="col-sm-6 col-12">

                </div>

                <div class="col-sm-6 col-12">

                    <div class="col-12" style="font-size: 10px; color: #6c757d;">
                        <p>
                            *Si la devolución del vehículo se la hace en una ciudad diferente a la de retiro, su factura tendrá un recargo adicional.
                        </p>
                        <p>
                            *Si retira o devuelve un vehículo en el aeropuerto Guayaquil se le cobrará un valor de 2.24 incluido impuestos por Fee Aeropuerto.
                        </p>
                        <p>
                            *Si retira un vehículo en el aeropuerto de Quito se le cobrará un valor del 8% adicional sobre el subtotal de los valores contratados por Fee Aeropuerto
                        </p>
                        <p>
                            *Esto es una Pre-Reserva, AVIS se comunicara con usted para confirmarla.
                        </p>
                    </div>

                    <hr>

                    <div class="col-12" style="margin-top: 15px;" id="btn_paypal">
                        <button type="button" class="btn btn-info btn-lg btn-block" style="font-weight: bold;"
                                ng-click="save()">
                            <i class="fa fa-paypal" aria-hidden="true"></i> PayPal $ {{total}}
                        </button>
                    </div>

                    <div class="col-12" style="margin-top: 15px;" id="btn_caja">
                        <button type="button" class="btn btn-primary btn-lg btn-block" style="font-weight: bold;"
                                ng-click="save()">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Caja $ {{total}}
                        </button>
                    </div>

                    <hr>

                    <div class="col-12" style="background-color: darkred; padding-top: 3%; padding-bottom: 3%; display: none;">
                        <form>

                            <div class="col-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="color: #FFF; font-weight: bold;">Realice el pago para poder completar su reserva</label>
                                    <input type="text" class="form-control colours" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control colours" id="numtarjeta" ng-model="numtarjeta" placeholder="Numero de Tarjeta">
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <input type="text" class="form-control colours" ng-model="mmaa" placeholder="MM / AA">
                                    <input type="text" class="form-control colours" ng-model="cvc" placeholder="CVC">
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 15px;">
                                <button type="button" class="btn btn-light btn-lg btn-block" style="color: darkred; font-weight: bold;"
                                    ng-click="save()" disabled>
                                    PAGAR $ {{total}}
                                </button>
                            </div>

                            <div class="col-12" style="margin-top: 25px;">
                                <p style="color: #FFF; font-size: 12px;">
                                    This payment is being securely processed by Kushki, a Level 1 PCI payment provider. Learn
                                </p>
                            </div>

                        </form>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <p style="color: #014c8c; font-size: 20px;">
                            ¿Tienes alguna pregunta?
                        </p>
                    </div>
                    <div class="col-12">
                        <p style="color: #014c8c; font-size: 20px;">
                            Comunícate con nosotros al
                        </p>
                    </div>
                    <div class="col-12">
                        <p style="color: darkred; font-size: 20px;">
                            1800 - NAZCAR
                        </p>
                    </div>

                </div>
            </div>


        </div>


        <div class="modal fade" id="modalMessagePlace" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-info">
                        <h5 class="modal-title">Lugar de {{type_place_text}}</h5>
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
                            <div class="col-8">
                                <div class="col-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
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
                        <span class="text_style">{{title_carbrand}}</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="text_style2">{{title_carmodel}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <img class="img-fluid" src="{{title_carimage}}" alt="" style="max-width: 100%;">
                            </div>
                            <div class="col-6" style="padding-left: 10%;">

                                <div class="row">
                                    {{cant_pasajeros}} Pasajero(s) <br>
                                    {{cant_equipajes}} Equipaje(s) <br>
                                    {{tipo_fuel}} <br>
                                    {{tipo_transmission}}
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-12" style="padding: 0;">COSTO</div>
                                    <div class="col-12" style="padding: 0;">
                                        $ <span style="font-weight: bold; font-size: 24px; color: #6c757d;">{{title_rentcost}}</span>
                                    </div>
                                    <div class="col-12" style="padding: 0;">DIARIO</div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm" ng-click="showModal(3, 'caja')" style="font-size: 12px !important; ">
                            PAGO CAJA
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" ng-click="showModal(3, 'paypal')" style="font-size: 12px !important; ">
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

        <div class="modal fade" id="modalRegister" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h5 class="modal-title">{{title_modal_register}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Email: </span>
                                    <input type="text" class="form-control" id="registeremail" name="registeremail" ng-model="registeremail" disabled />
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Password: </span>
                                    <input type="password" class="form-control" id="registerpassword" name="registerpassword" ng-model="registerpassword" />
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px; display: none;" id="view-failed-login">
                                <div class="alert alert-danger" style="font-size: 11px;" role="alert">{{text_failed}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" ng-click="cancelRegister()">
                            Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-primary" ng-click="okRegister()">
                            Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
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

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 15
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {

                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                //infoWindow.setContent('Location found.');
                map.setCenter(pos);

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    draggable:true
                });


            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }
</script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBetlhxbUjMSwBWLtgLrHtZlecWmwpH_jI&libraries=places"></script>

</html>