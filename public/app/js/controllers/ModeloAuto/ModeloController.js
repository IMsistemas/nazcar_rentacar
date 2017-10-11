app.controller('ModeloController', function($scope, $http, API_URL) {
    $scope.Title="Registro de Modelos de Autos ";

    $scope.namecarmodel="";
    $scope.aux_namecarmodel="";

    $scope.nameprecio="";
    $scope.aux_nameprecio="";

    $scope.namegarantia="";
    $scope.aux_namegarantia="";

    $scope.allmodelos=[];
    $scope.aux_modelo={};
    $scope.buscquedamodelo="";
    $scope.estado="1";

    $scope.aux_btn_modelos="1";
    $scope.aux_btn_modeloe="1";
    $scope.aux_btn_modelod="1";

    ///--- Guardar modelo
    $scope.save_modelo=function() {
    	if($scope.namecarmodel!=""){
    		$scope.aux_btn_modelos="2";
    		var data={
    			namecarmodel: $scope.namecarmodel,
    			state:'1',
                idcarbrand: $scope.namecarmarca,
				price: $scope.nameprecio,
                guarantee: $scope.namegarantia,
    		};
    		$scope.save(data);
    	}else{
    		$scope.Mensaje="Ingrese un modelo de auto";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///--- Enviar datos a el controlador php para guardar
    $scope.save=function (datos) {
    	$http.post(API_URL+'Modelo',datos)
        .then(function (response) {
        	if(response.data=="true"){
        		$("#modalMessagePrimaryAdd").modal("hide");
        		$scope.namecarmodel="";
                $scope.nameprecio="";
                $scope.namegarantia="";
        		$scope.Mensaje="Se guardo correctamente";
    			$("#modalMessageError").modal("show");
    			$scope.initLoad(1);
    			$scope.aux_btn_modelos="1";
        	}else{
        		$scope.namecarmodel="";
        		$("#modalMessagePrimaryAdd").modal("hide");

        		$scope.Mensaje="Error al guardar los datos";
    			$("#modalMessageError").modal("show");
        	}
                    
        });
    };

    $scope.listMarcas = function () {

        $http.get(API_URL + 'Modelo/listMarcas').then(function(response){

            var longitud = response.data.length;
            var array_temp = [{label: '-- Seleccione --', id: ''}];
            for(var i = 0; i < longitud; i++){
                array_temp.push({label: response.data[i].namecarbrand, id: response.data[i].idcarbrand})
            }
            $scope.listmarcas = array_temp;
            $scope.namecarmarca = '';
            $scope.aux_namecarmarca = '';
		});

    };

    ///--- Lista modelos 
    $scope.pageChanged = function(newPage) {
        $scope.initLoad(newPage);
    };
    $scope.initLoad = function(pageNumber){

        var filtros = {
        	buscar:$scope.buscquedamodelo,
            estado: $scope.estado
        };
        $http.get(API_URL + 'Modelo/get_list_modelo?page=' + pageNumber + '&filter=' + JSON.stringify(filtros))
            .then(function(response){
                $scope.allmodelos = response.data.data;
                $scope.totalItems = response.data.total;
         });
    };

    $scope.listMarcas();

    $scope.initLoad(1);

    ///--- Editar Modelo
    $scope.edit_modelo=function(item) {
    	$scope.aux_namecarmodel=item.namecarmodel;
        $scope.aux_namecarmarca = item.idcarbrand;
        $scope.aux_nameprecio = item.price;
        $scope.aux_namegarantia = item.guarantee;
    	$scope.aux_modelo=item;
        console.log(item)
    	showModal('modalMessagePrimaryEdit');

    };
    ///-- Validar datos y enviar a controlador de php para modificar
    $scope.modify=function() {
    	if($scope.aux_namecarmodel!="" ){
    		$scope.aux_modelo.namecarmodel=$scope.aux_namecarmodel;
            $scope.aux_modelo.idcarbrand = $scope.aux_namecarmarca;
            $scope.aux_modelo.price = $scope.aux_nameprecio;
            $scope.aux_modelo.guarantee = $scope.aux_namegarantia;
    		$scope.aux_btn_modeloe="2";
            var modelo={
                'idcarmodel': $scope.aux_modelo.idcarmodel,
                'namecarmodel': $scope.aux_modelo.namecarmodel,
                'price': $scope.aux_modelo.price,
                'guarantee':$scope.aux_modelo.guarantee,
                'state': $scope.aux_modelo.state,
                'idcarbrand':$scope.aux_modelo.idcarbrand
            };
    		$http.put(API_URL+'Modelo/'+$scope.aux_modelo.idcarmodel,modelo)
	        .then(function (response) {
	        	if(response.data=="true"){
	        		$("#modalMessagePrimaryEdit").modal("hide");
	        		
	        		$scope.aux_modelo={};
	        		$scope.aux_namecarmodel="";

	        		$scope.Mensaje="Se modifico correctamente";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namecarmodel="";
	        		$("#modalMessagePrimaryEdit").modal("hide");

	        		$scope.Mensaje="Error al modificar los datos";
	    			$("#modalMessageError").modal("show");
	        	}

	        	$scope.aux_btn_modeloe="1";
	        });

    	}else{
    		$scope.Mensaje="Ingrese un modelo";
    		$("#modalMessageError").modal("show");
    	}
    };
    ///---cambiar estado marca
    $scope.change_estado=function(item){
    	$scope.aux_modelo=item;
    	$("#modalMessagePrimary").modal("show");
    };
    ///--- cambiar estado y enviar a el controlador php
    $scope.ok_inactivar=function(){
    	if($scope.aux_modelo.state=="1"){
    		$scope.aux_modelo.state="0";
    	}else{
    		$scope.aux_modelo.state="1";
    	}
    	$scope.aux_btn_modelod="2";
    	$http.get(API_URL + 'Modelo/estado/'+JSON.stringify($scope.aux_modelo))
		.then(function(response){
		    console.log(response);
		    if(response.data=="true"){
	        		$("#modalMessagePrimary").modal("hide");
	        		
	        		$scope.aux_modelo={};

	        		$scope.Mensaje="Se modifico correctamente";
	    			$("#modalMessageError").modal("show");
	    			$scope.initLoad(1);
	        	}else{
	        		$scope.namecarmodel="";
	        		$("#modalMessagePrimary").modal("hide");

	        		$scope.Mensaje="Error al modificar los datos";
	    			$("#modalMessageError").modal("show");
	        	}
	        	$scope.aux_btn_modelod="1";
		});
    };
});

$(document).ready(function(){

});
function showModal(id){
    $('#' + id).modal('show')
}
