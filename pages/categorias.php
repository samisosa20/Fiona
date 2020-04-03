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
    <title>Fiona - Categorías</title>
    <!-- This page css -->
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <style>
        .popover {
            white-space: pre-line;    
        }
    </style>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">LISTA DE CATEGORIAS</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Categorías</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--<div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Dic 20</option>
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
                                <div id="card_catego" class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="ModalCategora" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Creador de categorías</h4>
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
									<label class="mr-sm-2" for="grupo">Grupo
                                        <i class="fas fa-info-circle ml-1" data-container="body" style="color: #01caf1;"
                                            title="Grupo" data-toggle="popover" data-placement="top"
                                            data-content="Gastos fijos: son todo que podemos estimar.
                                            Gastos personales: son todo aquellos que no se puede estimar.
                                            Ej: Electricidad, alquiler, celular, peluquería, parqueadero, gasolina son gastos fijos">
                                        </i>
                                    </label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="grupo">
										<option value="0" selected>Selecciona una opción</option>
										<option value="1">Gastos fijos</option>
										<option value="2">Gastos personales</option>
                                        <option value="3">Ahorros</option>
                                        <option value="4">Ingresos</option>
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="categoria">Incluirlo dentro de una categoría
                                        <i class="fas fa-info-circle ml-1" data-container="body" style="color: #01caf1;"
                                            title="Sub-categoria" data-toggle="popover" data-placement="top"
                                            data-content="Incluir una categoría dentro de otra ayuda a entender el comportamiento de los gastos.
                                            Ej: categoría principal es vehiculo y dentro de esa categoría existe gasolina, parqueadero, seguro, mantenimiento, etc.
                                            Para la categoría gasolina incluyo dentro de la categoría vehiculo.">
                                        </i>
                                    </label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="categoria">
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="save_cate" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
            <div id="ModalDeletCatego" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Eliminar categoría</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div id="text_delete_catego" class="modal-body">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="btn_delete_categoria" class="btn btn-danger">Eliminar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="ModalEditCatego" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Editor de categorías</h4>
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
									<label class="mr-sm-2" for="edit_grupo">Grupo</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="edit_grupo">
										<option value="0" selected>Selecciona una opción</option>
										<option value="1">Gastos fijos</option>
										<option value="2">Gastos personales</option>
                                        <option value="3">Ahorros</option>
                                        <option value="4">Ingresos</option>
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_categoria">Incluirlo en una categoría</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="edit_categoria">
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="btn_edit_cate" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
            <div id="ModalCategoAddInfo" class="modal fade" tabindex="-1" role="dialog"
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
                            <p>para crear una categoría dale clic en el siguiente recuadro:</p>
                            <div class='col-md-12' id='add_categoria' data-target='#ModalCategora' data-toggle='modal' data-dismiss="modal">
                                <a class='card'>
                                    <div class='card-body'>
                                        <div class='row'>
                                            <div class='col-md-9 col-lg-9 col-xl-9'><h3 class='card-title text-muted'><i class='fas fa-plus mr-2'></i>Nueva categoría</h3></div>
                                            <div class='col-md-12 col-lg-12 col-xl-12' style='position: absolute;'><h4 class='card-title text-muted fa-2x float-right'><i class='icon-arrow-right'></i></h4></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" 
                                class="btn waves-effect waves-light btn-rounded btn-primary"
                                data-dismiss="modal">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ModalCongratuCatego" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Felicitaciones!</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Bien hecho </strong>!</p>
                            <p>Haz creado tu primera categoría. Crea todas las categorías necesarias e incluso
                            agrega subcategorías.</p>
                            <p><strong>Ej:</strong> Categoría principal <strong>Vehiculo</strong> y dentro de esta 
                            <strong>gasolina, parqueadero, repuestos, impuestos, etc</strong>.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-light"
                                data-dismiss="modal">Cerrar</button>
                            <button type="button" 
                                class="btn waves-effect waves-light btn-rounded btn-primary"
                                data-toggle="modal" data-target="#ModalAccountInfo" data-dismiss="modal">Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ModalAccountInfo" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Configuración Inicial II</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Cuentas:</strong></p>
                            <p>El siguiente paso será crear las cuentas con las cuales podras identificar donde esta depositado
                            el dinero.</p>
                            <p><strong>Ej: </strong>Cuenta de ahorros - Natillera - CDT - Efectivo - Tarjeta de credito</p>
                            <p>Para eso darás clic en cuentas en la barra de navegación ubicada al lado izquierdo de la 
                            pagina o <i class="fas fa-bars"></i> ubicado en la parte superior lado izquierdo.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-light"
                                data-dismiss="modal">Cerrar</button>
                            <a href="cuentas.php">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">Siguiente</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="../java/functions.php"></script>
</body>

</html>