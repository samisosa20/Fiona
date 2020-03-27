<?php
function ingreso(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE grupo= 4
        and a.id_user='$id_user' and divisa='$divi' GROUP BY b.categoria";
        $rs = mysqli_query($conn, $strsql);
        $total_rows = $rs->num_rows;
        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }
            echo(json_encode($data));
        }
    }
};
function egreso(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE (grupo= 1
        or grupo = 2) and a.id_user='$id_user' and divisa='$divi' GROUP BY b.categoria";
        $rs = mysqli_query($conn, $strsql);
        $total_rows = $rs->num_rows;
        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }
            echo(json_encode($data));
        }
    }
};
function ahorros(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $strsql = "SELECT nombre, SUM(valor) + monto_inicial AS cantidad FROM fionadb.cuentas AS a JOIN fionadb.movimientos AS b
        ON(a.id_user = b.id_user and b.cuenta = a.id) WHERE a.id_user='yvPiz' and b.divisa='COP'
        and cuenta_ahorro = 1 GROUP BY nombre";
        $rs = mysqli_query($conn, $strsql);
        $total_rows = $rs->num_rows;
        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }
            echo(json_encode($data));
        }
    }
};
function diario(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $strsql = "SELECT Date_format(fecha,'%m/%d') AS fecha, SUM(if(valor > 0, valor, 0)) AS ingresos,
        SUM(if(valor < 0, valor, 0)) AS egresos FROM fionadb.movimientos
        WHERE id_user='$id_user' and fecha >= DATE_SUB(NOW(),INTERVAL 15 DAY) and divisa='$divi'
        GROUP BY Date_format(fecha,'%m/%d')";
        $rs = mysqli_query($conn, $strsql);
        $total_rows = $rs->num_rows;
        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }
            echo(json_encode($data));
        }
    }
};
$action = $_GET['action'];
switch($action) {
    case 1: 
        ingreso();
        break;
    case 2:
        egreso();
        break;
    case 3:
        ahorros();
        break;
    case 4:
        diario();
        break;
}
?>
