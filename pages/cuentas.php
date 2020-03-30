<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Fiona - Cuentas</title>
    <!-- This page css -->
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php include("../navbar.php");?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Lista de cuentas</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Cuentas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--<div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div>-->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="card_account" class="row">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="ModalAccount" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Creador de cuentas</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="nombre">Nombre</label>
									<input type="text" class="form-control custom-radius custom-shadow border-0" id="nombre">
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="descripcion">Descripción</label>
									<textarea class="form-control" id="descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="divisa">Divisa</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="divisa">
										<option value="0" selected>Selecciona una opción</option>
										<option value="COP">COP</option>
										<option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="JPY">JPY</option>
                                        <option value="GBD">GBD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="MXN">MXN</option>
                                        <option value="ILS">ILS</option>
									</select>
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="monto_ini">Monto inicial</label>
									<input type="number" value="0" step="0.01" class="form-control custom-radius custom-shadow border-0" id="monto_ini">
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="account_save">
                                        <label class="custom-control-label" for="account_save">Seleciona si es cuenta para ahorrar</label>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="save_account" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalEditAcco" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Editor de cuentas</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_nombre">Nombre</label>
									<input type="text" class="form-control custom-radius custom-shadow border-0" id="edit_nombre">
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_descripcion">Descripción</label>
									<textarea class="form-control" id="edit_descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_divisa">Divisa</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="edit_divisa">
										<option value="0" selected>Selecciona una opción</option>
										<option value="COP">COP</option>
										<option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="JPY">JPY</option>
                                        <option value="GBD">GBD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="MXN">MXN</option>
                                        <option value="ILS">ILS</option>
									</select>
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_monto_ini">Monto inicial</label>
									<input type="number" step="0.01" class="form-control custom-radius custom-shadow border-0" id="edit_monto_ini">
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="edit_account_save">
                                        <label class="custom-control-label" for="edit_account_save">Seleciona si es cuenta para ahorrar</label>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="btn_edit_account" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalDeletAcco" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Eliminar cuenta</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div id="text_delete_acco" class="modal-body">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="btn_delete_account" class="btn btn-danger">Eliminar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include("../footer.php");?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../java/functions.php"></script>
    <script src="../dist/js/custom.min.js"></script>
</body>

</html>