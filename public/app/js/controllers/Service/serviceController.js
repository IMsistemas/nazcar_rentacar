

    app.controller('serviceController', function($scope, $http, API_URL) {

        $scope.idservice = 0;
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

            $http.get(API_URL + 'service/getService?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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
            $scope.idservice = 0;
            $scope.service = '';
            $scope.type = '';
            $scope.price = '';
            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idservice = item.idservice;
            $scope.service = item.service;
            $scope.type = item.type;
            $scope.price = item.price;

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idservice = item.idservice;
            $scope.name_service = item.service;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {
                service: $scope.service,
                type: item.type,
                price: item.price
            };

            if ($scope.idservice === 0) {

                $http.post(API_URL + 'service', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El Tipo de Servicio se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar un Tipo de Servicio...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'service/' + $scope.idservice, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El tipo de Servicio se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar un Tipo de Servicio...';
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

            $http.put(API_URL + 'service/updateState/' + $scope.idservice, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado del Tipo de Servicio se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado del Tipo de Servicio...';
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