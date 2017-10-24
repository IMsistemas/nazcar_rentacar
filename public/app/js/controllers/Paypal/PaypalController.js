app.controller('PaypalLaravelController', function($scope, $http, API_URL) {

    //$scope.Title="Ejeplo paypal ";

    $scope.paypal_init=function(){
    	var list_item=[];
    		var item={
    			Nombre: 'Pc Dell I5 ',
    			Cantidad: 1,
    			PrecioU:788.69
    		};
            var item1={
                Nombre: 'Pc Dell I7 ',
                Cantidad: 1,
                PrecioU:868.43
            };

    		list_item.push(item);
            list_item.push(item1);
    	var datos={
    		Items:list_item,
    		ValorTotal: 1657.12,
    		Descripcion: 'Venta en novicompu'
    	};

    	$http.post(API_URL+'Paypallaravel2',datos)
        .then(function (response) {
            if(response.data.url!=undefined){
                location.href=response.data.url;
            }else{
                location.href=response.data;
            }
        	
        });
    };

});

$(document).ready(function(){

});
function showModal(id){
    $('#' + id).modal('show')
}
