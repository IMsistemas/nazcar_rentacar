

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
                <select class="form-control" value="" name="statefilter" id="statefilter" ng-model="statefilter" ng-change="initLoad(1)">
                    <option value="1">ACTIVOS</option>
                    <option value="0">INACTIVOS</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
            <tr>
                <th>NO.</th>
                <th>APELLIDOS NOMBRE(S)</th>
                <th>IDENTIFICACION</th>
                <th>NO. TELEFONO</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
            </thead>
            <tbody>
            <tr dir-paginate="item in list|orderBy:sortKey:reverse| itemsPerPage:10" total-items="totalItems" ng-cloak>
                <td>{{$index + 1}}</td>
                <td>{{item.lastnameperson + ", " + item.nameperson}}</td>
                <td>{{item.identifyperson}}</td>
                <td>{{item.numphoneperson}}</td>
                <td ng-show="item.state == '1'">Activo</td>
                <td ng-show="item.state == '0'">Inactivo</td>
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
                    <strong>Dirección: </strong>{{address}}<br>
                    <strong>Actividad Económica: </strong>{{activity}}<br>
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



<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function showModal(id)
    {
        $('#' + id).modal('show')
    }

</script>

