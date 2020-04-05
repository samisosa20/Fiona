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
    <title>Fiona - Perfil</title>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Perfil</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Perfil</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
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
                            <div id="body_profile" class="card-body">
                                <div class="row mb-2">
                                    <label for="name_profile"
                                        class="col-sm-2 col-form-label">Nombres</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                            id="name_profile" placeholder="Alejandro">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="last_name_profile"
                                        class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                            id="last_name_profile" placeholder="Lopez Mejia">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="email_profile"
                                        class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control"
                                            id="email_profile" readonly placeholder="nombre@correo.com">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="divisa"
                                        class="col-sm-2 col-form-label">Divisa por defecto</label>
                                    <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2 mt-2 custom-radius 
                                     text-dark custom-shadow border-0" id="divisa">
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
                                <div class="dropdown-divider"></div>
                                <div class="row mb-2">
                                    <label for="photo_profile"
                                        class="col-sm-2 col-form-label">Foto de perfil</label>
                                    <div class="input-group mb-3 col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo_profile">
                                            <label class="custom-file-label" for="photo_profile">Subir foto</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="row mb-2">
                                    <label for="pass_1"
                                        class="col-sm-2 col-form-label">Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" onkeyup="val_pass_1()" class="form-control"
                                            id="pass_1" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="pass_2"
                                        class="col-sm-2 col-form-label">Repetir contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" onkeyup="val_pass_2()" class="form-control mt-2"
                                            id="pass_2" placeholder="">
                                    </div>
                                </div>
                                <button type="button" id="save_profile"
                                        class="btn waves-effect waves-light btn-rounded btn-primary float-right"><i class="fas fa-save mr-2"></i>Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
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