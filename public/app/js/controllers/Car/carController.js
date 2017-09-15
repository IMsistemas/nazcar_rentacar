

    app.controller('CarController', function($scope, $http, API_URL) {


        $scope.initLoad = function(pageNumber){

            $scope.listCarbrand();

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

                console.log($scope.list);


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
                console.log($scope.marcaslist);
            });
        };

    });
    ///-- Guardar datos autos
    /*$scope.saveCar = function () {

        var data = {
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
            car_img: $scope.car_img
        };

        console.log(data);

        /*var url = API_URL + "car";

        if ($scope.idcar !== undefined){
            url += "/update/" + $scope.idschool;
        }

        Upload.upload({
            url: url,
            method: 'POST',
            data: data
        }).then(function(data, status, headers, config) {

            $scope.initLoad();

            if (data.data.success === true) {
                $scope.modalMessageSuccess = 'Se editaron correctamente los datos de la institución...';
                $('#modalMessageSuccess').modal('show');
                $scope.initLoad();
            } else {

            }

        });
    };*/
