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
        .when('/',{
            templateUrl : URL + '',
            controller: ''
        })
        /*.otherwise({
            templateUrl : URL + '',
            controller : ''
        })*/;

});