

    app.controller('reportController', function($scope, $http, API_URL) {

        $('.datepickerA').datetimepicker({

            locale: 'es',
            viewMode: 'years',
            format: 'YYYY'

        }).on('dp.change', function (e) {

            $scope.year = $('#year').val();

            $scope.getCountRentxMonth($scope.year);

        });

        $scope.getTopCar = function () {

            $http.get(API_URL + 'topcar/getTopCar').then(function(response) {

                $scope.list = [];

                var top5 = response.data[0];
                var cost = response.data[1];

                $scope.subtotal_end = 0;
                $scope.iva_end = 0;
                $scope.total_end = 0;

                $scope.cantidad_end = 0;

                var longitud = top5.length;

                for (var i = 0; i < longitud; i++) {

                    var object = {

                        namecarbrand: top5[i].namecarbrand,
                        namecarmodel: top5[i].namecarmodel,
                        cantidad: top5[i].cantidad,

                        subtotal: cost[i].subtotal,
                        iva: cost[i].iva,
                        total: cost[i].total

                    };

                    $scope.subtotal_end = parseFloat($scope.subtotal_end) + parseFloat(cost[i].subtotal);
                    $scope.iva_end = parseFloat($scope.iva_end) + parseFloat(cost[i].iva);
                    $scope.total_end = parseFloat($scope.total_end) + parseFloat(cost[i].total);

                    $scope.cantidad_end = parseInt($scope.cantidad_end) + parseInt(top5[i].cantidad);

                    $scope.list.push(object);

                }

            })
            .catch(function(data, status) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                //console.log("finally finished gists");
            });

        };

        $scope.getCountRentxMonth = function (year) {

            if (year === undefined) {

                var fecha = new Date();
                year = fecha.getFullYear();

            }


            $http.get(API_URL + 'countrentxmonth/getCountRentxMonth/' + year).then(function(response) {

                $scope.list0 = [];

                var month_array = [
                    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                    'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE','NOVIEMBRE', 'DICIEMBRE'
                ];

                var lista = response.data;
                var temp = [];

                $scope.subtotal_end = 0;
                $scope.iva_end = 0;
                $scope.total_end = 0;
                $scope.cantidad_end = 0;

                var longitud = response.data.length;

                for (var i = 0; i < longitud; i++) {

                    if (temp.length === 0) {

                        var o = {

                            mes: month_array[parseInt(lista[i].mes) - 1],
                            cantidad: 1,
                            subtotal: parseFloat(lista[i].subtotal).toFixed(2),
                            iva: parseFloat(lista[i].iva).toFixed(2),
                            total: parseFloat(lista[i].total).toFixed(2)

                        };

                        temp.push(o);

                    } else {

                        var flag = false;

                        for (var j = 0; j < temp.length; j++) {

                            if (temp[j].mes === month_array[parseInt(lista[i].mes) - 1]) {

                                temp[j].cantidad++;
                                temp[j].subtotal = (parseFloat(temp[j].subtotal) + parseFloat(lista[i].subtotal)).toFixed(2);
                                temp[j].iva = (parseFloat(temp[j].iva) + parseFloat(lista[i].iva)).toFixed(2);
                                temp[j].total = (parseFloat(temp[j].total) + parseFloat(lista[i].total)).toFixed(2);

                                flag = true;

                                break;

                            }

                        }

                        if (flag === false) {

                            var o = {

                                mes: month_array[parseInt(lista[i].mes) - 1],
                                cantidad: 1,
                                subtotal: parseFloat(lista[i].subtotal).toFixed(2),
                                iva: parseFloat(lista[i].iva).toFixed(2),
                                total: parseFloat(lista[i].total).toFixed(2)

                            };

                            temp.push(o);

                        }

                    }

                    $scope.subtotal_end = $scope.subtotal_end + parseFloat(lista[i].subtotal);
                    $scope.iva_end = $scope.iva_end + parseFloat(lista[i].iva);
                    $scope.total_end = $scope.total_end + parseFloat(lista[i].total);

                    /*$scope.subtotal_end = parseFloat($scope.subtotal_end).toFixed(2);*/


                    $scope.cantidad_end++;

                    $scope.list0 = temp;

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