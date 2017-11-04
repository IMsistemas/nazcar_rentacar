

app.controller('ganttController', function($scope, $http, API_URL, Upload) {


    var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'), 'day');

    g.setDayColWidth(36);


    g.AddTaskItem(new JSGantt.TaskItem(1, 'Task Variables', '2016-03-06','2016-03-11', 'gtaskred','', 0, 'Brian',60,0, 12, 1, 121,'','', g));

    g.Draw();

    $scope.initLoad = function(){


        $http.get(API_URL + 'gantt/getRent').then(function(response) {

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