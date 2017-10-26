

<div class="container" style="margin-top: 10px;" ng-controller="reportController" ng-init="getTopCar()">
	
	<div class="col-xs-12">
		<h4>Listado Top 5 Vehículos mas Rentados</h4>
		<hr>
	</div>

	<div class="row">

        <div class="col-12" style="margin-top: 10px;">

            <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 5%;">NO.</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th style="width: 12%;">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in list" ng-cloak>

                        <td>{{ $index + 1 }}</td>
                        <td>{{ item.namecarbrand }}</td>
                        <td>{{ item.namecarmodel }}</td>
                        <td>{{ item.cantidad }}</td>

                    </tr>
                </tbody>
            </table>

        </div>

	</div>

</div>