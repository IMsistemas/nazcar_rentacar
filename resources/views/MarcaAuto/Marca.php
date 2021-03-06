

<div class="container" style="margin-top: 10px;" ng-controller="MarcaController">
	
	<div class="col-xs-12">
		<h4>{{Title}}</h4>
		<hr>
	</div>

	<div class="row " style="margin-top: 5px;">
		
		<div class="col-4 ">
			<div class="input-group">                        
			    <input type="text" class="form-control" ng-model="buscquedamarca">
			    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="col-4">
			<div class="input-group">                        
			    <span class="input-group-addon">Estado: </span>
			    <select class="form-control" ng-model="estado" ng-change="initLoad(1)";>
			    	<option value="1">ACTIVOS</option>
			    	<option value="0">INACTIVOS</option>
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
					<th>MARCA</th>
					<th style="width: 15%;">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="m in allmarcas | orderBy:sortKey:reverse |filter:buscquedamarca| itemsPerPage:10" total-items="totalItems" ng-cloak">
					
					<td>{{$index+1}}</td>
					<td>{{m.namecarbrand}}</td>
					<td class="text-center">

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Editar" ng-click="edit_marca(m)" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Anular" ng-click="change_estado(m)" >
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

	
	<div class="modal fade" id="modalMessageError" style="z-index:2000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header-success">
	        <h5 class="modal-title">Información</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        {{Mensaje}}
	      </div>
	      <!--<div class="modal-footer">

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
                      Está seguro que desea cambiar el estado de: <strong>{{name_brand}}</strong>
                  </div>
              </div>
	      </div>
	      <div class="modal-footer">

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_marcad='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>

              <button type="button" class="btn btn-danger" ng-disabled=" aux_btn_marcad!='1' " ng-click="ok_inactivar();" >
                  Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
              </button>

	      </div>
	    </div>
	  </div>
	</div>

<form class="form-horizontal"  name="marca_edit" id="marca_edit"  novalidate="">
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
			                <input type="text" class="form-control" ng-model="aux_namecarbrand" name="aux_namecarbrand" id="aux_namecarbrand"  required />
			            </div>

			            <span class="help-block error" ng-show="marca_edit.aux_namecarbrand.$invalid && marca_edit.aux_namecarbrand.$touched">La marca es requerida</span>
	        		</div>
	        	</div>
	        		        	
	      </div>
	      <div class="modal-footer">

                <button type="button" class="btn btn-secondary" ng-click=" aux_btn_marcae='1' " data-dismiss="modal">
                    Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                </button>

              <button type="button" class="btn btn-success" ng-disabled=" aux_btn_marcae!='1' || marca_edit.$invalid " ng-click="modify();">
                  Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
              </button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<form class="form-horizontal"  name="marca_add" id="marca_add"  novalidate="">
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
			                <input type="text" class="form-control" id="namecarbrand" name="namecarbrand" ng-model="namecarbrand"  required />
			            </div>

			            <span class="help-block error" ng-show="marca_add.namecarbrand.$invalid && marca_add.namecarbrand.$touched">La marca es requerida</span>
	        		</div>
	        	</div>	      		
	        	
	      </div>
	      <div class="modal-footer">

	        <button type="button" class="btn btn-secondary" ng-click=" aux_btn_marcas='1' " data-dismiss="modal">
                Cancelar <i class="fa fa-ban" aria-hidden="true"></i> 
            </button>

              <button type="button" class="btn btn-success" ng-disabled=" aux_btn_marcas!='1'  || marca_add.$invalid " ng-click="save_marca()">
                  Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
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