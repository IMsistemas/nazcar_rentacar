

<div class="container" style="margin-top: 10px;" ng-controller="serviceController" ng-init="initLoad(1)">
	
	<div class="col-xs-12">
		<h4>Registro de Tipos de Servicios</h4>
		<hr>
	</div>

	<div class="row " style="margin-top: 5px;">
		
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
			<button type="button" class="btn btn-primary" ng-click="add()" >
	            Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i> 
	        </button>
		</div>

		
	</div>

	<div class="row">
	<div class="col-12" style="margin-top: 10px;">
		<table class="table table-responsive table-striped table-hover table-condensed table-bordered">
			<thead class="bg-primary">
				<tr>
					<th style="width: 5%;">NO.</th>
					<th>TIPO SERVICIO</th>
                    <th style="width: 15%;">COSTO</th>
                    <th style="width: 25%;">TIPO</th>
					<th style="width: 15%;">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="item in list | orderBy:sortKey:reverse | filter:buscquedamarca | itemsPerPage:10" total-items="totalItems" ng-cloak>
					
					<td>{{ $index + 1 }}</td>
					<td>{{ item.service }}</td>
                    <td>{{ item.price }}</td>
                    <td>
                        <span ng-show="item.type == 0">SERVICIOS ADICIONALES</span>
                        <span ng-show="item.type == 1">OTROS SERVICIOS</span>
                    </td>
					<td>
			            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="edit(item)" >
			                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			            </button>
			            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="editState(item)" >
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
            max-size="10"
            direction-links="true"
            boundary-links="true" >
        </dir-pagination-controls>
	</div>
	</div>


    <div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title">{{title_modal_action}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" name="formService" novalidate="">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Servicio: </span>
                                    <input type="text" class="form-control" id="service" name="service" ng-model="service" required />
                                </div>
                                <span class="help-block error" ng-show="formService.service.$invalid && formService.service.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Servicio es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Costo: </span>
                                    <input type="text" class="form-control" id="price" name="price" ng-model="price" required />
                                </div>
                                <span class="help-block error" ng-show="formService.price.$invalid && formService.price.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Costo es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo: </span>
                                    <select class="form-control" id="type" name="type" ng-model="type" required>
                                        <option value="">-- Seleccione --</option>
                                        <option value="0">SERVICIOS ADICIONALES</option>
                                        <option value="1">OTROS SERVICIOS</option>
                                    </select>
                                </div>
                                <span class="help-block error" ng-show="formService.type.$invalid && formService.type.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Tipo es requerido</small>
                                </span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="save()" ng-disabled="formService.$invalid">
                        Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
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

    <div class="modal fade" id="modalSetState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            Está seguro que desea cambiar el estado de: <strong>{{name_service}}</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-danger" ng-click="saveSetState()">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>