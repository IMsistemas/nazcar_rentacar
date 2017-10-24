<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title></title>

        <style>

            body{
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
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

            .col-xs-6 {
                float: left !important;
                width: 50% !important;
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
                border: 1px solid #ddd !important;
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




            .table_info_consumo {
                border-collapse: collapse !important;
                width: 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }

            .table_info_consumo td {
                border: 1px solid #ddd !important;
            }
            .table_info_consumo > thead > tr > th,
            .table_info_consumo > tbody > tr > th,
            .table_info_consumo > tfoot > tr > th,
            .table_info_consumo > thead > tr > td,
            .table_info_consumo > tbody > tr > td,
            .table_info_consumo > tfoot > tr > td {
                padding: 8px;
                line-height: 1.42857143;
                vertical-align: top;
            }
            .table_info_consumo > thead > tr > th {
                vertical-align: bottom;
                border-bottom: 2px solid #ddd;
            }

            .dataclient{
                font-weight: bold;
            }

        </style>

    </head>
    <body>

        <div class="container" style="margin-top: 2%;">
            <h4>Gracias por su Reserva y por elegirnos</h4>
        </div>

        <div class="col-xs-12">
            <span style="font-weight: bold;">Nombre(s): </span>
        </div>
        <div class="col-xs-12">
            <span style="font-weight: bold;">Apellidos: </span>
        </div>

        <div class="col-xs-12">
            <span style="font-weight: bold;">Email: </span>
        </div>



    </body>
</html>