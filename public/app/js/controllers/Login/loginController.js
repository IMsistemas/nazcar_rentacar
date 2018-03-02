

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

            console.error('Gists error', status, data);

        }).finally(function() {

            //console.log("finally finished gists");

        });

    };

    $scope.showConfirm = function () {

        $('#modalResetPassword').modal('show');

    };

    $scope.resetPassword = function () {

        //si

        $http.post(API_URL + 'index/resetPassword', {} ).then(function (response) {

            $('#modalResetPassword').modal('hide');

            if (response.data.success === true) {

                $scope.message_success = 'Se ha actualizado y enviado el Password Nuevo al email registrado...';

                $('#modalSuccess').modal('show');

            } else {

                $scope.message_error = 'Ha ocurrido un error al intentar generar un Password Nuevo...';

                $('#modalError').modal('show');

            }

        })
        .catch(function(data, status) {

            console.error('Gists error', status, data);

        }).finally(function() {

            //console.log("finally finished gists");

        });

    };

});