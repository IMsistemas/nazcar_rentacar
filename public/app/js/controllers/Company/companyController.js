

    app.controller('companyController', function($scope, $http, API_URL, Upload) {

        $scope.idcompany = 0;
        $scope.idpaypal = 0;

        $scope.initLoad = function(){

            $scope.getDataCompany();

            $scope.getDataPaypal();

        };

        $scope.getDataCompany = function () {

            $http.get(API_URL + 'company/getDataCompany').then(function(response) {

                if (response.data.length > 0) {

                    $scope.namecompany = response.data[0].namecompany;
                    $scope.ruccompany = response.data[0].ruccompany;
                    $scope.contribcompany = response.data[0].contributoridcompany;
                    $scope.emailcompany = response.data[0].emailcompany;
                    $scope.addresscompany = response.data[0].addresscompany;
                    $scope.file = response.data[0].logocompany;

                    $scope.idcompany = response.data[0].idcompany;

                } else {

                    $scope.namecompany = '';
                    $scope.ruccompany = '';
                    $scope.contribcompany = '';
                    $scope.emailcompany = '';
                    $scope.addresscompany = '';

                    $scope.idcompany = 0;

                }

            })
            .catch(function(data, status) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                //console.log("finally finished gists");
            });

        };

        $scope.getDataPaypal = function () {

            $http.get(API_URL + 'configpaypal/getDataPaypal').then(function(response) {

                if (response.data.length > 0) {

                    $scope.client_id_sandox = response.data[0].client_id_sandox;
                    $scope.secret_id_sandox = response.data[0].secret_id_sandox;
                    $scope.client_id_live = response.data[0].client_id_live;
                    $scope.secret_id_live = response.data[0].secret_id_live;
                    $scope.mode = response.data[0].mode;

                    $scope.idpaypal = response.data[0].idpaypal;

                } else {

                    $scope.client_id_sandox = '';
                    $scope.secret_id_sandox = '';
                    $scope.client_id_live = '';
                    $scope.secret_id_live = '';

                    $scope.idpaypal = 0;

                }

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

        $scope.cancelCompany = function () {
            $scope.getDataCompany();
        };

        $scope.cancelPaypal = function () {
            $scope.getDataPaypal();
        };

        $scope.saveCompany = function () {

            var data = {
                idcompany: $scope.idcompany,
                namecompany: $scope.namecompany,
                ruccompany: $scope.ruccompany,
                contributoridcompany: $scope.contribcompany,
                emailcompany: $scope.emailcompany,
                addresscompany: $scope.addresscompany,
                file: $scope.file
            };

            Upload.upload({

                url: 'company',
                method: 'POST',
                data: data

            }).then(function(data, status, headers, config) {

                if (data.data.success === true) {

                    $scope.initLoad();

                    $scope.message_success = 'La información de la Empresa se ha guardado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar guardar la información de la Empresa...';
                    $('#modalError').modal('show');
                }
            });

            /*if ($scope.idcompany === 0) {

                $http.post(API_URL + 'company', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.idcompany = response.data.idcompany;

                        $scope.message_success = 'La información de la Empresa se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad();

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar la información de la Empresa...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'company/' + $scope.idcompany, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancel();

                        $scope.message_success = 'La información de la Empresa se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad();

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar la información de la Empresa...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });


            }*/
        };

        $scope.savePaypal = function () {

            var data = {
                client_id_sandox: $scope.client_id_sandox,
                secret_id_sandox: $scope.secret_id_sandox,
                client_id_live: $scope.client_id_live,
                secret_id_live: $scope.secret_id_live,
                mode: $scope.mode
            };

            if ($scope.idpaypal === 0) {

                $http.post(API_URL + 'configpaypal', data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancelPaypal();

                        $scope.message_success = 'La información de Paypal se ha agregado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad();

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar agregar la información de Paypal...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            }
            else {

                $http.put(API_URL + 'configpaypal/' + $scope.idpaypal, data).then(function(response) {

                    $('#modalAction').modal('hide');

                    if (response.data.success === true) {

                        $scope.cancelPaypal();

                        $scope.message_success = 'La información de Paypal se ha editado satisfactoriamente...';
                        $('#modalSuccess').modal('show');

                        $scope.initLoad();

                    } else {

                        $scope.message_error = 'Ha ocurrido un error al intentar editar la información de Paypal...';
                        $('#modalError').modal('show');

                    }

                }).catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });


            }
        };

    });


    function showModal(id){
        $('#' + id).modal('show')
    }