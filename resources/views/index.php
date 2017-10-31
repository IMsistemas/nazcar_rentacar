<!doctype html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISTEMA RESERVA NAZCAR</title>

    <link href="<?= asset('../lib/bootstrap-4/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">

    <link href="<?= asset('../lib/textAngular/dist/textAngular.css') ?>" rel="stylesheet">

    <link href="<?= asset('../app/css/main.css') ?>" rel="stylesheet">

    <style>

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
<body ng-controller="IndexController">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <!--<img src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">-->
        Nazcar
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="#rent">Rentas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#client">Clientes</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Datos Iniciales</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#Marca">Marcas</a>
                    <a class="dropdown-item" href="#Modelo">Modelos</a>
                    <a class="dropdown-item" href="#transmission">Transmisión</a>
                    <a class="dropdown-item" href="#fuel">Combustible</a>
                    <a class="dropdown-item" href="#motor">Motor</a>
                    <a class="dropdown-item" href="#car">Vehículos</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#service">Servicios</a>
                    <a class="dropdown-item" href="#typetime">Tipo Tiempo</a>
                    <a class="dropdown-item" href="#place">Sedes</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Reportes</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#topcar">Top 5 Mas Rentados</a>
                    <a class="dropdown-item" href="#countrentxmonth">Rentas x Mes</a>
                    <!--<a class="dropdown-item" href="#transmission">Rentas x Día</a>
                    <a class="dropdown-item" href="#fuel">Clientes Activos x Mes</a>
                    <a class="dropdown-item" href="#motor">Vehículos Rentados x Día</a>-->
                </div>
            </li>

        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#user">Usuarios</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#company">Empresa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#slider">Slider Principal</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="" ng-click="toLogout()">Salir</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div ng-view ng-cloak>

</div>



<div class="modal fade" id="modalConfirmLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h5 class="modal-title">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <span>¿Realmente desea cerrar sesión y salir del Sistema?</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-primary" ng-click="logoutSystem()">
                    Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                </button>
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

<script src="<?= asset('../lib/textAngular/dist/textAngular-rangy.min.js') ?>"></script>
<script src="<?= asset('../lib/textAngular/dist/textAngular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/textAngular/dist/textAngular.min.js') ?>"></script>

<script src="<?= asset('../app/js/app_system.js') ?>"></script>


<script src="<?= asset('../app/js/controllers/FormaPago/PagoController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/ModeloAuto/ModeloController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/MarcaAuto/MarcaController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Transmission/transmissionController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Fuel/fuelController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Motor/motorController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Company/companyController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Reports/reportController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Slider/sliderController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Service/serviceController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/TypeTime/typeTimeController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Place/placeController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Car/carController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/User/userController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/client/clientController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/rent/rentController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Index/indexController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/indexReservation/indexReservationController.js') ?>"></script>

</html>