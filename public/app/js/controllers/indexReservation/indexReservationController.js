

    app.controller('IndexReservationController', function($scope, $http, API_URL) {

        $scope.type_place = null;
        $scope.selectServiceList = [];
        $scope.subtotal = 0.00;

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

        $scope.getAditionalServices = function () {

            $http.get(API_URL + 'reservation/getAditionalServices').then(function(response){

                $scope.aditionalServiceList = response.data;

            });

        };

        $scope.getOtherServices = function () {

            $http.get(API_URL + 'reservation/getOtherServices').then(function(response){

                $scope.otherServiceList = response.data;

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

        $scope.getDetails = function (item) {

            console.log(item);

            $scope.title_carbrand = item.namecarbrand;
            $scope.title_carmodel = item.namecarmodel;
            $scope.title_carimage = item.image;
            $scope.title_rentcost = item.price;

            $scope.cant_pasajeros = item.amountpassengers;
            $scope.cant_equipajes = item.amountluggage;
            $scope.tipo_fuel = item.namefuel;
            $scope.tipo_transmission = item.nametransmission;

            $('#modalMessageInfoCar').modal('show');

        };

        $scope.selectServicesClick = function (item) {


            $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item.price);

            $scope.iva = (parseFloat($scope.subtotal) * 12) / 100;

            $scope.total = parseFloat($scope.subtotal) + parseFloat($scope.iva);

            $scope.selectServiceList.push(item);
        };

        $scope.getPlaces();
        $scope.getCategories();
        $scope.getCar();
        $scope.getAditionalServices();
        $scope.getOtherServices();

    });