

app.controller('ganttController', function($scope, $http, API_URL, Upload) {


    var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'), 'day');

    g.setDayColWidth(36);
    g.setQuarterColWidth(36);


    //g.AddTaskItem(new JSGantt.TaskItem(1, 'Task Variables', '2016-03-06','2016-03-11', 'gtaskred','', 0, 'Brian',60,0, 12, 1, 121,'','', g));

    g.addLang('es', {'format':'Formato','hour':'Hora','day':'Dia','week':'Semana','month':'Mes','quarter':'Trimestre','hours':'Horas','days':'Dias',
        'weeks':'Semanas','months':'Meses','quarters':'Trimestres','hr':'Hr','dy':'Day','wk':'Wk','mth':'Mth','qtr':'Qtr','hrs':'Hrs',
        'dys':'Dias','wks':'Wks','mths':'Mths','qtrs':'Qtrs','resource':'Cliente','duration':'Duracion','comp':'% Comp.',
        'completion':'Completado','startdate':'Fecha Inicio','enddate':'Fecha Fin','moreinfo':'Mas Informacion','notes':'Notas',
        'january':'Enero','february':'Febrero','march':'Marzo','april':'Abril','maylong':'Mayo','june':'Junio','july':'Julio',
        'august':'Agosto','september':'Septiembre','october':'Octubre','november':'Noviembre','december':'Diciembre','jan':'Ene',
        'feb':'Feb','mar':'Mar','apr':'Abr','may':'May','jun':'Jun','jul':'Jul','aug':'Ago','sep':'Sep','oct':'Oct','nov':'Nov',
        'dec':'Dic','sunday':'Domingo','monday':'Lunes','tuesday':'Martes','wednesday':'Miercoles','thursday':'Jueves',
        'friday':'Viernes','saturday':'Sabado','sun':'Dom','mon':'Lun','tue':'Mar','wed':'Mierc','thu':'Juev','fri':'Viern','sat':'Sab'});

    g.setLang('es');

    $scope.initLoad = function(){


        $http.get(API_URL + 'gantt/getRent').then(function(response) {

            $scope.list = response.data.data;

            var longitud = response.data.length;

            for (var i = 0; i < longitud; i++) {

                var date_ini = response.data[i].startdatetime;
                var date_end = response.data[i].enddatetime;
                var marca = response.data[i].namecarmodel + '(' + response.data[i].licenseplate + ')';
                var idrent = response.data[i].idrent;
                var client = response.data[i].nameperson + ' ' + response.data[i].lastnameperson;

                var o = new JSGantt.TaskItem(idrent, marca, date_ini, date_end, 'gtaskred','', 0, client, 0, 0, 12, 1, 121,'','', g);

                g.AddTaskItem(o);

            }

            g.Draw();

        })
        .catch(function(data, status) {
            console.error('Gists error', response.status, response.data);
        })
        .finally(function() {
            //console.log("finally finished gists");
        });

    };

});