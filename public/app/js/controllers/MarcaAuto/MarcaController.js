app.controller('MarcaController', function($scope, $http, API_URL) {
    $scope.Title="Registro de Marcas de Autos ";

    $scope.namecarbrand="";
    $scope.aux_namecarbrand="";
    $scope.allmarcas=[];
    $scope.aux_marca={};
    $scope.buscquedamarca="";
    $scope.estado="1";

    $scope.aux_btn_marcas="1";
    $scope.aux_btn_marcae="1";
    $scope.aux_btn_marcad="1";

    ///--- Guardar marca
    $scope.save_marca=function() {
    	if($scope.namecarbrand!=""){
    		$scope.aux_btn_marcas="2";
    		var data={
    			namecarbrand: $scope.namecarbrand,
    			state:'1'
    		};
    		$scope.save(data);
    	}else{
    		$scope.Mensaje="Ingrese una marca";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///--- Enviar datos a el controlador php para guardar
    $scope.save=function (datos) {
    	$http.post(API_URL+'Marca',datos)
        .then(function (response) {
        	if(response.data=="true"){
        		$("#modalMessagePrimaryAdd").modal("hide");
        		$scope.namecarbrand="";
        		$scope.Mensaje="Se guardo correctamente";
    			$("#modalMessageError").modal("show");
    			$scope.initLoad(1);
    			$scope.aux_btn_marcas="1";
        	}else{
        		$scope.namecarbrand="";
        		$("#modalMessagePrimaryAdd").modal("hide");

        		$scope.Mensaje="Error al guardar los datos";
    			$("#modalMessageError").modal("show");
        	}
                    
        });
    };
    ///--- Lista marcas
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
        	buscar:$scope.buscquedamarca,
            estado: $scope.estado
        };
        $http.get(API_URL + 'Marca/get_list_marca?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.allmarcas = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };
    $scope.initLoad(1);
    ///--- Editar Marca
    $scope.edit_marca=function(item) {
    	$scope.aux_namecarbrand=item.namecarbrand;
    	$scope.aux_marca=item;
    	showModal('modalMessagePrimaryEdit');
    };
    ///-- Validar datos y enviar a controlador de php para modificar
    $scope.modify=function() {
    	if($scope.aux_namecarbrand!="" ){
    		$scope.aux_marca.namecarbrand=$scope.aux_namecarbrand;
    		$scope.aux_btn_marcae="2";

    		console.log($scope.aux_marca);

    		$http.put(API_URL+'Marca/'+$scope.aux_marca.idcarbrand,$scope.aux_marca)
	        .then(function (response) {
	        	if(response.data=="true"){
	        		$("#modalMessagePrimaryEdit").modal("hide");
	        		
	        		$scope.aux_marca={};
	        		$scope.aux_namecarbrand="";

	        		$scope.Mensaje="Se modifico correctamente";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namecarbrand="";
	        		$("#modalMessagePrimaryEdit").modal("hide");

	        		$scope.Mensaje="Error al modificar los datos";
	    			$("#modalMessageError").modal("show");
	        	}

	        	$scope.aux_btn_marcae="1";
	        });

    	}else{
    		$scope.Mensaje="Ingrese una marca";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///---cambiar estado marca
    $scope.change_estado=function(item){
    	$scope.aux_marca=item;
    	$scope.name_brand = item.namecarbrand;
    	$("#modalMessagePrimary").modal("show");
    };
    ///--- cambiar estado y enviar a el controlador php
    $scope.ok_inactivar=function(){
    	if($scope.aux_marca.state=="1"){
    		$scope.aux_marca.state="0";
    	}else{
    		$scope.aux_marca.state="1";
    	}
    	$scope.aux_btn_marcad="2";
    	$http.get(API_URL + 'Marca/estado/'+JSON.stringify($scope.aux_marca))
		.then(function(response){
		    console.log(response);
		    if(response.data=="true"){
	        		$("#modalMessagePrimary").modal("hide");
	        		
	        		$scope.aux_marca={};

	        		$scope.Mensaje="El estado de la marca se ha editado satisfactoriamente...";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namecarbrand="";
	        		$("#modalMessagePrimary").modal("hide");

	        		$scope.Mensaje="Ha ocurrido un error al intentar editar el estado de la marca...";
	    			$("#modalMessageError").modal("show");
	        	}
	        	$scope.aux_btn_marcad="1";
		});
    };
});

$(document).ready(function(){

});
function showModal(id){
    $('#' + id).modal('show')
}
