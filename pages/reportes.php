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
    <title>Fiona - Reportes</title>
    <!-- This page css -->
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">REPORTES FINANCIEROS</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="dashboard" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Reportes</li>
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
            <div class="container-fluid p-3">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                    <div class="row">
                                        <div class="form-group mb-4 col-sm-12 col-md-5">
                                            <label class="mr-sm-2" for="fecha_ini">Fecha inicial</label>
                                            <input type="date" class="form-control custom-radius custom-shadow border-0" 
                                            id="fecha_ini">
                                        </div>
                                        <div class="form-group mb-4 col-sm-12 col-md-5">
                                            <label class="mr-sm-2" for="fecha_fin">Fecha final</label>
                                            <input type="date" class="form-control custom-radius custom-shadow border-0" 
                                            id="fecha_fin">
                                        </div>
                                        <div class="col-sm-12 col-md-2 mt-3">
                                            <button type="button" id="search_report"
                                                class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
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
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card border-button boder">
                                                <div class="card-body" style="padding: 15px;">
                                                    <h4 class="card-title">Resumen por cuenta</h4>
                                                    <div id="resumen" class="mt-4 overflow-auto" style="max-height: 150px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card border-button boder">
                                                <div class="card-body" style="padding: 15px;">
                                                    <h4 class="card-title">TOP 10 de gastos</h4>
                                                    <div id="top_10" class="overflow-auto" style="max-height: 150px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="card border-button boder">
                                                <div class="card-body" style="padding: 15px;">
                                                    <h4 class="card-title">Presupuesto</h4>
                                                    <div id="cumplimiento" class="mt-4 overflow-auto" style="max-height: 150px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="ModalActivityAccount" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="ModalActiAccLbl" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="ModalActiAccLbl"></h4>
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

    <!--Custom JavaScript -->
    <script src="../java/reportes.php"></script>
    
</body>

</html>