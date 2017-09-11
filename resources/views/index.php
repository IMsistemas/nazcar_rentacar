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

    </style>


</head>
<body>


    <div class="container" style="margin-top: 3%;" ng-controller="IndexController">

        <!-- FORMULARIO RESERVA PASO 1 -->

        <div class="card" style="width: 35%;" ng-show="reserva_1 == 1">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_1" novalidate="">

                    <div class="col-12" style="margin-top: 30px !important;">
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
                    <!--<div class="col-12" style="margin-top: 3px;">
                        <select name="" id="" class="form-control"></select>
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <select name="" id="" class="form-control"></select>
                    </div>-->
                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" placeholder="Fecha estimada para el Alquiler *" />
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" placeholder="Tiempo *" />
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <textarea cols="30" rows="5" class="form-control" placeholder="Comentarios Adicionales" ></textarea>
                    </div>
                </form>

                <div class="col-12" style="margin-top: 10px;" ng-disabled="formReserva_1.$invalid">
                    <button type="button" class="btn btn-danger btn-lg btn-block" ng-click="showModal(1)">RESERVAR</button>
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

        <!-- FORMULARIO RESERVA PASO 2 -->

        <div class="card" style="width: 35%;" ng-show="reserva_1 == 2">
            <div class="card-body">

                <h4 class="card-title text-center">Haz tu Reserva</h4>

                <form class="form-horizontal" name="formReserva_2" novalidate="">

                    <div class="col-12" style="margin-top: 30px !important;">
                        <select class="form-control" name="lugar_retiro" id="lugar_retiro" ng-model="lugar_retiro" required></select>
                        <span class="help-block error" ng-show="formReserva_2.lugar_retiro.$invalid && formReserva_2.lugar_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Retiro es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" name="fecha_retiro" id="fecha_retiro" ng-model="fecha_retiro" placeholder="Fecha y Hora para el Retiro *" required />
                        <span class="help-block error" ng-show="formReserva_2.fecha_retiro.$invalid && formReserva_2.fecha_retiro.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">La Fecha y Hora de Retiro es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Mismo Lugar de Entrega
                            </label>
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <select class="form-control" name="lugar_entrega" id="lugar_entrega" ng-model="lugar_entrega" required></select>
                        <span class="help-block error" ng-show="formReserva_2.lugar_entrega.$invalid && formReserva_2.lugar_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">El Lugar de Entrega es requerido</small>
                        </span>
                    </div>

                    <div class="col-12" style="margin-top: 3px;">
                        <input class="form-control" name="fecha_entrega" id="fecha_entrega" ng-model="fecha_entrega" placeholder="Fecha y Hora para la Entrega *" required />
                        <span class="help-block error" ng-show="formReserva_2.fecha_entrega.$invalid && formReserva_2.fecha_entrega.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">La Fecha y Hora de Entrega es requerido</small>
                        </span>
                    </div>



                </form>

                <div class="col-12" style="margin-top: 10px;" ng-disabled="formReserva_2.$invalid">
                    <button type="button" class="btn btn-danger btn-lg btn-block" ng-click="showModal(2)">RESERVAR (2)</button>
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

        <div class="card" style="width: 45%;" ng-show="reserva_1 == 3">
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

                <div class="col-12" style="margin-top: 10px;" ng-disabled="formReserva_3.$invalid">
                    <button type="button" class="btn btn-danger btn-lg btn-block" ng-click="showModal(3)">RESERVAR (3)</button>
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
                                <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                <td>Protección y cobertura 1 daño a terceros</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
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
                                    <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                    <td>Asiento(s) de Bebe</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                    <td>Conductor Autorizado</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                    <td>GPS</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                                    <td>Servicio de Chofer</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </form>

                <div class="col-12" style="margin-top: 10px;" ng-disabled="formReserva_3.$invalid">
                    <button type="button" class="btn btn-danger btn-lg btn-block" ng-click="showModal(4)">RESERVAR (4)</button>
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

<script src="<?= asset('../app/js/controllers/indexReservation/indexController.js') ?>"></script>

</html>