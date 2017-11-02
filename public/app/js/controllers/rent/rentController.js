

    app.controller('RentController', function($scope, $http, API_URL) {

        $scope.aux_estado = "";
        $scope.iditem = 0;
        $scope.statefilter = '1';

        $scope.pageChanged = function(newPage) {
            $scope.initLoad(newPage);
        };

        $scope.initLoad = function(pageNumber){

            if ($scope.buscar !== undefined) {
                var search = $scope.buscar;
            } else var search = null;

            if ($scope.clientfilter !== undefined) {
                var idclient = $scope.clientfilter;
            } else var idclient = null;

            if ($scope.carBrandfilter !== undefined) {
                var idcarbran = $scope.carBrandfilter;
            } else var idcarbran = null;

            if ($scope.statefilter !== undefined) {
                var state = $scope.statefilter;
            } else var state = null;

            var filtros = {
                search: search,
                idclient: idclient,
                idcarbran: idcarbran,
                state: state
            };

            console.log(filtros);

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
                console.log(response);

                var long = response.data.length;
                var array = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < long; i++){
                    array.push({label: response.data[i].namecarbrand , id: response.data[i].idcarbrand})
                }
                $scope.carBrandlist = array;
                $scope.carBrandfilter = '';
            });

        };

        ///---mostrar informacion de la renta
        $scope.showModalInformation=function(item){

            $scope.client = item.nameperson + " " + item.lastnameperson;
            $scope.idclient = item.identifyperson;
            $scope.emailperson = item.emailperson;
            $scope.phoneperson = item.numphoneperson;
            /*$scope.celperson = item.numcelperson;
            $scope.addressperson = item.addressperson;*/

            $scope.carbrand = item.namecarbrand;
            $scope.carmodel = item.namecarmodel;
            $scope.licenseplate = item.licenseplate;
            $scope.numrent = item.numrent;
            $scope.flightnumber = item.flightnumber;
            /*$scope.insurancecompany = item.insurancecompany;
            $scope.securecode = item.securecode;*/

            $scope.placeretreat = item.placeretreat;
            $scope.placereturn = item.placereturn;

            $scope.subtotal_rent = item.subtotal;
            $scope.iva_rent = item.iva;
            $scope.total_rent = item.total;

            $scope.startdate = item.startdatetime;
            $scope.enddate = item.enddatetime;

            $("#modalInformation").modal("show");
        };

        ///---confirmar cambio de estado de renta
        $scope.showModalChangeEstate=function(item){
            $scope.car=item;
            $scope.iditem = item.idrent;
            $scope.aux_estado = item.staterent;

            console.log(item);

            $('#modalMessagePrimary').modal('show');
        };
        ///--- cambiar estado y enviar a el controlador php
        $scope.ok_anular=function(){

            if($scope.aux_estado==="1" || $scope.aux_estado===null){
                $scope.state="0";
            }else{
                $scope.state="1";
            }

            var data = {
               state: $scope.state
            };

            console.log(data);

            $http.put(API_URL + 'rent/' + $scope.iditem, data).then(function(response) {

                if (response.data.success === true) {
                    $scope.iditem = 0;
                    $('#modalMessagePrimary').modal('hide');
                    $scope.mensaje = 'Se ha anulado correctamente la reserva seleccionada...';
                    $('#modalMessage').modal('show');
                    $scope.initLoad(1);
                } else {

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

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

