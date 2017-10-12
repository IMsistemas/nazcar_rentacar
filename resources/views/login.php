<!doctype html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - NAZCAR</title>

    <link href="<?= asset('../lib/bootstrap-4/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('../lib/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">

    <link href="<?= asset('../app/css/main.css') ?>" rel="stylesheet">

</head>
<body ng-controller="loginController">


    <div class="container">

        <div class="row">
            <div class="col-12 col-sm-4"></div>
            <div class="col-12 col-sm-4">

                <div class="card text-center" style="margin-top: 15%;">
                    <div class="card-header">
                        ENTRAR
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" name="formLogin" novalidate="">

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Usuario: </span>
                                    <input type="text" class="form-control" id="users" name="users" ng-model="users" required />
                                </div>
                                <span class="help-block error" ng-show="formLogin.users.$invalid && formLogin.users.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Usuario es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Password: </span>
                                    <input type="password" class="form-control" id="password" name="password" ng-model="password" required />
                                </div>
                                <span class="help-block error" ng-show="formLogin.password.$invalid && formLogin.password.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Password es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px; display: none;" id="view-failed-login">
                                <div class="alert alert-danger" style="font-size: 11px;" role="alert">{{text_failed}}</div>
                            </div>

                        </form>

                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary" ng-click="verify()" ng-disabled="formLogin.$invalid">
                            Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-4"></div>
        </div>

    </div>


</body>

<script src="<?= asset('../lib/jquery/jquery-3.2.1.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script src="<?= asset('../lib/bootstrap-4/dist/js/bootstrap.min.js') ?>"></script>



<script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
<script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
<script src="<?= asset('../lib/dirPagination.js') ?>"></script>

<script src="<?= asset('../app/js/app_system.js') ?>"></script>

<script src="<?= asset('../app/js/controllers/Login/loginController.js') ?>"></script>


</html>