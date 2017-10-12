

app.controller('loginController', function($scope, $http, API_URL, Upload) {


    $scope.verify = function () {

        var object = {
            users: $scope.users,
            password: $scope.password
        };

        $http.post(API_URL, object ).then(function (response) {

            if (response.data.success === false) {

                $scope.text_failed = 'Upss! Usuario y/o Password incorrecto.';
                $('#view-failed-login').show();

            } else {

                console.log(response.data.type);

                location.reload(true);

            }

        })
            .catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

            //console.log("finally finished gists");

        });

    };

});