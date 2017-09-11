

    app.controller('IndexController', function($scope, $http, API_URL) {

        $scope.reserva_1 = 1;

        $scope.showModal = function (step) {

            if (step === 1) {
                $scope.reserva_1 = 2;
            } else if (step === 2) {
                $scope.reserva_1 = 1;
            }

            //$('#modalMessageError').modal('show');
        }

    });