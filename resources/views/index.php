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


    <div class="container" style="margin-top: 10px;" ng-controller="IndexController">
        <div class="card" style="width: 35%;">
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
                    <div class="col-12" style="margin-top: 3px;">
                        <select name="" id="" class="form-control"></select>
                    </div>
                    <div class="col-12" style="margin-top: 3px;">
                        <select name="" id="" class="form-control"></select>
                    </div>
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
                    <button type="button" class="btn btn-danger btn-lg btn-block">RESERVAR</button>
                </div>

                <div class="col-12" style="margin-top: 3px;">

                    <div class="row">
                        <div class="col-4">
                            Resetear
                        </div>
                        <div class="col-8 text-right">
                            <small id="emailHelp" class="form-text text-muted">Los campos con * son obligatorios.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</body>

<script src="<?= asset('../lib/jquery/jquery-3.2.1.min.js') ?>"></script>
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