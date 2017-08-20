

    app.controller('ClientController', function($scope, $http, API_URL) {

        $scope.iditem = 0;
        $scope.aux_estado= "";
        $scope.idpersonitem = 0;

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

            $http.get(API_URL + 'client/listClients?page=' + pageNumber + '&filter=' + JSON.stringify(filtros)).then(function(response) {

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

        //----Llenar el select de paises-----//
        $scope.getCountrys = function () {

            $http.get(API_URL + 'client/getListCountry').then(function(response){

                var long = response.data.length;
                var array = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < long; i++){
                    array.push({label: response.data[i].country, id: response.data[i].idcountry})
                }
                $scope.countrylist = array;
                $scope.country = '';
            });

        };

        //-----llenar el select de formas de pago----//
        $scope.getPaidForms = function () {

            $http.get(API_URL + 'client/getPaidForms').then(function(response){

                var long = response.data.length;
                var array = [{label: '-- Seleccione --', id: ''}];
                for(var i = 0; i < long; i++){
                    array.push({label: response.data[i].namepaidform , id: response.data[i].idpaidform})
                }
                $scope.paidlist = array;
                $scope.paidform = '';
            });

        };

        $scope.showModalInformation = function (item) {

            $scope.client = item.nameperson + " " + item.lastnameperson;
            $scope.identify = item.identifyperson;
            $scope.email = item.emailperson;
            $scope.phone = item.numphoneperson;
            $scope.cell = item.numcelperson;
            $scope.address = item.addressperson;
            $scope.activity = item.activitystatus;
            $scope.country = item.country;
            $scope.paidform = item.namepaidform;

            $("#modalMessageInfo").modal("show");

        };

        $scope.showModalEdit = function (item) {

            $scope.iditem = item.idclient;
            $scope.idpersonitem = item.idperson;
            $scope.aux_estado = item.state;
            $scope.name = item.nameperson;
            $scope.lastname = item.lastnameperson;
            $scope.identify = item.identifyperson;
            $scope.email = item.emailperson;
            $scope.phone = item.numphoneperson;
            $scope.cell = item.numcelperson;
            $scope.address = item.addressperson;
            $scope.activity = item.activitystatus;
            $scope.country = item.idcountry;
            $scope.paidform = item.idpaidform;

            $("#modalMessagePrimaryEdit").modal("show");

        };

        $scope.showModalAnular = function (item) {

            $scope.iditem = item.idclient;
            $scope.aux_estado = item.state;

            $("#modalMessagePrimary").modal("show");

        };

        ///--- editar cliente-----//
        $scope.edit=function(){

            var data = {
                idperson: $scope.idpersonitem,
                name: $scope.name,
                lastname: $scope.lastname,
                identify: $scope.identify,
                email: $scope.email,
                phone: $scope.phone,
                cell: $scope.cell,
                address: $scope.address,
                activity: $scope.activity,
                country: $scope.country,
                paidform: $scope.paidform
            };
            $http.put(API_URL + 'client/' + $scope.iditem, data).then(function(response) {

                if (response.data.success === true) {
                    $scope.iditem = 0;
                    $('#modalMessagePrimaryEdit').modal('hide');
                    $scope.message = 'Se han modificado correctamente los datos del cliente seleccionado...';
                    $('#modalMessage').modal('show');
                    $scope.initLoad(1);
                } else {

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });
        };

        $scope.activarInactivar = function(){

            if ( $scope.aux_estado === "1"){
                $scope.estado = "0";
            } else $scope.estado = "1";

            var data = {
                state: $scope.estado
            };
            $http.put(API_URL + 'client/activarInactivar/' + $scope.iditem, data).then(function(response) {

                if (response.data.success === true) {
                    $scope.iditem = 0;
                    $('#modalMessagePrimaryEdit').modal('hide');
                    $scope.message = 'Se han modificado correctamente los datos del cliente seleccionado...';
                    $('#modalMessage').modal('show');
                    $scope.initLoad(1);
                } else {

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });
        };



        $scope.getCountrys();
        $scope.getPaidForms();
    });

    $(document).ready(function(){

    });
    function showModal(id){
        $('#' + id).modal('show')
    }