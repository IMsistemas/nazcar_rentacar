

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
                        <th style="width: 15%;">CANT. RENTAS</th>
                        <th style="width: 12%;">SUBTOTAL</th>
                        <th style="width: 12%;">IVA</th>
                        <th style="width: 12%;">TOTAL</th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in list0" ng-cloak>

                        <td>{{ item.mes }}</td>
                        <td class="text-right">{{ item.cantidad }}</td>
                        <td class="text-right">{{ item.subtotal }}</td>
                        <td class="text-right">{{ item.iva }}</td>
                        <td class="text-right">{{ item.total }}</td>

                    </tr>
                </tbody>
                <tfoot class="bg-info">
                    <tr>

                        <th class="text-right">TOTALES</th>
                        <th class="text-right">{{ cantidad_end }}</th>
                        <th class="text-right">{{ subtotal_end }}</th>
                        <th class="text-right">{{ iva_end }}</th>
                        <th class="text-right bg-success">{{ total_end }}</th>

                    </tr>
                </tfoot>
            </table>

        </div>

	</div>

</div>