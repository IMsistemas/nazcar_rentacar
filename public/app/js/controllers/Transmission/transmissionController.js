

    app.controller('transmissionController', function($scope, $http, API_URL) {

        $scope.idtransmission = 0;
        $scope.selectItem = null;

        $scope.pageChanged = function(newPage) {
            $scope.initLoad(newPage);
        };

        $scope.initLoad = function(pageNumber){

            if ($scope.buscar !== undefined) {
                var search = $scope.buscar;
            } else var search = null;

            if ($scope.statefilter !== undefined) {
                var state = $scope.statefilter;
            } else var state = null;

            var filtros = {
                search: search,
                state: state
            };

            $http.get(API_URL + 'transmission/getTransmission?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

                $scope.list = response.data;
                $scope.totalItems = response.data.total;

                console.log($scope.list);
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
            $scope.idtransmission = 0;
            $scope.nametransmission = '';
            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idtransmission = item.idtransmission;
            $scope.nametransmission = item.nametransmission;

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idtransmission = item.idtransmission;
            $scope.name_transmission = item.nametransmission;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {
                nametransmission: $scope.nametransmission
            };

            if ($scope.idtransmission === 0) {

                $http.post(API_URL + 'transmission', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'La Transmisión se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar una Transmisión...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'transmission/' + $scope.idtransmission, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'La Transmisión se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar una Transmisión...';
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

            $http.put(API_URL + 'transmission/updateState/' + $scope.idtransmission, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado de la Transmisión se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado de la Transmisión...';
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