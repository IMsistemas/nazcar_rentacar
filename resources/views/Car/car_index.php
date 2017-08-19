<!DOCTYPE html>
<html lang="en" ng-app="reservationApp">
<head>
    <meta charset="UTF-8">
    <title>NCR-7</title>

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


<div class="container" style="margin-top: 10px;" ng-controller="CarController">

    <div class="col-xs-12">
        <h4>Registro de Autos</h4>
        <hr>
    </div>

    <div class="col-12 text-right" style="margin-top: 5px;">
        <button type="button" class="btn btn-primary" onclick="showModal('modalMessagePrimaryAdd')">
            Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
    </div>

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
            <tr>
                <td>IMAGEN</td>
                <td>MODELO</td>
                <td>MARCA</td>
                <td>TIPO</td>
                <td>PROPIETARIO</td>
                <td>COSTO RENTA</td>
                <td>ACCIONES</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Detalle" onclick="showModal('modalMessageInfo')">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="showModal('modalMessagePrimaryEdit')">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" onclick="showModal('modalMessagePrimary')">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
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
                    text
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" >
                        Anular <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
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
                    toda la informacion del cliente
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
                    <div class="row">
                        <div class="col-sm-6 col-12" style="padding: 0;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Marca: </span>
                                    <select class="form-control" ng-model="car_brand"></select>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Modelo: </span>
                                    <select class="form-control" ng-model="car_model"></select>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Año: </span>
                                    <input type="text" class="form-control" ng-model="year"/>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo: </span>
                                    <input type="text" class="form-control" ng-model="car_type"/>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Serie Motor: </span>
                                    <input type="text" class="form-control" ng-model="serial_motor"/>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Serie Auto: </span>
                                    <input type="text" class="form-control" ng-model="serial_car"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <img src="https://www.autoefectivo.com/img/auto.png" style="width: 100%">
                            <input type="file" class="form-control" ng-model="car_img"/>
                        </div>
                    </div>



                    <div class="row" style="margin-top: 5px;">
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Propietario: </span>
                                <input type="text" class="form-control" ng-model="name_owner"/>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Compañia Seguro: </span>
                                <input type="text" class="form-control" ng-model="insurance_company"/>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Código Seguro: </span>
                                <input type="text" class="form-control" ng-model="secure_code"/>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Renta: </span>
                                <input type="text" class="form-control" ng-model="rent_cost"/>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Adicional: </span>
                                <input type="text" class="form-control" ng-model="aditional_cost"/>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMessagePrimaryAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title">Agregar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-6 col-12" style="padding: 0;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Marca: </span>
                                    <select class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Modelo: </span>
                                    <select class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Año: </span>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo: </span>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Serie Motor: </span>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Serie Auto: </span>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <img src="https://www.autoefectivo.com/img/auto.png" style="width: 100%">
                            <input type="file" class="form-control" />
                        </div>
                    </div>



                    <div class="row" style="margin-top: 5px;">
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Propietario: </span>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Compañia Seguro: </span>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Codigo Seguro: </span>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Renta: </span>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Adicional: </span>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

<script src="<?= asset('../app/js/controllers/Car/carController.js') ?>"></script>
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