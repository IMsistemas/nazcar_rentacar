

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
                        <th style="width: 12%;">SUBTOTAL</th>
                        <th style="width: 12%;">IVA</th>
                        <th style="width: 12%;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in list" ng-cloak>

                        <td>{{ $index + 1 }}</td>
                        <td>{{ item.namecarbrand }}</td>
                        <td>{{ item.namecarmodel }}</td>
                        <td  class="text-right">{{ item.cantidad }}</td>
                        <td  class="text-right">{{ item.subtotal }}</td>
                        <td  class="text-right">{{ item.iva }}</td>
                        <td  class="text-right">{{ item.total }}</td>

                    </tr>
                </tbody>
                <tfoot class="bg-info">
                    <tr>

                        <th class="text-right" colspan="3">TOTALES</th>
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