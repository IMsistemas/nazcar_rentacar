/**
 * Created by MSc. Raidel Berrillo Gonzalez on 02/07/2017.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var URL = 'http://localhost:8000/';

var app = angular.module('reservationApp', ['ngRoute', 'ngSanitize', 'ngFileUpload', 'angularUtils.directives.dirPagination'])
    .constant('API_URL', URL);


app.config(['$locationProvider', function($locationProvider) {
    $locationProvider.hashPrefix('');
}]);

app.config(function($routeProvider){

    $routeProvider
        .when('/rent',{
            templateUrl : URL + 'rent',
            controller: 'RentController'
        })
        .when('/client',{
            templateUrl : URL + 'client',
            controller: 'ClientController'
        })
        .when('/car',{
            templateUrl : URL + 'car',
            controller: 'CarController'
        })
        .when('/Marca',{
            templateUrl : URL + 'Marca',
            controller: 'MarcaController'
        })
        .when('/FormPago',{
            templateUrl : URL + 'FormPago',
            controller: 'PagoController'
        })
        .when('/Modelo',{
            templateUrl : URL + 'Modelo',
            controller: 'ModeloController'
        })
        .when('/transmission',{
            templateUrl : URL + 'transmission',
            controller: 'transmissionController'
        })
        .when('/fuel',{
            templateUrl : URL + 'fuel',
            controller: 'fuelController'
        })
        .when('/motor',{
            templateUrl : URL + 'motor',
            controller: 'motorController'
        })
        .when('/service',{
            templateUrl : URL + 'service',
            controller: 'serviceController'
        })
        .otherwise({
            templateUrl : URL + 'index/index_b',
            controller : 'indexController'
        });

});