<!DOCTYPE html>
<html lang="en" ng-app="reservationApp">
<head>
	<title>Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	
	<link href="<?= asset('../lib/bootstrap4/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
	<link href="<?= asset('../lib/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">



   
	<script src="<?= asset('../lib/jquery/jquery-3.2.1.min.js') ?>"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
	
	<script src="<?= asset('../lib/bootstrap4/js/bootstrap.min.js') ?>"></script>
	


	<script src="<?= asset('../lib/bootstrap-datetimepicker/moment.min.js') ?>"></script>
	<script src="<?= asset('../lib/bootstrap-datetimepicker/es.js') ?>"></script>
	<script src="<?= asset('../lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>


	<script src="<?= asset('../lib/angularjs/angular.min.js') ?>"></script>
	<script src="<?= asset('../lib/angularjs/angular-route.min.js') ?>"></script>
	<script src="<?= asset('../lib/angularjs/angular-sanitize.min.js') ?>"></script>
	<script src="<?= asset('../lib/upload/ng-file-upload.min.js') ?>"></script>
	<script src="<?= asset('../lib/dirPagination.js') ?>"></script>

	<script src="<?= asset('../app/js/app_system.js') ?>"></script>

	<script src="<?= asset('../app/js/controllers/MarcaAuto/MarcaController.js') ?>"></script>

	
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
	<script type="text/javascript">
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})

	</script>
</head>
<body >

<div class="container" style="margin-top: 10px;" ng-controller="MarcaController">
	
	<div class="col-xs-12">
		<h4>{{Title}}</h4>
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
					<td>NO.</td>
					<td>MARCA</td>
					<td>ACCIONES</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					
					<td>text</td>
					<td>text</td>
					<td>
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
</html>