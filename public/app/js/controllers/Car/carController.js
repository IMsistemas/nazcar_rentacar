

    app.controller('CarController', function($scope, $http, API_URL, Upload) {

        $scope.id = 0;
        $scope.aux_state = "1";

        $scope.initLoad = function(pageNumber){

            $scope.listCarbrand();
            //$scope.listCarModel();

            if ($scope.buscar !== undefined) {
                var search = $scope.buscar;
            } else var search = null;

            if ($scope.statefilter !== undefined) {
                var state = $scope.statefilter;
            } else var state = null;

            var filtros = {
                search: search,
                state: state
            };

            $http.get(API_URL + 'car/listCars?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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

        $scope.listCarbrand = function(){
            $http.get(API_URL + 'car/get_list_marca').then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].namecarbrand, id: response.data[i].idcarbrand});
                }

                $scope.marcaslist = array_temp;
                $scope.car_brand = '';

                $scope.modelos = [{label: '-- Seleccione --', id: ''}];
                $scope.car_model = '';

            });
        };

        $scope.listCarModel = function(){

            $http.get(API_URL + 'car/get_list_modelo/' + $scope.car_brand).then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].namecarmodel, id: response.data[i].idcarmodel});
                }

                $scope.modelos = array_temp;
                $scope.car_model = '';

                console.log($scope.modelos);


            });
        };

        ///-- Guardar datos autos
        $scope.saveCar = function () {

            var data = {
                id: $scope.id,
                car_brand: $scope.car_brand,
                car_model: $scope.car_model,
                year: $scope.year,
                car_type: $scope.car_type,
                serial_motor: $scope.serial_motor,
                serial_car: $scope.serial_car,
                name_owner: $scope.name_owner,
                insurance_company: $scope.insurance_company,
                secure_code: $scope.secure_code,
                rent_cost: $scope.rent_cost,
                aditional_cost: $scope.aditional_cost,
                file: $scope.file
            };

            console.log(data);

            Upload.upload({

                url: 'car',
                method: 'POST',
                data: data

            }).then(function(data, status, headers, config) {

                if (data.data.success === true) {

                    $scope.id = 0;

                    $scope.initLoad();

                    $("#modalMessagePrimaryAdd").modal("hide");

                    $scope.message = 'Se ha guardado el auto satisfactoriamente...';
                    $('#modalMessage').modal('show');

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar almacenar el video...';
                    $('#modalMessageError').modal('show');
                    $("#modalMessagePrimaryAdd").modal("hide");
                }
            });


        };

        ///---cambiar estado marca
        $scope.change_estado=function(item){
            $scope.aux_state=item.state;
            $scope.id = item.idcar;
            $("#modalMessagePrimary").modal("show");
        };
        ///--- cambiar estado y enviar a el controlador php
        $scope.ok_inactivar = function(){

            if ( $scope.aux_state == "1"){
                $scope.state = "0";
            } else $scope.state = "1";

            var data = {
                state: $scope.state,
                id: $scope.id
            };

            console.log(data);
            $http.get(API_URL + 'car/estado/' + JSON.stringify(data)).then(function(response) {

                if (response.data.success === true) {
                    $scope.id = 0;
                    $('#modalMessagePrimary').modal('hide');
                    $scope.message = 'Se ha modificado el estado del auto seleccionado...';
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

        $scope.showModalAdd = function () {

            $("#modalMessagePrimaryAdd").modal("show");

        };

        $scope.showModalAdd = function (item) {

             $scope.car_brand = item.carbrand;
             $scope.car_model = item.carmodel;
             $scope.year = item.year;
             $scope.car_type = item.cartype;
             $scope.serial_motor = item.serialmotor;
             $scope.serial_car = item.carserial;
             $scope.name_owner = item.nameowner;
             $scope.insurance_company = item.insurancecompany;
             $scope.secure_code = item.securecode;
             $scope.rent_cost = item.rentcost;
             $scope.aditional_cost = item.additionalcost;
             $scope.file = item.image;

            $("#modalMessagePrimaryAdd").modal("show");

        };

        $scope.showModalInfo = function (item) {

            $scope.car_brand = item.namecarbrand;
            $scope.car_model = item.namecarmodel;
            $scope.year = item.year;
            $scope.car_type = item.cartype;
            $scope.serial_motor = item.serialmotor;
            $scope.serial_car = item.carserial;
            $scope.name_owner = item.nameowner;
            $scope.insurance_company = item.insurancecompany;
            $scope.secure_code = item.securecode;
            $scope.rent_cost = item.rentcost;
            $scope.aditional_cost = item.additionalcost;
            $scope.file = item.image;

            $("#modalMessageInfo").modal("show");

        };

        $scope.onlyNumber = function ($event, length, field) {

            if (length != undefined) {
                var valor = $('#' + field).val();
                if (valor.length == length) $event.preventDefault();
            }

            var k = $event.keyCode;
            if (k == 8 || k == 0) return true;
            var patron = /\d/;
            var n = String.fromCharCode(k);

            if (n == ".") {
                return true;
            } else {

                if(patron.test(n) == false){
                    $event.preventDefault();
                }
                else return true;
            }
        };


    });


