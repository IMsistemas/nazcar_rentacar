

    app.controller('RentController', function($scope, $http, API_URL) {


        $scope.initLoad = function(pageNumber){

            /*if ($scope.buscar !== undefined) {
                var search = $scope.buscar;
            } else var search = null;

            if ($scope.clientfilter !== undefined) {
                var idclient = $scope.clientfilter;
            } else var idclient = null;

            if ($scope.systemfilter !== undefined) {
                var idsystem = $scope.systemfilter;
            } else var idsystem = null;

            if ($scope.expired !== "0") {
                var expired = $scope.expired;
            } else var expired = null;

            if ($scope.billingfilter !== "") {
                var billingfilter = $scope.billingfilter;
            } else var billingfilter = null;

            if($("#startfilter").val() !== undefined && $("#startfilter").val()!== "" ){
                var s = $("#startfilter").val();
                var startdate = convertDatetoDB(s);
            } else var startdate = null;

            if($("#endfilter").val() !== undefined && $("#endfilter").val()!== ""){
                var e = $("#endfilter").val()
                var enddate = convertDatetoDB(e);
            } else var enddate = null;


            var filtros = {
                search: search,
                idclient: idclient,
                idsystem: idsystem,
                expired: expired,
                startdate: startdate,
                enddate: enddate,
                billingfilter: billingfilter
            };*/

            $http.get(API_URL + 'rent/listRents?page=' + pageNumber).then(function(response) {

                console.log(response);

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


    });