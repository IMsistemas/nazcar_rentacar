

<div class="container" style="margin-top: 10px;" ng-controller="companyController" ng-init="initLoad(1)">
	
	<div class="col-xs-12">
		<h4>Información de Empresa - Paypal</h4>
		<hr>
	</div>


    <div class="container">

        <div class="card w-100">
            <div class="card-header">
                Empresa
            </div>
            <div class="card-body">


                <div class="col-sm-6 col-12">

                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon">Nombre Empresa: </span>
                            <input type="text" class="form-control" id="namecompany" name="namecompany" ng-model="namecompany" required />
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">RUC: </span>
                            <input type="text" class="form-control" id="ruccompany" name="ruccompany" ng-model="ruccompany" required />
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Contribuyente ID: </span>
                            <input type="text" class="form-control" id="contribcompany" name="contribcompany" ng-model="contribcompany" required />
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <div class="input-group">
                            <span class="input-group-addon">Email: </span>
                            <input type="text" class="form-control" id="emailcompany" name="emailcompany" ng-model="emailcompany" required />
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 5px;">
                        <textarea class="form-control" name="addresscompany" id="addresscompany" ng-model="addresscompany" cols="30" rows="3" placeholder="Dirección"></textarea>
                    </div>

                </div>
                <div class="col-sm-6 col-12">

                </div>

                <div class="col-12 text-center" style="margin-top: 5px;">

                    <button type="button" class="btn btn-secondary">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="saveCompany()">
                        Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
        </div>

        <div class="card w-100" style="margin-top: 15px;">
            <div class="card-header">
                Paypal
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Modo: </label>
                        <div class="col-sm-11">
                            <label class="custom-control custom-radio">
                                <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Sandox</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Live</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-addon">Key (Sandox): </span>
                        <input type="text" class="form-control" id="keysandox" name="keysandox" ng-model="keysandox" required />
                    </div>
                </div>

                <div class="col-12" style="margin-top: 5px;">
                    <div class="input-group">
                        <span class="input-group-addon">Key (Live): </span>
                        <input type="text" class="form-control" id="keylive" name="keylive" ng-model="keylive" required />
                    </div>
                </div>

                <div class="col-12 text-center" style="margin-top: 5px;">

                    <button type="button" class="btn btn-secondary">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="">
                        Guardar <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            {{message_success}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title">Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            {{message_error}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSetState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            Está seguro que desea cambiar el estado de: <strong>{{name_fuel}}</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-danger" ng-click="saveSetState()">
                        Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>