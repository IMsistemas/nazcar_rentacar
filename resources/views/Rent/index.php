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


<div class="container" style="margin-top: 10px;" ng-controller="RentController" ng-init="initLoad(1)">
    <div class="col-xs-12">
        <h4>Listado de Rentas</h4>
        <hr>
    </div>

    <!--div class="col-12 text-right" style="margin-top: 5px;">
        <button type="button" class="btn btn-primary" onclick="showModal('modalMessagePrimaryAdd')">
            Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
    </div-->

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
            <tr>
                <td style="width: 5px">NO.</td>
                <td style="width: 20px">CLIENTE</td>
                <td style="width: 15px">MARCA AUTO</td>
                <td style="width: 15px">MODELO AUTO</td>
                <td style="width: 10px">AÑO AUTO</td>
                <td style="width: 12px">FECHA INICIO</td>
                <td style="width: 12px">FECHA FIN</td>
                <td style="width: 10px">ACCIONES</td>
            </tr>
            </thead>
            <tbody>
            <tr dir-paginate="item in list|orderBy:sortKey:reverse| itemsPerPage:10" total-items="totalItems" ng-cloak >
                <td>{{$index + 1}}</td>
                <td>{{item.nameperson + item.lastnameperson}}</td>
                <td>{{item.namecarbrand}}</td>
                <td>{{item.namecarmodel}}</td>
                <td>{{item.year}}</td>
                <td>{{item.startdatetime}}</td>
                <td>{{item.enddatetime}}</td>
                <td  class="text-center">
                    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Detalle" onclick="showModal('modalMessageInfo')">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </button>
                    <!--button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="showModal('modalMessagePrimaryEdit')">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" onclick="showModal('modalMessagePrimary')">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button-->
                </td>
            </tr>
            </tbody>
        </table>
        <dir-pagination-controls

                on-page-change="pageChanged(newPageNumber)"

                template-url="dirPagination.html"

                class="pull-right"
                max-size="1"
                direction-links="true"
                boundary-links="true" >
        </dir-pagination-controls>
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

<script src="<?= asset('../app/js/controllers/rent/rentController.js') ?>"></script>

</html>