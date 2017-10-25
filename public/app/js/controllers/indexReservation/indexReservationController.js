

    app.controller('IndexReservationController', function($scope, $http, API_URL) {

        $scope.typepago = null;
        $scope.registered = false;
        $scope.registeredClient = null;

        $scope.type_place = null;
        $scope.type_place_text = null;

        $scope.carSelected = null;
        $scope.dataRetiroPlace = null;
        $scope.dataEntregaPlace = null;

        $scope.stateRegister = 0;

        $scope.selectServiceList = [];
        $scope.subtotal = '0.00';
        $scope.iva = '0.00';
        $scope.total = '0.00';

        $('.datepicker').datetimepicker({
            locale: 'es',
            minDate: new Date()
        });

        $('.datepickerA').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD',
            minDate: new Date()
        }).on('dp.change', function (e) {

            $('#fecha_entrega').data("DateTimePicker").minDate(e.date);

        });

        $('.datepickerB').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });

        $scope.reserva_1 = 1;

        $scope.getlistEdad = function () {

            var arrayList = [{label: 'Seleccionar Edad', id: ''}];

            for (var i = 18; i <= 65; i++) {
                arrayList.push({label: i, id: i});
            }


            $scope.listEdad = arrayList;
            $scope.edad = '';

        };

        $scope.intermediateStep = function (item, type) {
            $scope.carSelected = item;

            $scope.title_carbrand = item.namecarbrand;
            $scope.title_carmodel = item.namecarmodel;
            $scope.title_carimage = item.image;
            $scope.title_rentcost = item.price;

            $scope.showModal(3, type);
        };

        $scope.showModal = function (step, type) {

            $('#modalMessageInfoCar').modal('hide');

            if (step === 2) {
                $scope.rest_day = $scope.restaFechas($scope.fecha_retiro, $scope.fecha_entrega);
            }

            if (step === 3) {

                //type

                $scope.typepago = type;

                var item_0 = {
                    idservice: 0,
                    service: 'Renta',
                    price: 0
                };

                if (parseInt($scope.rest_day) > 1) {

                    var data = {
                        cantday: parseInt($scope.rest_day),
                        price: $scope.carSelected.price
                    };

                    $http.get(API_URL + 'reservation/getCalculate?parameter=' + JSON.stringify(data)).then(function(response){

                        item_0.price = response.data;



                        var longitud = $scope.selectServiceList.length;

                        if (longitud === 0) {

                            $scope.selectServiceList.push(item_0);

                            $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item_0.price);
                            $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                            $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

                        } else {

                            for (var i = 0; i < longitud; i++) {

                                if ($scope.selectServiceList[i].idservice === 0) {

                                    if (parseFloat($scope.selectServiceList[i].price) < parseFloat(response.data)) {

                                        console.log(response.data);

                                        $scope.subtotal = parseFloat($scope.subtotal) - parseFloat($scope.selectServiceList[i].price);

                                        $scope.selectServiceList[i].price = response.data;

                                        $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(response.data);
                                        $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                                        $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

                                    }

                                    break;
                                }

                            }

                        }

                    });

                } else {

                    item_0.price = $scope.carSelected.price;

                    $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item_0.price);
                    $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                    $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

                    $scope.selectServiceList.push(item_0);

                }


            }

            if (step === 4) {

                 if ($scope.registered === true) {

                     $scope.names = $scope.registeredClient.nameperson;
                     $scope.lastnames = $scope.registeredClient.lastnameperson;
                     $scope.docident = $scope.registeredClient.identifyperson;
                     $scope.email = $scope.registeredClient.emailperson;
                     $scope.phone = $scope.registeredClient.numphoneperson;

                     $('#accRegister').hide();

                     step = 5;
                 } else {

                     $('#accRegister').show();

                 }

            }


            if (step === 5) {

                if ($scope.typepago === 'paypal') {

                    $('#btn_caja').hide();
                    $('#btn_paypal').show();

                } else {

                    $('#btn_paypal').hide();
                    $('#btn_caja').show();

                }

            }

            $scope.reserva_1 = step;

        };

        $scope.getPlaces = function () {

            $http.get(API_URL + 'reservation/getPlaces').then(function(response){

                var longitud = response.data.length;
                var array = [{label: '-- Seleccione Lugar --', id: ''}];

                for(var i = 0; i < longitud; i++){
                    array.push({label: response.data[i].nameplace, id: response.data[i].idplace});
                }

                $scope.placelist = array;
                $scope.lugar_retiro = '';
                $scope.lugar_entrega = '';
            });

        };

        $scope.getAditionalServices = function () {

            $http.get(API_URL + 'reservation/getAditionalServices').then(function(response){

                $scope.aditionalServiceList = response.data;

            });

        };

        $scope.getOtherServices = function () {

            $http.get(API_URL + 'reservation/getOtherServices').then(function(response){

                $scope.otherServiceList = response.data;

            });

        };

        $scope.showListPlace = function (type) {

            $http.get(API_URL + 'reservation/getPlaces').then(function(response){

                /*var longitud = response.data.length;
                var array = [];

                for(var i = 0; i < longitud; i++){
                    array.push({label: response.data[i].nameplace, id: response.data[i].idplace});
                }*/

                $scope.placelist = response.data;

                if (type === 0) {
                    $scope.type_place_text = 'Retiro';
                    $scope.type_place = 0;
                } else {
                    $scope.type_place_text = 'Entrega';
                    $scope.type_place = 1;
                }

                $('#modalMessagePlace').modal('show');


            });

        };

        $scope.selectOptionPlace = function (item) {

            if ($scope.type_place === 0) {

                $scope.lugar_retiro = item.nameplace;
                $scope.dataRetiroPlace = item;
                $scope.data_retiro_code = item.codeplace;
                $scope.data_retiro_place = item.nameplace;

            } else {

                $scope.lugar_entrega = item.nameplace;
                $scope.dataEntregaPlace = item;
                $scope.data_entrega_code = item.codeplace;
                $scope.data_entrega_place = item.nameplace;

            }

            $('#modalMessagePlace').modal('hide');

        };

        $scope.getCategories = function () {

            $http.get(API_URL + 'reservation/getCategories').then(function(response){

                $scope.categorieslist = response.data;
            });

        };

        $scope.getCar = function (categories) {

            $http.get(API_URL + 'reservation/getCar/' + categories).then(function(response){

                $scope.carlist = response.data;
            });

        };

        $scope.getDetails = function (item) {

            console.log(item);

            $scope.title_carbrand = item.namecarbrand;
            $scope.title_carmodel = item.namecarmodel;
            $scope.title_carimage = item.image;
            $scope.title_rentcost = item.price;

            $scope.cant_pasajeros = item.amountpassengers;
            $scope.cant_equipajes = item.amountluggage;
            $scope.tipo_fuel = item.namefuel;
            $scope.tipo_transmission = item.nametransmission;

            $scope.carSelected = item;

            $('#modalMessageInfoCar').modal('show');

        };

        $scope.selectServicesClick = function (item, field) {

            var type = field.split('_');
            var flag = true;

            if (type[0] === 'radio') {

                var temp = [];

                var longitud = $scope.selectServiceList.length;
                $scope.subtotal = 0;

                for (var i = 0; i < longitud; i++) {

                    if ($scope.selectServiceList[i].type !== '0') {

                        temp.push($scope.selectServiceList[i]);
                        $scope.subtotal = parseFloat($scope.subtotal) + parseFloat($scope.selectServiceList[i].price);

                    } else {

                        flag = false;
                        temp.push(item);
                        $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item.price);

                    }

                }

                $scope.selectServiceList = temp;

                if (flag === true) {

                    $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item.price);

                    $scope.selectServiceList.push(item);

                }

                $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

            } else {

                if (type[1] !== 'true') {

                    var temp = [];

                    var longitud = $scope.selectServiceList.length;
                    $scope.subtotal = 0;

                    for (var i = 0; i < longitud; i++) {

                        if ($scope.selectServiceList[i].idservice !== item.idservice) {

                            temp.push($scope.selectServiceList[i]);
                            $scope.subtotal = parseFloat($scope.subtotal) + parseFloat($scope.selectServiceList[i].price);

                        }

                    }

                    $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                    $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

                    $scope.selectServiceList = temp;

                } else {

                    $scope.subtotal = parseFloat($scope.subtotal) + parseFloat(item.price);

                    $scope.iva = ((parseFloat($scope.subtotal) * 12) / 100).toFixed(2);
                    $scope.total = (parseFloat($scope.subtotal) + parseFloat($scope.iva)).toFixed(2);

                    $scope.selectServiceList.push(item);

                }

            }

        };

        $scope.reafirmDate = function (type) {

            if (type === 0) {
                $scope.fecha_retiro = $('#fecha_retiro').val();
                $scope.data_retiro_date = $scope.convertDate($scope.fecha_retiro);
            } else {
                $scope.fecha_entrega = $('#fecha_entrega').val();
                $scope.data_entrega_date = $scope.convertDate($scope.fecha_entrega);
            }

        };

        $scope.reafirmHours = function (type) {

            if (type === 0) {
                $scope.hora_retiro = $('#hora_retiro').val();
                $scope.data_retiro_hour = $scope.hora_retiro;
            } else {
                $scope.hora_entrega = $('#hora_entrega').val();
                $scope.data_entrega_hour = $scope.hora_entrega;
            }

        };

        $scope.convertDate = function (date_p) {

            var array_date = date_p.split('-');

            var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
            var diasSemana = ["Domingo", "Lunes","Martes","Miércoles","Jueves","Viernes","Sábado" ];

            var f = new Date(parseInt(array_date[0]), parseInt(array_date[1]) - 1, parseInt(array_date[2]));

            return diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();

        };

        $scope.restaFechas = function(f1, f2) {

            var aFecha1 = f1.split('-');
            var aFecha2 = f2.split('-');
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
            var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
            var dif = fFecha2 - fFecha1;
            return Math.floor(dif / (1000 * 60 * 60 * 24));

        };

        $scope.showDataRegister = function (login) {

            if (login === undefined) {

                $scope.registeremail = $scope.email;
                $scope.registerpassword = '';

                $('#registeremail').prop('disabled', true);

                $scope.title_modal_register = 'Registro';

                $('#modalRegister').modal('show');

            } else {

                $scope.title_modal_register = 'Acceso';

                $('#registeremail').prop('disabled', false);

                $('#modalRegister').modal('show');

            }



        };

        $scope.okRegister = function () {

            if ($scope.title_modal_register === 'Acceso') {

                var object = {
                    email: $scope.registeremail,
                    password: $scope.registerpassword
                };

                $http.post(API_URL + 'reservation/login', object ).then(function (response) {

                    if (response.data.success === false) {

                        $scope.text_failed = 'Upss! Usuario y/o Password incorrecto.';
                        $('#view-failed-login').show();

                    } else {

                        $scope.stateRegister = 1;
                        $scope.registered = true;
                        $scope.registeredClient = response.data.client;

                        $('#modalRegister').modal('hide');

                    }

                })
                .catch(function(data, status) {

                    console.error('Gists error', response.status, response.data);

                }).finally(function() {

                    //console.log("finally finished gists");

                });

            } else {

                $scope.stateRegister = 1;

                $('#modalRegister').modal('hide');

            }



        };

        $scope.cancelRegister = function () {

            $scope.stateRegister = 0;

            $('#modalRegister').modal('hide');

        };

        $scope.getSlider = function () {

            $http.get(API_URL + 'reservation/getSlider').then(function(response){

                $scope.sliderlist = response.data;

            });

        };

        $scope.save = function () {

            var data = {

                nameperson: $scope.names,
                lastnameperson: $scope.lastnames,
                identifyperson: $scope.docident,
                emailperson: $scope.email,
                numphoneperson: $scope.phone,

                idcar: $scope.carSelected.idcar,
                startdatetime: $scope.fecha_retiro + ' ' + $scope.hora_retiro,
                enddatetime: $scope.fecha_entrega + ' ' + $scope.hora_entrega,
                totalcost: $scope.total,

                idplaceretreat: $scope.dataRetiroPlace.idplace,
                idplacereturn: $scope.dataEntregaPlace.idplace,
                retiro_place: $scope.data_retiro_place,
                entrega_place: $scope.data_entrega_place,
                rest_day: $scope.rest_day,

                stateRegister: $scope.stateRegister,
                registeremail: $scope.registeremail,
                registerpassword: $scope.registerpassword,

                numtarjeta: $scope.numtarjeta,
                mmaa: $scope.mmaa,
                cvc: $scope.cvc

            };

            var list_item = [

                {
                    Nombre: 'Renta de: ',
                    Cantidad: 1,
                    PrecioU: parseFloat($scope.total)
                }

            ];

            var datos = {

                Items: list_item,
                ValorTotal: parseFloat($scope.total),
                Descripcion: 'Renta por Nazcar'

            };

            console.log(data);
            console.log(datos);

            $http.post(API_URL + 'reservation', data).then(function(response) {

                $('#modalAction').modal('hide');

                if (response.data.success === true) {


                    $http.post(API_URL+'Paypallaravel2',datos).then(function (response) {

                        if(response.data.url !== undefined){

                            location.href = response.data.url;




                        } else {

                            location.href = response.data;

                            /*$scope.message_error = 'Ha ocurrido un error al intentar Pagar via PayPal...';
                            $('#modalError').modal('show');*/

                        }

                    });



                    $scope.message_success = 'La Reserva se ha agregado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    /*$scope.reserva_1 = 1;*/

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar agregar una Reserva...';
                    $('#modalError').modal('show');

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });


        };


        $scope.saveCaja = function () {

            var data = {

                nameperson: $scope.names,
                lastnameperson: $scope.lastnames,
                identifyperson: $scope.docident,
                emailperson: $scope.email,
                numphoneperson: $scope.phone,

                idcar: $scope.carSelected.idcar,
                startdatetime: $scope.fecha_retiro + ' ' + $scope.hora_retiro,
                enddatetime: $scope.fecha_entrega + ' ' + $scope.hora_entrega,
                totalcost: $scope.total,

                idplaceretreat: $scope.dataRetiroPlace.idplace,
                idplacereturn: $scope.dataEntregaPlace.idplace,
                retiro_place: $scope.data_retiro_place,
                entrega_place: $scope.data_entrega_place,
                rest_day: $scope.rest_day,

                stateRegister: $scope.stateRegister,
                registeremail: $scope.registeremail,
                registerpassword: $scope.registerpassword,

                numtarjeta: $scope.numtarjeta,
                mmaa: $scope.mmaa,
                cvc: $scope.cvc

            };

            console.log(data);

            $http.post(API_URL + 'reservation/Caja', data).then(function(response) {

                $('#modalAction').modal('hide');

                if (response.data.success === true) {


                    $scope.message_success = 'La Reserva se ha agregado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    var accion = API_URL + 'reservation/printComprobante/' + JSON.stringify(data);

                    $('#WPrint_head').html('Comprobante de Pago');

                    $('#WPrint').modal('show');

                    $('#bodyprint').html("<object width='100%' height='600' data='" + accion + "'></object>");



                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar agregar una Reserva...';
                    $('#modalError').modal('show');

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });


        };


        $scope.sendEmail = function (data) {

            $http.post(API_URL + 'reservation', data).then(function(response) {

                $('#modalAction').modal('hide');

                if (response.data.success === true) {

                    $scope.cancel();

                    $scope.message_success = 'El Tipo de Combustible se ha agregado satisfactoriamente...';
                    $('#modalSuccess').modal('show');

                    $scope.initLoad(1);

                } else {

                    $scope.message_error = 'Ha ocurrido un error al intentar agregar un Tipo de Combustible...';
                    $('#modalError').modal('show');

                }

            }).catch(function(data, status) {

                console.error('Gists error', response.status, response.data);

            }).finally(function() {

                //console.log("finally finished gists");

            });

        };

        $scope.getSlider();
        $scope.getlistEdad();
        $scope.getPlaces();
        $scope.getCategories();
        $scope.getCar(0);
        $scope.getAditionalServices();
        $scope.getOtherServices();

    });