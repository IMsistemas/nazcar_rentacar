

    app.controller('CarController', function($scope, $http, API_URL, Upload) {

        $scope.id = 0;
        $scope.idfleet = 0;
        $scope.aux_state = "1";
        $scope.estado = '1';

        $scope.initLoad = function(pageNumber){

            $scope.listCarbrand();
            $scope.listMotors();
            $scope.listFuel();
            $scope.listTransmission();
            $scope.listSedes();

            if ($scope.busqueda !== undefined) {
                var search = $scope.busqueda;
            } else var search = null;

            if ($scope.estado !== undefined) {
                var state = $scope.estado;
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

        $scope.listCarModel = function(idcarmodel){

            $http.get(API_URL + 'car/get_list_modelo/' + $scope.car_brand).then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].namecarmodel, id: response.data[i].idcarmodel});
                }

                $scope.modelos = array_temp;
                $scope.car_model = '';

                if (idcarmodel !== undefined) {

                    $scope.car_model = idcarmodel;

                }


            });
        };

        $scope.listMotors = function(){
            $http.get(API_URL + 'car/get_list_motor').then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].namemotor, id: response.data[i].idmotor});
                }

                $scope.motors = array_temp;
                $scope.serial_motor = '';

            });
        };

        $scope.listSedes = function(){

            $http.get(API_URL + 'car/get_list_sedes').then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];

                for(var i = 0; i < longitud; i++) {

                    array_temp.push({label: response.data[i].nameplace, id: response.data[i].idplace});

                }

                $scope.list_sedes = array_temp;
                $scope.car_sede = '';

            });

        };

        $scope.listFuel = function(){
            $http.get(API_URL + 'car/get_list_fuel').then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].namefuel, id: response.data[i].idfuel});
                }

                $scope.fuels = array_temp;
                $scope.serial_fuel = '';

            });
        };

        $scope.listTransmission = function(){
            $http.get(API_URL + 'car/get_list_transmission').then(function(response){

                var longitud = response.data.length;
                var array_temp = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < longitud; i++){
                    array_temp.push({label: response.data[i].nametransmission, id: response.data[i].idtransmission});
                }

                $scope.transmission = array_temp;
                $scope.serial_transmission = '';

            });
        };

        ///-- Guardar datos autos
        $scope.saveCar = function () {

            var data = {

                id: $scope.id,
                car_brand: $scope.car_brand,
                car_model: $scope.car_model,
                idmotor: $scope.serial_motor,
                idfuel: $scope.serial_fuel,
                idtransmission: $scope.serial_transmission,
                year: $scope.year,
                name_owner: $scope.name_owner,
                amountpassengers: $scope.amountpassengers,
                amountluggage: $scope.amountluggage,
                insurance_company: $scope.insurance_company,
                secure_code: $scope.secure_code,
                licenseplate: $scope.licenseplate,

                idplace: $scope.car_sede,
                fleet: $scope.fleet,
                color: $scope.color,
                idfleet: $scope.idfleet,

                file: $scope.file
            };



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
            $scope.name_car = item.namecarmodel;
            $("#modalMessagePrimary").modal("show");

        };

        $scope.ok_inactivar = function(){

            if ( $scope.aux_state === "1" ){
                $scope.state = "0";
            } else $scope.state = "1";

            var data = {
                state: $scope.state,
                id: $scope.id
            };

;
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

        $scope.cancel = function () {

            $scope.listCarbrand();
            $scope.year = '';
            $scope.car_type = '';
            $scope.serial_motor = '';
            $scope.serial_fuel = '';
            $scope.serial_transmission = '';
            $scope.serial_car = '';
            $scope.name_owner = '';
            $scope.insurance_company = '';
            $scope.secure_code = '';
            $scope.amountpassengers = '';
            $scope.amountluggage = '';
            $scope.licenseplate = '';
            $scope.file = '';

            $scope.car_sede = '';
            $scope.fleet = '';
            $scope.color = '';

            $scope.id = 0;
            $scope.idfleet = 0;
        };

        $scope.showModalAdd = function () {

            $scope.cancel();

            $scope.title_modal_action = 'Agregar';
            $scope.url_foto = 'https://www.autoefectivo.com/img/auto.png';

            $("#modalMessagePrimaryAdd").modal("show");

        };

        $scope.showModalEdit = function (item) {

            $scope.car_brand = item.idcarbrand;

            $scope.listCarModel(item.idcarmodel);

            $scope.year = item.year;
            $scope.car_type = item.cartype;
            $scope.serial_motor = item.idmotor;
            $scope.serial_fuel = item.idfuel;
            $scope.serial_transmission = item.idtransmission;
            $scope.serial_car = item.carserial;
            $scope.name_owner = item.nameowner;
            $scope.insurance_company = item.insurancecompany;
            $scope.secure_code = item.securecode;
            $scope.amountpassengers = item.amountpassengers;
            $scope.amountluggage = item.amountluggage;
            $scope.licenseplate = item.licenseplate;
            $scope.file = item.image;

            $scope.car_sede = item.idplace;
            $scope.fleet = item.fleet;
            $scope.color = item.color;

            $scope.title_modal_action = 'Editar';

            $scope.id = item.idcar;
            $scope.idfleet = item.idfleet;

            console.log($scope.id);

            $("#modalMessagePrimaryAdd").modal("show");

        };

        $scope.showModalInfo = function (item) {

            $scope.car_brand = item.namecarbrand;
            $scope.car_model = item.namecarmodel;
            $scope.year = item.year;
            $scope.car_transmission = item.nametransmission;
            $scope.car_motor = item.namemotor;
            $scope.car_fuel = item.namefuel;
            $scope.name_owner = item.nameowner;
            $scope.amountpassengers = item.amountpassengers;
            $scope.amountluggage = item.amountluggage;
            $scope.insurance_company = item.insurancecompany;
            $scope.secure_code = item.securecode;
            $scope.rent_cost = item.price;

            $scope.color_car = item.color;
            $scope.nameplace_car = item.nameplace;
            $scope.fleet_car = item.fleet;

            $scope.licenseplate_car = item.licenseplate;

            if (item.image !== null) {
                $scope.file_view = item.image;
            } else {
                $scope.file_view = '';
            }

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


