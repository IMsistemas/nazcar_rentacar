

    app.controller('CarController', function($scope, $http, API_URL, Upload) {

        $scope.id = 0;

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

        $scope.showModalAdd = function () {

            $("#modalMessagePrimaryAdd").modal("show");

        }

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


