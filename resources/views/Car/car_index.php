


<div class="container" style="margin-top: 10px;" ng-controller="CarController" ng-init="initLoad(1)">

    <div class="col-xs-12">
        <h4>Registro de Autos</h4>
        <hr>
    </div>

    <div class="row" style="margin-top: 5px;">

        <div class="col-4 ">
            <div class="input-group">
                <input type="text" class="form-control" ng-model="busqueda" ng-keyup="initLoad(1)">
                <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-4">
            <div class="input-group">
                <span class="input-group-addon">Estado: </span>
                <select class="form-control" ng-model="estado" ng-change="initLoad(1)";>
                    <option value="1">ACTIVOS</option>
                    <option value="0">ANULADOS</option>
                </select>
            </div>
        </div>
        <div class="col-4 text-right">
            <button type="button" class="btn btn-primary" ng-click="showModalAdd()">
                Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
        </div>


    </div>

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th style="width: 10%;">IMAGEN</th>
                    <th>MODELO</th>
                    <th>MARCA</th>
                    <th>PROPIETARIO</th>
                    <th style="width: 15%;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
            <tr dir-paginate="item in list|orderBy:sortKey:reverse| itemsPerPage:10" total-items="totalItems" ng-cloak>
                <td>
                    <div ng-show="item.image" class="text-center">
                        <img src="{{item.image}}" style="width: 100%;" class="">
                    </div>
                </td>
                <td>{{item.namecarmodel}}</td>
                <td>{{item.namecarbrand}}</td>
                <td>{{item.nameowner}}</td>
                <td class="text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Detalle" ng-click="showModalInfo(item)">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="showModalEdit(item)">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="change_estado(item)">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </button>
                    </div>

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

    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{message}}
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-primary" >
                        Aceptar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>-->
            </div>
        </div>
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
                    <div class="row">
                        <div class="col-12">
                            Está seguro que desea cambiar el estado de: <strong>{{name_car}}</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-danger" ng-click="ok_inactivar()">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
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
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Marca: </strong> {{car_brand}}<br>
                            <strong>Modelo: </strong>{{car_model}}<br>
                            <strong>Año: </strong>{{year}}<br>
                            <strong>Tipo de Auto: </strong>{{car_type}}<br>
                            <strong>Serial del Motor: </strong>{{serial_motor}}<br>
                            <strong>Serial del Auto: </strong>{{serial_car}}<br>
                            <strong>Cantidad de Pasajeros: </strong>{{amountpassengers}}<br>
                            <strong>Cantidad de Equipaje: </strong>{{amountluggage}}<br>
                            <strong>Propietario: </strong>{{name_owner}}<br>
                            <strong>Compañía de Seguros: </strong>{{insurance_company}}<br>
                            <strong>Código de Seguro: </strong>{{secure_code}}<br>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="{{file_view}}" style="width: 200px; height: 170px;">
                            </div>
                            <strong>Costo de Renta: </strong>{{rent_cost}}<br>
                            <strong>Costo Adicional: </strong>{{aditional_cost}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMessagePrimaryAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title">{{title_modal_action}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" name="formCar" novalidate="">
                        <div class="row">
                            <div class="col-sm-6 col-12" style="padding: 0;">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Marca: </span>
                                        <select class="form-control" ng-model="car_brand" id="car_brand" name="car_brand"
                                                ng-options="value.id as value.label for value in marcaslist" ng-change="listCarModel()" required >
                                        </select>
                                    </div>
                                    <span class="help-block error" ng-show="formCar.car_brand.$invalid && formCar.car_brand.$touched">
                                        <small id="emailHelp" class="form-text text-danger text-right">El Tipo de Marca es requerido</small>
                                    </span>
                                </div>
                                <div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Modelo: </span>
                                        <select class="form-control" ng-model="car_model" id="car_model"
                                                ng-options="value.id as value.label for value in modelos" required >
                                        </select>
                                    </div>
                                    <span class="help-block error" ng-show="formCar.car_model.$invalid && formCar.car_model.$touched">
                                        <small id="emailHelp" class="form-text text-danger text-right">El Tipo de Modelo es requerido</small>
                                    </span>
                                </div>
                                <div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo Motor: </span>
                                        <select class="form-control" ng-model="serial_motor" id="serial_motor"
                                                ng-options="value.id as value.label for value in motors" required >
                                        </select>
                                    </div>
                                    <span class="help-block error" ng-show="formCar.serial_motor.$invalid && formCar.serial_motor.$touched">
                                        <small id="emailHelp" class="form-text text-danger text-right">El Tipo de Motor es requerido</small>
                                    </span>
                                </div>
                                <div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo Combustible: </span>
                                        <select class="form-control" ng-model="serial_fuel" id="serial_fuel"
                                                ng-options="value.id as value.label for value in fuels" required >
                                        </select>
                                    </div>
                                    <span class="help-block error" ng-show="formCar.serial_fuel.$invalid && formCar.serial_fuel.$touched">
                                        <small id="emailHelp" class="form-text text-danger text-right">El Tipo de Combustible es requerido</small>
                                    </span>
                                </div>
                                <div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo Trasnmisión: </span>
                                        <select class="form-control" ng-model="serial_transmission" id="serial_transmission"
                                                ng-options="value.id as value.label for value in transmission" required >
                                        </select>
                                    </div>
                                    <span class="help-block error" ng-show="formCar.serial_transmission.$invalid && formCar.serial_transmission.$touched">
                                        <small id="emailHelp" class="form-text text-danger text-right">El Tipo de Transmision es requerido</small>
                                    </span>
                                </div>

                                <!--<div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo: </span>
                                        <input type="text" class="form-control" ng-model="car_type"/>
                                    </div>
                                </div>

                                <div class="col-12" style="margin-top: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Serie Auto: </span>
                                        <input type="text" class="form-control" ng-model="serial_car"/>
                                    </div>
                                </div>-->
                            </div>
                            <div class="col-sm-6 col-12">
                                <img ngf-src="file || url_foto" alt="" class="img-thumbnail img-fluid">
                                <input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file"
                                       accept="image/*" ngf-max-size="2MB"  ng-required="true" ngf-pattern="image/*">
                                <span class="help-block error" ng-show="formCar.file.$invalid && formCar.file.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">La imagen es requerida</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Propietario: </span>
                                    <input type="text" class="form-control" id="name_owner" name="name_owner" ng-model="name_owner" required/>
                                </div>
                                <span class="help-block error" ng-show="formCar.name_owner.$invalid && formCar.name_owner.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Propietario es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Cantidad de Pasajeros: </span>
                                    <input type="text" class="form-control" id="amountpassengers" name="amountpassengers" ng-model="amountpassengers" onkeypress="onlyNumber(e,3,amountpassengers)" required />
                                </div>
                                <span class="help-block error" ng-show="formCar.amountpassengers.$invalid && formCar.amountpassengers.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">La Cantidad de Pasajeros es requerido</small>
                                </span>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Cantidad de Equipajes: </span>
                                    <input type="text" class="form-control" id="amountluggage" name="amountluggage" ng-model="amountluggage" required />
                                </div>
                                <span class="help-block error" ng-show="formCar.amountluggage.$invalid && formCar.amountluggage.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">La Cantidad de Equipajes es requerido</small>
                                </span>
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
                            <!--<div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Costo Renta: </span>
                                    <input type="text" class="form-control" ng-model="rent_cost"/>
                                </div>
                            </div>-->
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Año: </span>
                                    <input type="text" class="form-control" ng-model="year"/>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Costo Adicional: </span>
                                    <input type="text" class="form-control" ng-model="aditional_cost"/>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="saveCar()" ng-disabled="formCar.$invalid">
                        Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>

<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function showModal(id)
    {
        $('#' + id).modal('show')
    }

</script>

