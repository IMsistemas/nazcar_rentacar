

    app.controller('sliderController', function($scope, $http, API_URL, Upload) {

        $scope.idslider = 0;
        $scope.selectItem = null;
        $scope.estado = '1';

        $scope.listLanguage = [
            {label: 'ESPAÑOL', id: 'es_ES'},
            {label: 'INGLES', id: 'en_EN'}
        ];

        $scope.pageChanged = function(newPage) {
            $scope.initLoad(newPage);
        };

        $scope.initLoad = function(pageNumber){

            $scope.language = 'es_ES';

            $scope.getlistOrder();

            if ($scope.estado !== undefined) {
                var state = $scope.estado;
            } else var state = null;

            var filtros = {
                state: state
            };

            $http.get(API_URL + 'slider/getDataSlider?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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

        $scope.getlistOrder = function () {

            var arrayList = [];

            for (var i = 1; i <= 20; i++) {
                arrayList.push({label: i, id: i});
            }


            $scope.listOrder = arrayList;
            $scope.order = 1;

        };

        $scope.cancel = function () {
            $scope.idslider = 0;
            $scope.language = 'es_ES';
            $scope.file = '';
            $scope.getlistOrder();
            $scope.selectItem = null;
        };

        $scope.add = function () {
            $scope.cancel();
            $scope.title_modal_action = 'Agregar';
            $('#modalAction').modal('show');
        };

        $scope.edit = function (item) {
            $scope.cancel();

            $scope.idslider = item.idslider;
            $scope.language = item.language;
            $scope.order = item.order;
            $scope.file = item.image_url;

            $scope.title_modal_action = 'Editar';
            $('#modalAction').modal('show');
        };

        $scope.editState = function (item) {
            $scope.cancel();

            $scope.idslider = item.idslider;
            $scope.selectItem = item;

            $('#modalSetState').modal('show');
        };

        $scope.save = function () {

            var data = {
                idslider: $scope.idslider,
                language: $scope.language,
                order: $scope.order,
                file: $scope.file
            };

            Upload.upload({

                url: 'slider',
                method: 'POST',
                data: data

            }).then(function(data, status, headers, config) {

                $("#modalAction").modal("hide");

                if (data.data.success === true) {

                    $scope.initLoad(1);

                    $scope.message_success = 'Se ha guardado la imagen satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar almacenar una imagen...';
                    $('#modalError').modal('show');

                }
            });
        };

        $scope.saveSetState = function () {

            var state = 0;

            if ($scope.selectItem.state === '0') {
                state = 1;
            }

            var data = {
                state: state
            };

            $http.put(API_URL + 'slider/updateState/' + $scope.idslider, data).then(function(response) {

                $('#modalSetState').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El estado de la Imagen se ha editado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar editar el estado de la Imagen...';
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