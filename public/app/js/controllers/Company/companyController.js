

    app.controller('companyController', function($scope, $http, API_URL) {

        $scope.idcompany = 0;

        $scope.initLoad = function(){

            $scope.getDataCompany();

        };

        $scope.getDataCompany = function () {

            $http.get(API_URL + 'company/getDataCompany').then(function(response) {

                if (response.data.length > 0) {

                    $scope.namecompany = response.data[0].namecompany;
                    $scope.ruccompany = response.data[0].ruccompany;
                    $scope.contribcompany = response.data[0].contributoridcompany;
                    //$scope.emailcompany = response.data[0].namecompany;
                    $scope.addresscompany = response.data[0].addresscompany;

                    $scope.idcompany = response.data[0].idcompany;

                } else {

                    $scope.namecompany = '';
                    $scope.ruccompany = '';
                    $scope.contribcompany = '';
                    //$scope.emailcompany = ';
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


        /*
            METHOD ACTION-----------------------------------------------------------------------------------------------
         */

        $scope.cancel = function () {
            $scope.idcompany = 0;
        };

        $scope.saveCompany = function () {

            var data = {
                namecompany: $scope.namecompany,
                ruccompany: $scope.ruccompany,
                contributoridcompany: $scope.contribcompany,
                emailcompany: $scope.emailcompany,
                addresscompany: $scope.addresscompany
            };

            if ($scope.idcompany === 0) {

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


            }
        };


    });


    function showModal(id){
        $('#' + id).modal('show')
    }