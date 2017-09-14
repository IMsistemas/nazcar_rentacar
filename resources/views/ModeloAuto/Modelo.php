
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
					<td>NO.</td>
					<td>MODELO</td>
					<td>ACCIONES</td>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="m in allmodelos | orderBy:sortKey:reverse |filter:buscquedamodelo| itemsPerPage:10" total-items="totalItems" ng-cloak">
					
					<td>{{$index+1}}</td>
					<td>{{m.namecarmodel}}</td>
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
			                <span class="input-group-addon">Modelo: </span>
			                <input type="text" class="form-control" ng-model="aux_namecarmodel" />
			            </div>
	        		</div>
	        	</div>
	        		        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" ng-disabled=" aux_btn_modeloe!='1' " ng-click="modify();">
                Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i> 
            </button>

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_modeloe='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>
	      </div>
	    </div>
	  </div>
	</div>

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
			                <span class="input-group-addon">Modelo: </span>
			                <input type="text" class="form-control" id="namecarmodel" name="namecarmodel" ng-model="namecarmodel"  />
			            </div>
	        		</div>
	        	</div>	      		
	        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" ng-disabled=" aux_btn_modelos!='1' " ng-click="save_modelo()">
                Aceptar <i class="fa fa-check-circle" aria-hidden="true"  ></i> 
            </button>

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_modelos='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
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