

<div class="container" style="margin-top: 10px;" ng-controller="reportController" ng-init="getCountRentxMonth()">
	
	<div class="col-xs-12">
		<h4>Listado Cantidad Rentas por Mes</h4>
		<hr>
	</div>

	<div class="row">

        <div class="col-12" style="margin-top: 10px;">

            <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th>MES</th>
                        <th style="width: 12%;">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in list0" ng-cloak>

                        <td>{{ item.mes }}</td>
                        <td>{{ item.cantidad }}</td>

                    </tr>
                </tbody>
            </table>

        </div>

	</div>

</div>