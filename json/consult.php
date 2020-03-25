<?php
function list_cate(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $lvl = $_GET['lvl'];
        $strsql = "SELECT a.id, a.categoria, COUNT(b.id) AS cantidad FROM fionadb.categorias AS a
        LEFT JOIN fionadb.categorias AS b ON (a.id = b.sub_categoria) WHERE a.id_user='$id_user'
        and a.sub_categoria=$lvl and a.categoria != 'Transferencia' GROUP BY a.categoria";
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

function list_account(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $lvl = $_GET['lvl'];
        $strsql = "SELECT a.id, nombre, FORMAT(IF(SUM(valor) IS NULL, 0, SUM(valor)) + monto_inicial, 2)
        AS cantidad,  IF(SUM(valor) IS NULL, 0, SUM(valor)) + monto_inicial
        AS cantidad_int, a.descripcion, a.divisa, a.cuenta_ahorro FROM fionadb.cuentas AS a 
        LEFT JOIN fionadb.movimientos AS b ON (a.id = cuenta and a.id_user = b.id_user)
        WHERE a.id_user='$id_user' GROUP BY nombre, b.divisa";
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

function movimientos(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $lvl = $_GET['lvl'];
        $strsql = "SELECT a.id, a.categoria AS nro_cate, b.categoria, valor AS valor_int, FORMAT(valor,2) AS valor, divisa, fecha, DAY(fecha) AS dia, MONTH(fecha) AS mes,
        YEAR(fecha) AS ano, a.descripcion, a.id_transfe FROM fionadb.movimientos AS a JOIN fionadb.categorias AS b ON
        (a.id_user = b.id_user and b.id = a.categoria) WHERE cuenta=$lvl and a.id_user='$id_user'";
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

function consolidado(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $strsql = "SELECT ingreso, Egresos, utilidad, FORMAT(utilidad,2) AS utilidad_bal 
        FROM fionadb.consolidado WHERE id_user='$id_user'";
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
        list_cate();
        break;
    case 2:
        list_account();
        break;
    case 3:
        movimientos();
        break;
    case 4:
        consolidado();
        break;
}
?>
