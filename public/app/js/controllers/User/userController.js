

    app.controller('userController', function($scope, $http, API_URL) {

        $scope.idadministrator = 0;
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

            $http.get(API_URL + 'user/getUser?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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
            $scope.idadministrator = 0;
            $scope.nameperson = '';
            $scope.lastnameperson = '';
            $scope.identifyperson = '';
            $scope.emailperson = '';
            $scope.numphoneperson = '';
            $scope.users = '';
            $scope.password = '';

            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idadministrator = item.idadministrator;
            $scope.nameperson = item.nameperson;
            $scope.lastnameperson = item.lastnameperson;
            $scope.identifyperson = item.identifyperson;
            $scope.emailperson = item.emailperson;
            $scope.numphoneperson = item.numphoneperson;
            $scope.users = item.users;
            $scope.password = '';

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idadministrator = item.idadministrator;
            $scope.name_users= item.nameperson + ' ' + item.lastnameperson;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {

                nameperson: $scope.nameperson,
                lastnameperson: $scope.lastnameperson,
                identifyperson: $scope.identifyperson,
                emailperson: $scope.emailperson,
                numphoneperson: $scope.numphoneperson,
                users: $scope.users,
                password: $scope.password,

            };

            if ($scope.idadministrator === 0) {

                $http.post(API_URL + 'user', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El usuario se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar un usuario...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'user/' + $scope.idadministrator, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'El usuario se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad(1);

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar un usuario...';
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

            $http.put(API_URL + 'user/updateState/' + $scope.idadministrator, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado del usuario se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado del usuario...';
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