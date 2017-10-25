<!DOCTYPE html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <title>Payapal</title>

    <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet" />

    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>

        .modal-header-success {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #5cb85c;
            /*-webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;*/
        }
        .modal-header-warning {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #f0ad4e;
            /*-webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;*/
        }
        .modal-header-danger {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #d9534f;
            /*-webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;*/
        }
        .modal-header-info {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #5bc0de;
            /*-webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;*/
        }
        .modal-header-primary {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #428bca;
            /*-webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;*/
        }

        .btn {
            border-radius: 0px !important;
        }

        .modal .modal-content .modal-dialog .modal-footer{
            border-radius: 0px !important;
        }

    </style>


</head>
<body>


<div class="container" style="margin-top: 10px;" ng-controller="PaypalLaravelController" >

    <!--<div class="col-xs-12">
        <h4> {{Title}}</h4>
        <hr>
    </div>-->


    <!--<button type="button" class="btn btn-primary" ng-click="paypal_init()" >
        Pagar <i class="fa fa-paypal" aria-hidden="true"></i> 
    </button>-->

    <?php 
        if(isset($data)){
            if($data["estado"]!="Ok"){
                echo "
                    <div class='alert alert-danger' role='alert'>
                      <strong>Error al realizar el pago</strong>
                    </div>
                ";

            }else{
                echo "
                    <div class='alert alert-success' role='alert'>
                      <strong>Se realizo correctamente el pago</strong>
                    </div>
                ";
            }
        }
    ?>

</div>



</body>

   
    <script src="<?= asset('../lib/jquery/jquery-3.2.1.min.js') ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
    
    <script src="<?= asset('../lib/bootstrap4/js/bootstrap.min.js') ?>"></script>
    


    <script src="<?= asset('../lib/bootstrap-datetimepicker/moment.min.js') ?>"></script>
    <script src="<?= asset('../lib/bootstrap-datetimepicker/es.js') ?>"></script>
    <script src="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>


    <script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
    <script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
    <script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
    <script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
    <script src="<?= asset('../lib/dirPagination.js') ?>"></script>

    <script src="<?= asset('../app/js/app_system.js') ?>"></script>

    <script src="<?= asset('../app/js/controllers/Paypal/PaypalController.js') ?>"></script>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function showModal(id)
    {
        $('#' + id).modal('show')
    }

</script>

</html>