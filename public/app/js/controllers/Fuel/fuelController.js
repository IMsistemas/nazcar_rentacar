

    app.controller('fuelController', function($scope, $http, API_URL) {

        $scope.idfuel = 0;
        $scope.selectItem = null;
        $scope.estado = '1';

        $scope.pageChanged = function(newPage) {
            $scope.initLoad(newPage);
        };

        $scope.initLoad = function(pageNumber){

            if ($scope.busqueda !== undefined) {
                var search = $scope.busqueda;
            } else var search = null;

            if ($scope.estado !== undefined) {
                var state = $scope.estado;
            } else var state = null;

            var filtros = {
                search: search,
                state: state
            };

            $http.get(API_URL + 'fuel/getFuel?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

                $scope.list = response.data.data;
                $scope.totalItems = response.data.total;
            })
            .catch(function(data, status) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                //console.log("finally finished gists");
            });

        };


        /*
            METHOD ACTION-----------------------------------------------------------------------------------------------
         */

        $scope.cancel = function () {
            $scope.idfuel = 0;
            $scope.namefuel = '';
            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idfuel = item.idfuel;
            $scope.namefuel = item.namefuel;

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idfuel = item.idfuel;
            $scope.name_fuel = item.namefuel;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {
                namefuel: $scope.namefuel
            };

            if ($scope.idfuel === 0) {

                $http.post(API_URL + 'fuel', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El Tipo de Combustible se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar un Tipo de Combustible...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'fuel/' + $scope.idfuel, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El tipo de Combustible se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar un Tipo de Combustible...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });


            }
        };

        $scope.saveSetState = function () {

            var state = 0;

            if ($scope.selectItem.state === '0') {
                state = 1;
            }

            var data = {
                state: state
            };

            $http.put(API_URL + 'fuel/updateState/' + $scope.idfuel, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado del Tipo de Combustible se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado del Tipo de Combustible...';
                    $('#modalError').modal('show');

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });
        };

    });


    function showModal(id){
        $('#' + id).modal('show')
    }