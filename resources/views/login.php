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

    <link href="<?= asset('../lib/textAngular/dist/textAngular.css') ?>" rel="stylesheet">

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

                            <div class="col-12 text-center" style="margin-top: 10px;">
                                <a href="#" ng-click="showConfirm()">Recuperar Password</a>
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
            <div class="col-12 col-sm-4">

            </div>
        </div>

    </div>

    <div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            Está seguro que desea cambiar el Password?. El nuevo sera enviado por email a la direccion registrada.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-info" ng-click="resetPassword()">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            {{message_success}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            {{message_error}}
                        </div>
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

<script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
<script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
<script src="<?= asset('../lib/dirPagination.js') ?>"></script>

<script src="<?= asset('../lib/textAngular/dist/textAngular-rangy.min.js') ?>"></script>
<script src="<?= asset('../lib/textAngular/dist/textAngular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/textAngular/dist/textAngular.min.js') ?>"></script>

<script src="<?= asset('../app/js/app_system.js') ?>"></script>

<script src="<?= asset('../app/js/controllers/Login/loginController.js') ?>"></script>


</html>