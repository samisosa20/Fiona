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
    <title>Fiona - New Presu</title>
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
                    <div class="col-12 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">CREADOR DE PRESUPUESTO</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="presupuesto" class="text-muted">Presupuesto</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Creador de presupuesto</li>
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
                                <div id="form_presu" class="row">
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
                                            <label class="mr-sm-2" for="ano">Año a presupuestar</label>
                                            <select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
                                            id="ano">
                                                <option value="0" selected>Selecciona una opción</option>
                                                <?php 
                                                $year_now = date(Y);
                                                $year_last = $year_now - 1;
                                                $year_future = $year_now + 1;
                                                echo "
                                                <option value='$year_last'>$year_last</option>
                                                <option value='$year_now'>$year_now</option>
                                                <option value='$year_future'>$year_future</option>"; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" id="next_step_1" class="btn btn-primary">Siguiente</button>
                                    <a href="presupuesto"><button type="button" id="finaly_step" 
                                        style="display: none;" class="btn btn-success ml-2">Finalizar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="ModalSelectCat" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Presupuesto Parte I</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="categoria">Categoria</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="categoria">
									</select>
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="modo_presu">Modo de presupuesto</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="modo_presu">
										<option value="0" selected>Selecciona una opción</option>
										<option value="1">Mensual</option>
										<option value="2">Bimensual</option>
                                        <option value="3">Trimestral</option>
                                        <option value="4">Cuatrisemestral</option>
                                        <option value="6">Semestral</option>
                                        <option value="12">Anual</option>
									</select>
								</div>
                            </div>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="next_step_2" class="btn btn-primary">Siguiente</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalInsertVal" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Presupuesto Parte II</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="mes_ini">Mes de inicio</label>
									<select class="custom-select mr-sm-2 custom-radius 
                                    text-dark custom-shadow border-0" id="mes_ini">
                                        <option value="0" selected>Selecciona una opción</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
									</select>
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="valor">Valor del monto</label>
                                    <input type="number" step="0.01" 
                                    class="form-control custom-radius custom-shadow border-0" id="valor">
								</div>
                            </div>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" id="back_step_1">Atras</button>
							<button type="button" id="btn_save_presu_type1" class="btn btn-primary">Finalizar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalInsertValMensu" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Presupuesto Parte II</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="mes_mensual">Mes de inicio</label>
									<select class="custom-select mr-sm-2 custom-radius 
                                    text-dark custom-shadow border-0" disabled id="mes_mensual">
										<option selected value="1">Enero</option>
										<option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
									</select>
								</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="valor_mensual">Valor del monto</label>
                                    <input type="number" step="0.01" 
                                    class="form-control custom-radius custom-shadow border-0" id="valor_mensual">
								</div>
                            </div>
                            <div id="div_replicar" class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" onchange="name_btn(this.checked)" class="custom-control-input" id="replicar_val">
                                        <label class="custom-control-label" for="replicar_val">Replicar valores para todos los meses</label>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" id="back_step_2">Atras</button>
							<button type="button" id="btn_save_presu_type2" class="btn btn-primary">Siguiente</button>
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