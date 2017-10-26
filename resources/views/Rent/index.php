

<div class="container" style="margin-top: 10px;" ng-controller="RentController" ng-init="initLoad(1)">
    <div class="col-xs-12">
        <h4>Listado de Rentas</h4>
        <hr>
    </div>

    <div class="row" style="margin-top: 5px; margin-left: 5px">
        <div class="col-3" style="margin-top: 3px;">
            <div class="form-group has-feedback" style="margin-top: 3px;">
                <input type="text" class="form-control" id="buscar" placeholder="Buscar..." ng-model="buscar" ng-keyup="initLoad(1)">
                <span class="fa fa-search form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="col-3" style="margin-top: 3px;">
            <div class="input-group">
                <span class="input-group-addon">Cliente: </span>
                <select class="form-control" name="clientfilter" id="clientfilter" ng-model="clientfilter" ng-change="initLoad(1)"
                        ng-options="value.id as value.label for value in clientslist" ></select>
            </div>
        </div>
        <div class="col-3" style="margin-top: 3px;">
            <div class="input-group">
                <span class="input-group-addon">Marca: </span>
                <select class="form-control" name="carBrandfilter" id="carBrandfilter" ng-model="carBrandfilter" ng-change="initLoad(1)"
                        ng-options="value.id as value.label for value in carBrandlist" ></select>
            </div>
        </div>
        <div class="col-3" style="margin-top: 3px;">
            <div class="input-group">
                <span class="input-group-addon">Estado: </span>
                <select class="form-control" name="statefilter" id="statefilter" ng-model="statefilter" ng-change="initLoad(1)">
                    <option value="1">Activas</option>
                    <option value="0">Inactivas</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 10px;">
        <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
            <thead class="bg-primary">
            <tr>
                <th style="width: 5px">NO.</th>
                <th style="width: 15px">CLIENTE</th>
                <th style="width: 15px">AUTO</th>
                <th style="width: 15px">MODELO</th>
                <th style="width: 8px">AÑO</th>
                <th style="width: 12px">FECHA INICIO</th>
                <th style="width: 12px">FECHA FIN</th>
                <th style="width: 12px">COSTO</th>
                <th style="width: 10px">ACCIONES</th>
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
                <td class="text-right">$ {{item.totalcost}}</td>
                <td class="text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Detalle" ng-click="showModalInformation(item)">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                        <!--button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="showModal('modalMessagePrimaryEdit')">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button-->
                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="showModalChangeEstate(item)">
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
                max-size="10"
                direction-links="true"
                boundary-links="true" >
        </dir-pagination-controls>
    </div>

    <div class="modal fade" id="modalMessageError" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-info">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Mensaje}}
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
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
                    Anular Reserva
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" ng-click="ok_anular();" >
                        Anular <i class="fa fa-ban" aria-hidden="true"></i>
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
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{mensaje}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-info">
                    <h5 class="modal-title">Información de la Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            Cliente<hr>
                            Nombre y Apellidos: {{client}}<br>
                            Identificación: {{idclient}}<br>
                            No. Teléfono: {{phoneperson}}<br>
                            No. Celular: {{celperson}}<br>
                            Dirección: {{addressperson}}
                        </div>
                        <div class="col-6">
                            Auto<hr>
                            Marca: {{carbrand}}<br>
                            Modelo: {{carmodel}}<br>
                            Año: {{year}}<br>
                            Propietario: {{nameowner}}<br>
                            Aseguradora: {{insurancecompany}}<br>
                            Código de Seguro: {{securecode}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            Reserva<hr>
                            <div class="row">
                                <div class="col-4">
                                    Fecha Inicio: <br>{{startdate}}
                                </div>
                                <div class="col-4">
                                    Fecha Entrega: <br>{{enddate}}
                                </div>
                                <div class="col-4">
                                    Costo Total: <br>{{totalcost}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


