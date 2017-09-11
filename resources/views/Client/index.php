<!DOCTYPE html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <title>NCR-5</title>

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


<div class="container" style="margin-top: 10px;" ng-controller="ClientController" ng-init="initLoad(1)">

    <div class="col-xs-12">
        <h4>Registro de Clientes</h4>
        <hr>
    </div>

    <div class="row" style="margin-top: 5px; margin-left: 5px">
        <div class="col-6" style="margin-top: 3px;">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="buscar" placeholder="Buscar..." ng-model="buscar" ng-keyup="initLoad(1)">
                <!--span class="fa fa-search form-control-feedback" aria-hidden="true"></span-->
            </div>
        </div>
        <div class="col-6" style="margin-top: 3px;">
            <div class="input-group">
                <span class="input-group-addon">Estado: </span>
                <select class="form-control" value="1" name="statefilter" id="statefilter" ng-model="statefilter" ng-change="initLoad(1)">
                    <option value="1">Activos</option>
                    <option value="0">Inactivos</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
            <tr>
                <td>NO.</td>
                <td>APELLIDOS NOMBRE(S)</td>
                <td>IDENTIFICACION</td>
                <td>NO. TELEFONOS</td>
                <td>PAIS</td>
                <td>ESTADO</td>
                <td>ACCIONES</td>
            </tr>
            </thead>
            <tbody>
            <tr dir-paginate="item in list|orderBy:sortKey:reverse| itemsPerPage:10" total-items="totalItems" ng-cloak>
                <td>{{$index + 1}}</td>
                <td>{{item.lastnameperson + " " + item.nameperson}}</td>
                <td>{{item.identifyperson}}</td>
                <td>{{item.numphoneperson + " / " + item.numcelperson}}</td>
                <td>{{item.country}}</td>
                <td ng-show="1">Activo</td>
                <td ng-show="0">Inactivo</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Detalle" ng-click="showModalInformation(item)">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="showModalEdit(item)">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="showModalAnular(item)">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
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

    <div class="modal fade" id="modalMessagePrimary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Activar / Inactivar el cliente seleccionado...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" ng-click="activarInactivar()">
                        Aceptar <i class="fa fa-ok" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h5 class="modal-title">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{message}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMessageInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-info">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Nombre completo: </strong> {{client}}<br>
                    <strong>No. Identificación: </strong>{{identify}}<br>
                    <strong>Correo Electrónico: </strong>{{email}}<br>
                    <strong>No. Teléfono: </strong>{{phone}}<br>
                    <strong>No. Celular: </strong>{{cell}}<br>
                    <strong>Dirección: </strong>{{address}}<br>
                    <strong>País: </strong>{{country}}<br>
                    <strong>Actividad Económica: </strong>{{activity}}<br>
                    <strong>Forma de Pago: </strong>{{paidform}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMessagePrimaryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="form">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Apellidos: </span>
                                    <input type="text" class="form-control" ng-model="lastname" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.lastname.$invalid">Este campo es requerido</span>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre(s): </span>
                                    <input type="text" class="form-control" ng-model="name" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.name.$invalid">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Identificación: </span>
                                    <input type="text" class="form-control" ng-model="identify" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.identify.$invalid">Este campo es requerido</span>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Email: </span>
                                    <input type="text" class="form-control" ng-model="email" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.email.$invalid">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">No. Telefono: </span>
                                    <input type="text" class="form-control" ng-model="phone" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.phone.$invalid">Este campo es requerido</span>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">No. Celular: </span>
                                    <input type="text" class="form-control" ng-model="cell" required/>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.cell.$invalid">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">País: </span>
                                    <select class="form-control" name="country" id="country" ng-model="country"
                                            ng-options="value.id as value.label for value in countrylist" required></select>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.country.$invalid">Este campo es requerido</span>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Forma de pago: </span>
                                    <select class="form-control" name="paidform" id="paidform" ng-model="paidform"
                                            ng-options="value.id as value.label for value in paidlist" required ></select>
                                </div>
                                <span class="help-block error"
                                      ng-show="form.paidform.$invalid">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Dirección: </span>
                                    <input type="text" class="form-control" ng-model="address"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="edit()" ng-disabled="form.$invalid">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true" ></i>
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>



</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

<script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
<script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
<script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
<script src="<?= asset('../lib/dirPagination.js') ?>"></script>

<script src="<?= asset('../app/js/app_system.js') ?>"></script>

<script src="<?= asset('../app/js/controllers/client/clientController.js') ?>"></script>

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