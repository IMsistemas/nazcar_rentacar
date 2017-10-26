

<div class="container" style="margin-top: 10px;" ng-controller="userController" ng-init="initLoad(1)">
	
	<div class="col-xs-12">
		<h4>Registro de Usuarios del Sistema</h4>
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
					<th>NOMBRE Y APELLIDOS</th>
                    <th>USUARIO</th>
                    <th>EMAIL</th>
					<th style="width: 15%;">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="item in list | orderBy:sortKey:reverse | filter:buscquedamarca | itemsPerPage:10" total-items="totalItems" ng-cloak>
					
					<td>{{ $index + 1 }}</td>
					<td>{{ item.nameperson }} {{ item.lastnameperson }}</td>
                    <td>{{ item.users }}</td>
                    <td>{{ item.emailperson }}</td>
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
                    <form class="form-horizontal" name="formUser" novalidate="">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre: </span>
                                    <input type="text" class="form-control" id="nameperson" name="nameperson" ng-model="nameperson" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.nameperson.$invalid && formUser.nameperson.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Nombre es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Apellidos: </span>
                                    <input type="text" class="form-control" id="lastnameperson" name="lastnameperson" ng-model="lastnameperson" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.lastnameperson.$invalid && formUser.lastnameperson.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">Los Apellidos son requeridos</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">RUC / CI: </span>
                                    <input type="text" class="form-control" id="identifyperson" name="identifyperson" ng-model="identifyperson" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.identifyperson.$invalid && formUser.identifyperson.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Campo es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Email: </span>
                                    <input type="email" class="form-control" id="emailperson" name="emailperson" ng-model="emailperson" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.emailperson.$invalid && formUser.emailperson.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Email es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Teléfono: </span>
                                    <input type="text" class="form-control" id="numphoneperson" name="numphoneperson" ng-model="numphoneperson" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.numphoneperson.$invalid && formUser.numphoneperson.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Teléfono es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Usuario: </span>
                                    <input type="text" class="form-control" id="users" name="users" ng-model="users" required />
                                </div>
                                <span class="help-block error" ng-show="formUser.users.$invalid && formUser.users.$touched">
                                    <small id="emailHelp" class="form-text text-danger text-right">El Usuario es requerido</small>
                                </span>
                            </div>

                            <div class="col-12" style="margin-top: 5px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Password: </span>
                                    <input type="password" class="form-control" id="password" name="password" ng-model="password" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="save()" ng-disabled="formUser.$invalid">
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
                            Está seguro que desea cambiar el estado de: <strong>{{name_users}}</strong>
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