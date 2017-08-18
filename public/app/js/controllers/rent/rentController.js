

    app.controller('RentController', function($scope, $http, API_URL) {


        $scope.initLoad = function(pageNumber){


            if ($scope.buscar !== undefined) {
                var search = $scope.buscar;
            } else var search = null;

            if ($scope.clientfilter !== undefined) {
                var idclient = $scope.clientfilter;
            } else var idclient = null;

            if ($scope.carBrandfilter !== undefined) {
                var idcar = $scope.carBrandfilter;
            } else var idcar = null;


            var filtros = {
                search: search,
                idclient: idclient,
                idcar: idcar
            };

            $http.get(API_URL + 'rent/listRents?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

                $scope.list = response.data.data;
                $scope.totalItems = response.data.total;
            })
                .catch(function(data, status) {
                    console.error('Gists error', response.status, response.data);
                })
                .finally(function() {
                    //console.log("finally finished gists");
                });
        };

        $scope.getClients = function () {

            $http.get(API_URL + 'rent/getListClients').then(function(response){

                var long = response.data.length;
                var array = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < long; i++){
                    array.push({label: response.data[i].nameperson +" "+ response.data[i].lastnameperson, id: response.data[i].idclient})
                }
                $scope.clientslist = array;
                $scope.clientfilter = '';
            });

        };

        $scope.getCarBrand = function () {

            $http.get(API_URL + 'rent/getCarBrands').then(function(response){

                var long = response.data.length;
                var array = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < long; i++){
                    array.push({label: response.data[i].namecarbrand , id: response.data[i].idcar})
                }
                $scope.carBrandlist = array;
                $scope.carBrandfilter = '';
            });

        };

        ///---mostrar informacion de la renta
        $scope.showModalInformation=function(item){

            $scope.title="Información detallada de la reserva";

            $("#modalInformation").modal("show");
        };

        ///---confirmar cambio de estado de renta
        $scope.showModalChangeEstate=function(item){
            $scope.car=item;

            $('#modalMessagePrimary').modal('show');
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

                        $scope.Mensaje="Se modifico correctamente";
                        $("#modalMessageError").modal("show");
                        $scope.initLoad(1);
                    }else{
                        $scope.namecarbrand="";
                        $("#modalMessagePrimary").modal("hide");

                        $scope.Mensaje="Error al modificar los datos";
                        $("#modalMessageError").modal("show");
                    }
                    $scope.aux_btn_marcad="1";
                });
        };

        $scope.getClients();
        $scope.getCarBrand();
    });

    $(document).ready(function(){

    });
    function showModal(id){
        $('#' + id).modal('show')
    }

