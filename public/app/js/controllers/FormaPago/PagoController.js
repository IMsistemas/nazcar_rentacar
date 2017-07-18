app.controller('PagoController', function($scope, $http, API_URL) {
    $scope.Title="Registro de Formas de Pagos ";

    $scope.namepaidform="";
    $scope.aux_namepaidform="";
    $scope.allformpagos=[];
    $scope.aux_formapago={};
    $scope.buscquedapago="";
    $scope.estado="1";

    $scope.aux_btn_pagos="1";
    $scope.aux_btn_pagoe="1";
    $scope.aux_btn_pagod="1";

    ///--- Guardar pago
    $scope.save_pago=function() {
    	if($scope.namepaidform!=""){
    		$scope.aux_btn_pagos="2";
    		var data={
    			namepaidform: $scope.namepaidform,
    			state:'1'
    		};
    		$scope.save(data);
    	}else{
    		$scope.Mensaje="Ingrese una forma de pago";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///--- Enviar datos a el controlador php para guardar
    $scope.save=function (datos) {
    	$http.post(API_URL+'FormPago',datos)
        .then(function (response) {
        	if(response.data=="true"){
        		$("#modalMessagePrimaryAdd").modal("hide");
        		$scope.namepaidform="";
        		$scope.Mensaje="Se guardo correctamente";
    			$("#modalMessageError").modal("show");
    			$scope.initLoad(1);
    			$scope.aux_btn_pagos="1";
        	}else{
        		$scope.namepaidform="";
        		$("#modalMessagePrimaryAdd").modal("hide");

        		$scope.Mensaje="Error al guardar los datos";
    			$("#modalMessageError").modal("show");
        	}
                    
        });
    };
    ///--- Lista forma de pagos
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
        	buscar:$scope.buscquedapago,
            estado: $scope.estado
        };
        $http.get(API_URL + 'FormPago/get_list_pago?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.allformpagos = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///--- Editar Marca
    $scope.edit_formpago=function(item) {
    	$scope.aux_namepaidform=item.namepaidform;
    	$scope.aux_formapago=item;
    	showModal('modalMessagePrimaryEdit');

    };
    ///-- Validar datos y enviar a controlador de php para modificar
    $scope.modify=function() {
    	if($scope.aux_namepaidform!="" ){
    		$scope.aux_formapago.namepaidform=$scope.aux_namepaidform;
    		$scope.aux_btn_pagoe="2";
    		$http.put(API_URL+'FormPago/'+$scope.aux_formapago.idpaidform,$scope.aux_formapago)
	        .then(function (response) {
	        	if(response.data=="true"){
	        		$("#modalMessagePrimaryEdit").modal("hide");
	        		
	        		$scope.aux_formapago={};
	        		$scope.aux_namepaidform="";

	        		$scope.Mensaje="Se modifico correctamente";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namepaidform="";
	        		$("#modalMessagePrimaryEdit").modal("hide");

	        		$scope.Mensaje="Error al modificar los datos";
	    			$("#modalMessageError").modal("show");
	        	}

	        	$scope.aux_btn_pagoe="1";
	        });

    	}else{
    		$scope.Mensaje="Ingrese una forma de pago";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///---cambiar estado marca
    $scope.change_estado=function(item){
    	$scope.aux_formapago=item;
    	$("#modalMessagePrimary").modal("show");
    };
    ///--- cambiar estado y enviar a el controlador php
    $scope.ok_inactivar=function(){
    	if($scope.aux_formapago.state=="1"){
    		$scope.aux_formapago.state="0";
    	}else{
    		$scope.aux_formapago.state="1";
    	}
    	$scope.aux_btn_pagod="2";
    	$http.get(API_URL + 'FormPago/estado/'+JSON.stringify($scope.aux_formapago))
		.then(function(response){
		    console.log(response);
		    if(response.data=="true"){
	        		$("#modalMessagePrimary").modal("hide");
	        		
	        		$scope.aux_formapago={};

	        		$scope.Mensaje="Se modifico correctamente";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namepaidform="";
	        		$("#modalMessagePrimary").modal("hide");

	        		$scope.Mensaje="Error al modificar los datos";
	    			$("#modalMessageError").modal("show");
	        	}
	        	$scope.aux_btn_pagod="1";
		});
    };
});

$(document).ready(function(){

});
function showModal(id){
    $('#' + id).modal('show')
}
