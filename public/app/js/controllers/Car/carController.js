

    app.controller('CarController', function($scope, $http, API_URL) {

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
