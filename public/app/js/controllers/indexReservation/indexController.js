

    app.controller('IndexController', function($scope, $http, API_URL) {

        $('.datepicker').datetimepicker({
            locale: 'es'
        });

        $('.datepickerA').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });

        $scope.reserva_1 = 1;

        $scope.showModal = function (step) {

            if (step === 1) {
                $scope.reserva_1 = 2;
            } else if (step === 2) {
                $scope.reserva_1 = 3;
            } else if (step === 3) {
                $scope.reserva_1 = 4;
            } else if (step === 4) {
                $scope.reserva_1 = 1;
            }

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

        $scope.getPlaces();

    });