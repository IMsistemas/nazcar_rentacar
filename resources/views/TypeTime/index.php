

<div class="container" style="margin-top: 10px;" ng-controller="typeTimeController" ng-init="initLoad(1)">
	
	<div class="col-xs-12">
		<h4>Registro de Tipos de Calculos x Días</h4>
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
					<th>NOMBRE</th>
                    <th style="width: 10%;">CANT. DIAS</th>
                    <th style="width: 25%;">TIPO CLIENTE</th>
                    <th style="width: 10%;">TIPO CALCULO</th>
                    <th style="width: 10%;">CONSTANTE</th>
					<th style="width: 12%;">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="item in list | orderBy:sortKey:reverse | filter:buscquedamarca | itemsPerPage:10" total-items="totalItems" ng-cloak>
					
					<td>{{ $index + 1 }}</td>
					<td>{{ item.nametypetime }}</td>
                    <td>{{ item.amountday }}</td>
                    <td>
                        <span ng-show="item.typeclient == 0">Cliente No Corporativo</span>
                        <span ng-show="item.typeclient == 1">Cliente Corporativo</span>
                    </td>
                    <td>{{ item.typecalculate }}</td>
                    <td>{{ item.constant }}</td>
					<td class="text-center">

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="edit(item)" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="editState(item)" >
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
                    <form class="form-horizontal" name="formTypeTime" novalidate="">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre: </span>
                                    <input type="text" class="form-control" id="nametypetime" name="nametypetime" ng-model="nametypetime" required />
                                </div>
                                <span class="help-block error" ng-show="formTypeTime.nametypetime.$invalid && formTypeTime.nametypetime.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Cantidad Días: </span>
                                    <input type="text" class="form-control" id="amountday" name="amountday" ng-model="amountday" required />
                                </div>
                                <span class="help-block error" ng-show="formTypeTime.price.$invalid && formTypeTime.price.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">Cantidad de Días es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo Cliente: </span>
                                    <select class="form-control" id="typeclient" name="typeclient" ng-model="typeclient" required>
                                        <option value="">-- Seleccione --</option>
                                        <option value="0">Cliente No Corporativo</option>
                                        <option value="1">Cliente Corporativo</option>
                                    </select>
                                </div>
                                <span class="help-block error" ng-show="formTypeTime.typeclient.$invalid && formTypeTime.typeclient.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Tipo Cliente es requerido</small>
                                </span>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo Cálculo: </span>
                                    <select class="form-control" id="typecalculate" name="typecalculate" ng-model="typecalculate">
                                        <option value="">-- Ninguno --</option>
                                        <option value="#"># (Númerico)</option>
                                        <option value="%">% (Porcentaje)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 5px;">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Constante: </span>
                                    <input type="text" class="form-control" id="constant" name="constant" ng-model="constant" required />
                                </div>
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
                            Está seguro que desea cambiar el estado de: <strong>{{name_typetime}}</strong>
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