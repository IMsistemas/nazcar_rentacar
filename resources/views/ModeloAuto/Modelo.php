
<div class="container" style="margin-top: 10px;" ng-controller="ModeloController">
	
	<div class="col-xs-12">
		<h4>{{Title}}</h4>
		<hr>
	</div>

	<div class="row " style="margin-top: 5px;">
		
		<div class="col-4 ">
			<div class="input-group">                        
			    <input type="text" class="form-control" ng-model="buscquedamodelo">
			    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="col-4">
			<div class="input-group">                        
			    <span class="input-group-addon">Estado: </span>
			    <select class="form-control" ng-model="estado" ng-change="initLoad(1)";>
			    	<option value="1">Activos</option>
			    	<option value="0">Inactivos</option>
			    </select>
			</div>
		</div>
		<div class="col-4 text-right">
			<button type="button" class="btn btn-primary" onclick="showModal('modalMessagePrimaryAdd')" >
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
					<th>MODELO</th>
                    <th>MARCA</th>
                    <th style="width: 14%;">COSTO DIARIO</th>
                    <th style="width: 12%;">GARANTIA</th>
					<th style="width: 12%;">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="m in allmodelos | orderBy:sortKey:reverse |filter:buscquedamodelo| itemsPerPage:10" total-items="totalItems" ng-cloak">
					
					<td>{{$index+1}}</td>
					<td>{{m.namecarmodel}}</td>
                    <td>{{m.namecarbrand}}</td>
                    <td class="text-right">$ {{m.price}}</td>
                    <td class="text-right">$ {{m.guarantee}}</td>
					<td>
			            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="edit_modelo(m)" >
			                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			            </button>
			            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="change_estado(m)" >
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

	
	<div class="modal fade" id="modalMessageError" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header-info">
	        <h5 class="modal-title">Mensaje</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        {{Mensaje}}
	      </div>
	      <div class="modal-footer">

	        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
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
	        Inactivar/Activar Modelo
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" ng-disabled=" aux_btn_modelod!='1' " ng-click="ok_inactivar();" >
                Anular <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_modelod='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>
	      </div>
	    </div>
	  </div>
	</div>

<form class="form-horizontal"  name="modelo_edit" id="modelo_add"  novalidate="">
	<div class="modal fade" id="modalMessagePrimaryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header-primary">
	        <h5 class="modal-title">Editar</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      		
	        	<div class="row">

                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon">Marca: </span>
                            <select class="form-control" id="aux_namecarmarca" required name="aux_namecarmarca" ng-model="aux_namecarmarca"
                                    ng-options="value.id as value.label for value in listmarcas"></select>
                        </div>
                        <span class="help-block error" ng-show="modelo_edit.aux_namecarmarca.$invalid && modelo_edit.aux_namecarmarca.$touched">La marca es requerida</span>
                    </div>

	        		<div class="col-12" style="margin-top: 5px;">
	        			<div class="input-group">                        
			                <span class="input-group-addon">Modelo: </span>
			                <input type="text" class="form-control" ng-model="aux_namecarmodel" name="aux_namecarmodel" required />
			            </div>
			            <span class="help-block error" ng-show="modelo_edit.aux_namecarmodel.$invalid && modelo_edit.aux_namecarmodel.$touched">El modelo es requerido</span>
	        		</div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Costo Diario: </span>
                            <input type="text" class="form-control" ng-model="aux_nameprecio" name="aux_nameprecio" id="aux_nameprecio" required  ng-keypress="onlyNumber($event, 10, 'aux_nameprecio')"  />
                        </div>
                        <span class="help-block error" ng-show="modelo_edit.aux_nameprecio.$invalid && modelo_edit.aux_nameprecio.$touched">El costo diario es requerido</span>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Garantía: </span>
                            <input type="text" class="form-control" ng-model="aux_namegarantia" name="aux_namegarantia" id="aux_namegarantia" required   ng-keypress="onlyNumber($event, 10, 'aux_namegarantia')" />
                        </div>
                        <span class="help-block error" ng-show="modelo_edit.aux_namegarantia.$invalid && modelo_edit.aux_namegarantia.$touched">La garantia  es requerida</span>
                    </div>

	        	</div>
	        		        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" ng-disabled=" aux_btn_modeloe!='1' || modelo_edit.$invalid " ng-click="modify();">
                Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i> 
            </button>

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_modeloe='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
	<form class="form-horizontal"  name="modelo_add" id="modelo_add"  novalidate="">
	<div class="modal fade" id="modalMessagePrimaryAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header-primary">
	        <h5 class="modal-title">Agregar</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

				<div class="row">
	        		<div class="col-12">
	        			<div class="input-group">
			                <span class="input-group-addon">Marca: </span>
                            <select class="form-control" id="namecarmarca" name="namecarmarca" required ng-model="namecarmarca"
                                    ng-options="value.id as value.label for value in listmarcas"></select>
			            </div>
			            <span class="help-block error" ng-show="modelo_add.namecarmarca.$invalid && modelo_add.namecarmarca.$touched">La marca es requerida</span>
	        		</div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Modelo: </span>
                            <input type="text" class="form-control" id="namecarmodel" name="namecarmodel" ng-model="namecarmodel"  required />
                        </div>
                        <span class="help-block error" ng-show="modelo_add.namecarmodel.$invalid && modelo_add.namecarmodel.$touched">El modelo es requerido</span>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Costo Diario: </span>
                            <input type="text" class="form-control" ng-model="nameprecio"  name="nameprecio" required id="nameprecio"  ng-keypress="onlyNumber($event, 10, 'nameprecio')" />
                        </div>
                        <span class="help-block error" ng-show="modelo_add.nameprecio.$invalid && modelo_add.nameprecio.$touched">Es necesario el precio</span>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Garantía: </span>
                            <input type="text" class="form-control" ng-model="namegarantia" name="namegarantia" required id="namegarantia" ng-keypress="onlyNumber($event, 10, 'namegarantia')" />
                        </div>
                        <span class="help-block error" ng-show="modelo_add.namegarantia.$invalid && modelo_add.namegarantia.$touched">Es necesario la garantia</span>
                    </div>

	        	</div>	      		
	        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" ng-disabled=" aux_btn_modelos!='1' || modelo_add.$invalid  "  ng-click="save_modelo()">
                Aceptar <i class="fa fa-check-circle" aria-hidden="true"  ></i> 
            </button>

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_modelos='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>
	      </div>
	    </div>
	  </div>
	</div>
	</form>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>