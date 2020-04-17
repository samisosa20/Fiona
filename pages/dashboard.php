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
    <title>Fiona - Dashboard</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link rel="manifest" href="../manifest.json">
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
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php include("../navbar.php");?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-sm-12 col-md-10 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                            <?php echo "Bienvenid@ $name $last_name"; ?>
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="customize-input float-right">
                            <select id="select_divisa" onchange= "load_card(this.value)"
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb mb-3">
                <button type="button"
                        class="btn waves-effect waves-light btn-rounded float-right btn-success mb-2"
                        data-target="#ModalTransDash" id="add_trans_btn" data-toggle="modal">
                        <i class="fas fa-exchange-alt mr-2"></i>Transferencia
                </button>
                <button type="button"
                        class="btn waves-effect waves-light btn-rounded float-right btn-primary mr-1 mb-2"
                        data-target="#ModalAddDash" id="add_move_btn" data-toggle="modal">
                        <i class="fas fa-plus mr-2"></i>Movimiento
                </button>
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div onclick="showactivity(1)" class="card border-right col-sm-12">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div id="lbl_ingreso" class="d-inline-flex align-items-center">
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ingresos</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div onclick="showactivity(2)" class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div id="lbl_egreso" class="d-inline-flex align-items-center">
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Egresos</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div id="lbl_ahorros" class="d-inline-flex align-items-center">
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ahorros</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div id="lbl_utilidad" class="d-inline-flex align-items-center">
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Utilidad</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Sales Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Ingresos
                                    <i class="fas fa-info-circle ml-1" data-container="body" style="color: #01caf1;"
                                        title="Grafico ingresos" data-toggle="popover" data-placement="top"
                                        data-content="Mira como se destribuye tus ingresos, toca cualquier color
                                        para saber que categoria es con su porcentaje de participacion. Ej: 
                                        La categoria Salario tiene un 90%, lo que significa, que el 90% de mis
                                        ingresos corresponde por Salario">
                                    </i>
                                </h4>
                                <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Egresos
                                    <i class="fas fa-info-circle ml-1" data-container="body" style="color: #01caf1;"
                                        title="Grafico egresos" data-toggle="popover" data-placement="top"
                                        data-content="Mira como se destribuye tus egresos, toca cualquier color
                                        para saber que categoria es con su porcentaje de participacion. Ej: 
                                        La categoria Arriendo tiene un 50%, lo que significa, que la mitad de mis
                                        ingresos es destinado a pagar el arriendo.">
                                    </i>
                                </h4>
                                <div id="campaign-v3" class="mt-2" style="height:283px; width:100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Ahorros
                                    <i class="fas fa-info-circle ml-1" data-container="body" style="color: #01caf1;"
                                        title="Grafico ahorros" data-toggle="popover" data-placement="top"
                                        data-content="Mira como se destribuye tus ahorros, toca cualquier color
                                        para saber que cuenta es con su porcentaje de participacion. Ej: 
                                        La cuenta CDT tiene un 50%, lo que significa, que la mitad de mis
                                        ahorros se encuentran en el CDT.">
                                    </i>
                                </h4>
                                <div id="campaign-v4" class="mt-2" style="height:283px; width:100%;"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- *************************************************************** -->
                <!-- End Sales Charts Section -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-md-6 col-lg-8">
                        <div class="card">
                            <div id="movimientos-diarios" class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Actividades Recientes</h4>
                                <div id="activity_current" class="mt-4 activity">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="ModalAddDash" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Ingreso de transacción</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<div class="col-md-2">
									<small class="text-dark">Monto</small>
								</div>
								<div class="input-group-prepend">
									<button class="btn btn-outline-success" id="dash_monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('dash_valor', 'dash_monto_signal')" class="form-control" id="dash_valor">
								</div>
								<div class="col-md-3">
									<select id="dash_divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>COP</option>
                                        <option >USD</option>
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_cuenta">Seleciona una cuenta</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="dash_cuenta">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4"> 
									<label class="mr-sm-2" for="dash_categoria">Seleciona una categoria</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="dash_categoria">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_descripcion">Descripción</label>
									<textarea class="form-control" id="dash_descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_fecha">Fecha</label>
									<input type="datetime-local" 
									class="form-control custom-radius custom-shadow border-0" id="dash_fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="dash_trans" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
            <div id="ModalTransDash" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Transferencias</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<div class="col-md-2">
									<small class="text-dark">Monto</small>
								</div>
								<div class="input-group-prepend">
									<button class="btn btn-outline-success" id="dash_trans_monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('dash_trans_valor', 'dash_trans_monto_signal')" class="form-control" id="dash_trans_valor">
								</div>
								<div class="col-md-3">
									<select id="dash_trans_divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>COP</option>
                                        <option >USD</option>
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_trans_cuenta_ini">Seleciona una cuenta de salida</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="dash_trans_cuenta_ini">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_trans_cuenta_fin">Seleciona una cuenta de entrada</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="dash_trans_cuenta_fin">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_trans_descripcion">Descripción</label>
									<textarea class="form-control" id="dash_trans_descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="dash_trans_fecha">Fecha</label>
									<input type="datetime-local" 
									class="form-control custom-radius custom-shadow border-0" id="dash_trans_fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="dash_trans_trans" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
            <div id="ModalWelcome" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Bienvenido</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo "Bienvenid@ <strong>$name $last_name</strong>"; ?> a la App <strong>Fiona</strong>,
                            tu asistente financiero. Antes de comenzar te daremos una breve explicación de como utilizarla:
                            </p>
                            <li>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">
                                <i class="fas fa-plus mr-2"></i>Movimiento</button> Este boton es utilizado
                                para ingresar salidas o entradas de dinero.<br>
                                <strong>Ej:</strong> la cantidad de dinero que recibes por tu salario.
                            </li>
                            <li><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">
                            <i class="fas fa-exchange-alt mr-2"></i>Transferencia</button> Este boton es ultilizado cuando requieres
                            pasar una suma de dinero de una cuenta a otra.<br>
                            <strong>Ej:</strong> Pasar 50.000 COP de mi cuenta de ahorros a mi cuenta CDT.</li>
                            <li><i class="fas fa-info-circle" data-container="body" style="color: #01caf1;"></i>
                              Cuando encuentres este icono podrás darle clic para mas información.
                            </li>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-light"
                                data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary" 
                            data-toggle="modal" data-target="#ModalCategoInfo" data-dismiss="modal">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ModalCategoInfo" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Configuración Inicial I</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Categorías:</strong></p>
                            <p>Deberas de crear las categorías para identificar los gastos o ingresos mas frecuentes.</p>
                            <p>Para eso darás clic en categorías en la barra de navegación ubicada al lado izquierdo
                            de la pagina o <i class="fas fa-bars"></i> ubicado en la parte superior lado izquierdo.</p>
                            <p><strong>Ej: </strong> Si posees gastos que provenga de un vehiculo puedes crear una 
                            categoria llamada vehiculo.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-light"
                                data-dismiss="modal">Cerrar</button>
                            <a href="categorias">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Siguiente</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ModalActivity" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Actividades por cuenta</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div id="bodyActivity" class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalActivityLvl" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Movimientos por mes</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div id="bodyActivityLvl" class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                id="btn_back_lvl">Atras</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalActivityMonth" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Movimientos diarios</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div id="bodyActivityMonth" class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                id="btn_back_moth">Atras</button>
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
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="../java/dashboard.php"></script>
</body>

</html>