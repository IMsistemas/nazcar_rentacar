

    app.controller('IndexReservationController', function($scope, $http, API_URL) {

        $scope.type_place = null;

        $('.datepicker').datetimepicker({
            locale: 'es'
        });

        $('.datepickerA').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });

        $scope.reserva_1 = 1;

        $scope.showModal = function (step) {

            $scope.reserva_1 = step;

            //$('#modalMessageError').modal('show');
        };

        $scope.getPlaces = function () {

            $http.get(API_URL + 'reservation/getPlaces').then(function(response){

                var longitud = response.data.length;
                var array = [{label: '-- Seleccione Lugar --', id: ''}];

                for(var i = 0; i < longitud; i++){
                    array.push({label: response.data[i].nameplace, id: response.data[i].idplace});
                }

                $scope.placelist = array;
                $scope.lugar_retiro = '';
                $scope.lugar_entrega = '';
            });

        };



        $scope.save = function () {



        };


        $scope.showListPlace = function (type) {

            $http.get(API_URL + 'reservation/getPlaces').then(function(response){

                /*var longitud = response.data.length;
                var array = [];

                for(var i = 0; i < longitud; i++){
                    array.push({label: response.data[i].nameplace, id: response.data[i].idplace});
                }*/

                $scope.placelist = response.data;

                if (type === 0) {
                    $scope.type_place = 'Retiro';
                    $scope.type_place = 0;
                } else {
                    $scope.type_place = 'Entrega';
                    $scope.type_place = 1;
                }

                $('#modalMessagePlace').modal('show');


            });

        };

        $scope.selectOptionPlace = function (item) {

            if ($scope.type_place === 0) {
                $scope.lugar_retiro = item.nameplace;
            } else {
                $scope.lugar_entrega = item.nameplace;
            }


            $('#modalMessagePlace').modal('hide');

        };

        $scope.getCategories = function () {

            $http.get(API_URL + 'reservation/getCategories').then(function(response){

                $scope.categorieslist = response.data;
            });

        };

        $scope.getCar = function () {

            $http.get(API_URL + 'reservation/getCar').then(function(response){

                $scope.carlist = response.data;
            });

        };


        $scope.getPlaces();
        $scope.getCategories();
        $scope.getCar();

    });