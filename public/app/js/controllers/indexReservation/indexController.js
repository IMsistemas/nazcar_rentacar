

    app.controller('IndexController', function($scope, $http, API_URL) {

        $scope.showModal = function () {
            $('#modalMessageError').modal('show');
        }

    });