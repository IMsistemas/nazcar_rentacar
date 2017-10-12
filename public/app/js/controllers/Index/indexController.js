

    app.controller('IndexController', function($scope, $http, API_URL) {

        $scope.toLogout = function () {
            $('#modalConfirmLogout').modal('show');
        };

        $scope.logoutSystem = function () {

            $http.get(API_URL + 'index/logout' ).then(function (response) {

                location.reload(true);

            })
            .catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });

        };

    });