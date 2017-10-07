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
        <img src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
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
            <li class="nav-item">
                <a class="nav-link" href="#car">Vehiculos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Marca">Marcas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Modelo">Modelos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#transmission">Transmisión</a>
            </li>
        </ul>
        <span class="navbar-text">
      Navbar text with an inline element
    </span>
    </div>
</nav>

<div ng-view ng-cloak>

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


<script src="<?= asset('../app/js/controllers/FormaPago/PagoController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/ModeloAuto/ModeloController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/MarcaAuto/MarcaController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Transmission/transmissionController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Car/carController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/client/clientController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/rent/rentController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/Index/indexController.js') ?>"></script>
<script src="<?= asset('../app/js/controllers/indexReservation/indexReservationController.js') ?>"></script>

</html>