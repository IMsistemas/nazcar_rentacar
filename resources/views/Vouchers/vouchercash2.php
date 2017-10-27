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

        .col-xs-3, .col-xs-6,  .col-xs-12, .col-xs-4, .col-xs-5 {
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

        .col-xs-6 {
            float: left;
            width: 50%;
        }

        .col-xs-4 {
            width: 35%;
        }

        .col-xs-5 {
            width: 65%;
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
            margin-bottom: 0px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 2px;
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


        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            height: 200px;
        }
        .footer {
            bottom: 0px;
        }

        .tablecolorback {

            background: #000000 !important;

        }

    </style>
</head>
<body>

<table class="table table-responsive table-striped table-hover table-condensed table-bordered">
    <tr>
        <td style="width: 50%;"><img src="<?= $aux_empresa[0]->logocompany ?>" alt="" style="width: 100px;"></td>
        <td style="width: 50%;" class="text-right"><h2>COMPROBANTE DE PAGO</h2></td>
    </tr>
</table>



<table class="table table-responsive table-striped table-hover table-condensed table-bordered tablecolorback">

    <tr>
        <td>
            <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
                <tr>
                    <td style="width: 35%;">

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>CLIENTE</h3>
                            <?= $params->nameperson ?> <?= $params->lastnameperson ?><br>
                            <?= $params->emailperson ?>
                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>AGENCIA DE RETIRO</h3>
                            <?= $params->retiro_place ?>
                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>AGENCIA DE ENTREGA</h3>
                            <?= $params->entrega_place ?>
                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>DÍAS DE RENTA</h3>
                            <?= $params->rest_day ?>
                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>FECHA DE RETIRO</h3>
                            <?= $params->startdatetime ?>
                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>FECHA DE DEVOLUCIÓN</h3>
                            <?= $params->enddatetime ?>
                        </div>
                    </td>

                    <td style="width: 65%;">

                        <div class="col-xs-12 text-center">

                            <img src="<?= $image_url ?>" alt="" style="width: 300px;">

                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>SERVICIOS</h3>

                            <?php

                            foreach ($params->serviceList as $item) {

                                if ($item->idservice == 0) {

                                    echo $item->service . ' ' . number_format($item->price, 2, '.', ',') . '<br>';

                                } else if ($item->type == 0) {

                                    echo $item->service . ' ' . number_format($item->price, 2, '.', ',') . '<br>';

                                }

                            }

                            ?>

                        </div>

                        <div class="col-xs-12" style="margin-top: 2%;">
                            <h3>SERVICIOS ADICIONALES</h3>
                            <?php

                            foreach ($params->serviceList as $item) {

                                if ($item->idservice != 0) {

                                    if ($item->type == 1) {

                                        echo $item->service . ' ' . number_format($item->price, 2, '.', ',') . '<br>';

                                    }

                                }

                            }

                            ?>
                        </div>

                    </td>

                </tr>
            </table>


        </td>
    </tr>

    <tr>
        <td>

            <table class="table table-responsive table-striped table-hover table-condensed table-bordered">
                <tbody>
                <tr>
                    <th style="width: 85%;" class="text-right">SUBTOTAL</th>
                    <td style="width: 15%;" class="text-right"><?= number_format($params->subtotal, 2, '.', ',') ?></td>
                </tr>

                <tr>
                    <th class="text-right">IVA (12%)</th>
                    <td class="text-right"><?= number_format($params->iva, 2, '.', ',') ?></td>
                </tr>

                <tr>
                    <th class="text-right">TOTAL</th>
                    <td class="text-right"><?= number_format($params->totalcost, 2, '.', ',') ?></td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

</table>


<div class="footer">

    <img src="<?= $aux_empresa[0]->logocompany ?>" alt="" style="width: 100px;"> <br><br>

    Condiciones de venta • Política de privacidad <br> <br> <br>
    Copyright © <?= date('Y') ?> <?= $aux_empresa[0]->namecompany ?> <br>
    Todos los derechos reservados <br> <br> <br>
    <?= $aux_empresa[0]->addresscompany ?> <br>
    Quito - Ecuador <br>
    Email: <?= $aux_empresa[0]->emailcompany ?> <br>
</div>


</body>
</html>