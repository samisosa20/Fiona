<?php
function ingreso(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE grupo= 4
        and a.id_user='$id_user' GROUP BY b.categoria";
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
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE (grupo= 1
        or grupo = 2) and a.id_user='$id_user' GROUP BY b.categoria";
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
        movimientos();
        break;
    case 4:
        consolidado();
        break;
}
?>
