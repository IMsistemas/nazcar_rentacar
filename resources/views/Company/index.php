

<div class="container" style="margin-top: 10px;" ng-controller="companyController" ng-init="initLoad()">
	
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


                <div class="row">
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

                        <img ngf-src="file || url_foto" alt="" class="img-thumbnail img-fluid">

                        <input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file"
                               accept="image/*" ngf-max-size="2MB"  ngf-pattern="image/*">

                        <span class="help-block error" ng-show="formCar.file.$invalid && formCar.file.$touched">
                            <small id="emailHelp" class="form-text text-danger text-right">La imagen es requerida</small>
                        </span>

                    </div>
                </div>

                <div class="col-12 text-center" style="margin-top: 5px;">

                    <button type="button" class="btn btn-secondary" ng-click="cancelCompany()">
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
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Modo: </label>
                        <div class="col-sm-10">
                            <label class="custom-control custom-radio">
                                <input id="radio1" name="radio" type="radio" ng-model="mode" value="0" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Sandox</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input id="radio2" name="radio" type="radio" ng-model="mode" value="1" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Live</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-addon">Cliente ID (Sandox): </span>
                        <input type="text" class="form-control" id="client_id_sandox" name="client_id_sandox" ng-model="client_id_sandox" required />
                    </div>
                </div>

                <div class="col-12" style="margin-top: 5px;">
                    <div class="input-group">
                        <span class="input-group-addon">Secret ID (Sandox): </span>
                        <input type="text" class="form-control" id="secret_id_sandox" name="secret_id_sandox" ng-model="secret_id_sandox" required />
                    </div>
                </div>

                <hr>

                <div class="col-12" style="margin-top: 5px;">
                    <div class="input-group">
                        <span class="input-group-addon">Cliente ID (Live): </span>
                        <input type="text" class="form-control" id="client_id_live" name="client_id_live" ng-model="client_id_live" required />
                    </div>
                </div>

                <div class="col-12" style="margin-top: 5px;">
                    <div class="input-group">
                        <span class="input-group-addon">Secret ID (Live): </span>
                        <input type="text" class="form-control" id="secret_id_live" name="secret_id_live" ng-model="secret_id_live" required />
                    </div>
                </div>

                <div class="col-12 text-center" style="margin-top: 5px;">

                    <button type="button" class="btn btn-secondary" ng-click="cancelPaypal()">
                        Cancelar <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="savePaypal()">
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



</div>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>