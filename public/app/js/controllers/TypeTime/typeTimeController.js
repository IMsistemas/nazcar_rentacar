

    app.controller('typeTimeController', function($scope, $http, API_URL) {

        $scope.idtypetime = 0;
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

            $http.get(API_URL + 'typetime/getTypeTime?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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
            $scope.idtypetime = 0;
            $scope.nametypetime = '';
            $scope.amountday = '';
            $scope.typeclient = '';
            $scope.typecalculate = '';
            $scope.constant = '';
            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idtypetime = item.idtypetime;
            $scope.nametypetime = item.nametypetime;
            $scope.amountday = item.amountday;
            $scope.typeclient = item.typeclient;
            $scope.typecalculate = item.typecalculate;
            $scope.constant = item.constant;

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idtypetime = item.idtypetime;
            $scope.name_typetime = item.nametypetime;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {
                nametypetime: $scope.nametypetime,
                amountday: $scope.amountday,
                typeclient: $scope.typeclient,
                typecalculate: $scope.typecalculate,
                constant: $scope.constant
            };

            if ($scope.idtypetime === 0) {

                $http.post(API_URL + 'typetime', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El Tipo de Tiempo se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar un Tipo de Tiempo...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'typetime/' + $scope.idtypetime, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El tipo de Tiempo se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar un Tipo de Tiempo...';
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

            $http.put(API_URL + 'typetime/updateState/' + $scope.idtypetime, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado del Tipo de Tiempo se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado del Tipo de Tiempo...';
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