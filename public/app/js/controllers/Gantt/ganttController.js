

app.controller('ganttController', function($scope, $http, API_URL, Upload) {


    var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'), 'day');

    g.setDayColWidth(36);
    g.setQuarterColWidth(36);


    //g.AddTaskItem(new JSGantt.TaskItem(1, 'Task Variables', '2016-03-06','2016-03-11', 'gtaskred','', 0, 'Brian',60,0, 12, 1, 121,'','', g));



    $scope.initLoad = function(){


        $http.get(API_URL + 'gantt/getRent').then(function(response) {

            $scope.list = response.data.data;

            var longitud = response.data.length;

            for (var i = 0; i < longitud; i++) {

                var date_ini = response.data[i].startdatetime;
                var date_end = response.data[i].enddatetime;
                var marca = response.data[i].namecarmodel;
                var idrent = response.data[i].idrent;
                var client = response.data[i].nameperson + ' ' + response.data[i].lastnameperson;

                var o = new JSGantt.TaskItem(idrent, marca, date_ini, date_end, 'gtaskred','', 0, client, 60, 0, 12, 1, 121,'','', g);

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