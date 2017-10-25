<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        body{
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            position: absolute;
        }

        .col-xs-3, .col-xs-6,  .col-xs-12 {
            position: relative;
            min-height: 1px;
            padding-right: 5px;
            padding-left: 5px;
        }

        /*.col-xs-3, .col-xs-6, .col-xs-12 {
            float: left;
        }*/

        .col-xs-12 {
            width: 100%;
        }

        .col-xs-6-l {
            float: left;
            width: 50%;
        }

        .col-xs-6-r {
            float: right;
            width: 50%;
        }

        .col-xs-3 {
            float: left;
            width: 25%;
        }

        .form-control {
            /*display: block;*/
            width: 100%;
            height: 20px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

            text-align: right;

        }

        .table {
            border-collapse: collapse !important;
        }
        .table td,
        .table th {
            background-color: #fff !important;
        }
        .table-bordered th,
        .table-bordered td {
            border: 0px solid #ddd !important;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .text-right
        {
            text-align: right !important;
        }

        .text-center
        {
            text-align: center !important;
        }

        .text-left
        {
            text-align: left !important;
        }
        .bg-primary{
            background:#2F70A8 !important;
        }
        .bg-success{
            background:#DFF0D8 !important;
        }
        .bg-warning{
            background:#FCF8E3 !important;
        }
    </style>
</head>
<body>

<div class="col-xs-12">
    <div class="col-xs-6-l" style="font-size: 14px;">
        <strong></strong>
    </div>

    <div class="col-xs-6-r text-center">
        <?= $today ?>
    </div>
</div>

<br>

<div class="col-xs-12 text-center" style="margin-top: 20px;">
    <h3><strong>COMPROBANTE DE PAGO</strong></h3>
</div>


<div class="col-xs-6-l">

    <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center" colspan="2">DATOS CLIENTE</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th style="width: 35%;">Nombre (s)</th>
                <td style="width: 65%;"><?= $params->nameperson ?></td>
            </tr>
            <tr>
                <th>Apellidos</th>
                <td><?= $params->lastnameperson ?></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td><?= $params->emailperson ?></td>
            </tr>
            <tr>
                <th>Agencia Retiro</th>
                <td><?= $params->retiro_place ?></td>
            </tr>
            <tr>
                <th>Agencia Entrega</th>
                <td><?= $params->entrega_place ?></td>
            </tr>
            <tr>
                <th>Fecha Retiro</th>
                <td><?= $params->startdatetime ?></td>
            </tr>
            <tr>
                <th>Fecha Devolución</th>
                <td><?= $params->enddatetime ?></td>
            </tr>
            <tr>
                <th>Renta por</th>
                <td><?= $params->rest_day ?> días</td>
            </tr>

        </tbody>
    </table>

</div>


<div class="col-xs-6-r" style="float: right !important;">

    <table class="table table-responsive table-striped table-hover table-condensed table-bordered" style="float: right !important;">
        <thead>
            <tr>
                <th class="text-center" colspan="2">DATOS SERVICIOS</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($params->serviceList as $item):?>
                <tr>

                    <th><?= $item->service ?></th>
                    <td class="text-right"><?= number_format($item->price, 2, '.', ',') ?></td>

                </tr>
            <?php  endforeach;?>

            <tr>

                <th>
                    <hr>SUBTOTAL
                </th>
                <td class="text-right">
                    <hr>
                    <?= number_format($params->subtotal, 2, '.', ',') ?>
                </td>

            </tr>

            <tr>

                <th>
                    IVA (12%)
                </th>
                <td class="text-right">
                    <?= number_format($params->iva, 2, '.', ',') ?>
                </td>

            </tr>

            <tr>

                <th>
                    TOTAL
                </th>
                <td class="text-right">
                    <?= number_format($params->totalcost, 2, '.', ',') ?>
                </td>

            </tr>

        </tbody>

    </table>




</div>



</body>
</html>