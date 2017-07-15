app.controller('MarcaController', function($scope, $http, API_URL) {
    $scope.Title="Registro de Marcas de Autos ";
});

$(document).ready(function(){

});
function showModal(id){
    $('#' + id).modal('show')
}
