

    app.controller('reportController', function($scope, $http, API_URL) {

        $scope.getTopCar = function () {

            $http.get(API_URL + 'topcar/getTopCar').then(function(response) {

                $scope.list = response.data;
            })
            .catch(function(data, status) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                //console.log("finally finished gists");
            });

        };

        $scope.getCountRentxMonth = function () {

            var fecha = new Date();
            var year = fecha.getFullYear();

            $http.get(API_URL + 'countrentxmonth/getCountRentxMonth/' + year).then(function(response) {

                $scope.list0 = [];

                var month_array = [
                    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                    'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE','NOVIEMBRE', 'DICIEMBRE'
                ];

                var lista = response.data;

                console.log(lista);

                var longitud = response.data.length;

                for (var i = 0; i < longitud; i++) {

                    var o = {
                        mes: month_array[parseInt(lista[i].mes) - 1],
                        cantidad: lista[i].cantidad
                    };

                    $scope.list0.push(o);

                }

                console.log($scope.list0);
            })
            .catch(function(data, status) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                //console.log("finally finished gists");
            });

        };

    });


    function showModal(id){
        $('#' + id).modal('show')
    }