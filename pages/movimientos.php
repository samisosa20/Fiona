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
	<title>Fiona - Movimientos</title>
	<!-- This page css -->
	<!-- Custom CSS -->
	<link href="../dist/css/style.min.css" rel="stylesheet">
	<link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
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
		<?php include("../navbar.php"); ?>
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
						<h4 id="title_movi" class="page-title text-truncate text-dark font-weight-medium mb-1"></h4>
						<div class="d-flex align-items-center">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb m-0 p-0">
									<li class="breadcrumb-item"><a href="dashboard.php" class="text-muted">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="cuentas.php" class="text-muted">Cuentas</a></li>
									<li class="breadcrumb-item text-muted active" aria-current="page">Movimientos</li>
								</ol>
							</nav>
						</div>
					</div>
					<div class="col-5 align-self-center">
						<div class="customize-input float-right">
							<select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
								<option selected>Dic 20</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="page-breadcrumb mb-3">
				<button type="button"
						class="btn waves-effect waves-light btn-rounded float-right btn-success mb-2"
						data-target="#ModalTransDash" id="add_trans_btn" data-toggle="modal">
						<i class="fas fa-exchange-alt mr-2"></i>Transferencia
				</button>
				<button type="button"
						class="btn waves-effect waves-light btn-rounded btn-primary float-right mb-2 mr-1"
						data-target="#ModalAdd" id="add_move_btn" data-toggle="modal">
						<i class="fas fa-plus mr-2"></i>Movimeinto
				</button>
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
								<div id="div_descri_acc" class="float-left mb-2 col-sm-6">
									<p id="descri_acc"></p>
								</div>
								<div class="float-left mb-2 col-sm-6">
									<p id="balance_acc"></p>
								</div>
								<div class="table-responsive">
									<table id="table_move_acc" class="table table-striped table-bordered no-wrap"
										style="width:100%">
										<thead>
											<tr>
												<th>Acciones</th>
												<th>Categoria</th>
												<th>Valor</th>
												<th>Moneda</th>
												<th>Fecha</th>
												<th>Dia Semana</th>
												<th>Dia</th>
												<th>Mes</th>
												<th>Año</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
										<tfoot>
											<tr>
												<th>Acciones</th>
												<th>Categoria</th>
												<th>Valor</th>
												<th>Moneda</th>
												<th>Fecha</th>
												<th>Dia Semana</th>
												<th>Dia</th>
												<th>Mes</th>
												<th>Año</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Ingreso de movimiento</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<div class="col-md-2">
									<small class="text-dark">Monto</small>
								</div>
								<div class="input-group-prepend">
									<button class="btn btn-outline-success" id="monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('valor', 'monto_signal')" class="form-control" id="valor">
								</div>
								<div class="col-md-3">
									<select id="divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="categoria">Seleciona una categoria</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="categoria">
									</select>
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
									<label class="mr-sm-2" for="fecha">Fecha</label>
									<input type="datetime-local" class="form-control custom-radius custom-shadow border-0" id="fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="save_trans" class="btn btn-primary">Guardar</button>
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
									<button class="btn btn-outline-success" id="trans_monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('trans_valor', '')" class="form-control" id="trans_valor">
								</div>
								<div class="col-md-3">
									<select id="trans_divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>COP</option>
                                        <option >USD</option>
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="trans_cuenta_ini">Seleciona una cuenta de salida</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="trans_cuenta_ini">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="trans_cuenta_fin">Seleciona una cuenta de entrada</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="trans_cuenta_fin">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="trans_descripcion">Descripción</label>
									<textarea class="form-control" id="trans_descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="trans_fecha">Fecha</label>
									<input type="datetime-local" 
									class="form-control custom-radius custom-shadow border-0" id="trans_fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="trans_trans" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Editor de movimiento</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<div class="col-md-2">
									<small class="text-dark">Monto</small>
								</div>
								<div class="input-group-prepend">
									<button class="btn btn-outline-success" id="edit_monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('edit_valor', 'edit_monto_signal')" class="form-control" id="edit_valor">
								</div>
								<div class="col-md-3">
									<select id="edit_divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>COP</option>
                                        <option >USD</option>
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="edit_cuenta">Seleciona una cuenta</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="edit_cuenta">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4"> 
									<label class="mr-sm-2" for="edit_categoria">Seleciona una categoria</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="edit_categoria">
									</select>
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
									<label class="mr-sm-2" for="edit_fecha">Fecha</label>
									<input type="datetime-local" 
									class="form-control custom-radius custom-shadow border-0" id="edit_fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="edit_trans" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<div id="ModalTransEdit" class="modal fade" tabindex="-1" role="dialog"
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
									<button class="btn btn-outline-success" id="Edit_trans_monto_signal" value="+" type="button">+</button>
								</div>
								<div class="custom-file">
									<input type="number" step="0.02" min="0" onchange="signo('Edit_trans_valor', '')" class="form-control" id="Edit_trans_valor">
								</div>
								<div class="col-md-3">
									<select id="Edit_trans_divisa"
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>COP</option>
                                        <option >USD</option>
                                    </select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="Edit_trans_cuenta_ini">Seleciona una cuenta de salida</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="Edit_trans_cuenta_ini">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="Edit_trans_cuenta_fin">Seleciona una cuenta de entrada</label>
									<select class="custom-select mr-sm-2 custom-radius custom-shadow border-0"
									id="Edit_trans_cuenta_fin">
									</select>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="Edit_trans_descripcion">Descripción</label>
									<textarea class="form-control" id="Edit_trans_descripcion" rows="3" placeholder="Escribe aqui una descripción..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 mt-2">
								<div class="form-group mb-4">
									<label class="mr-sm-2" for="Edit_trans_fecha">Fecha</label>
									<input type="datetime-local" 
									class="form-control custom-radius custom-shadow border-0" id="Edit_trans_fecha">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cerrar</button>
							<button type="button" id="Edit_trans_trans" class="btn btn-primary">Guardar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<div id="ModalDelete" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Eliminar movimiento</h4>
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">×</button>
						</div>
						<div id="text_delete" class="modal-body">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light"
								data-dismiss="modal">Cancelar</button>
							<button type="button" id="delete_trans" class="btn btn-danger">Eliminar</button>
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
	<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
	<script src="../java/functions.php"></script>
</body>

</html>