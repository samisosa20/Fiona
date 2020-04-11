<?php
function list_year(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $strsql = "SELECT year, FORMAT(SUM(if(grupo = 4, valor, 0)),2) AS ingreso, 
        FORMAT(SUM(if(grupo = 1 or grupo = 2, valor, 0)),2) AS egreso 
        FROM fionadb.presupuesto p 
        JOIN fionadb.categorias c ON (p.categoria = c.id and p.id_user = c.id_user)
        WHERE p.id_user='$id_user' GROUP BY year ORDER BY year ASC";
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

function info_presu_moth(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $catego =  $_GET['catego'];
        $year =  $_GET['year'];
        $strsql = "SELECT p.id, p.categoria, c.categoria AS name_catego, valor, 
        MONTHNAME(CONCAT(year,'-',mes,'-',1)) AS mes_name, mes, year, p.id_user 
        FROM fionadb.presupuesto p JOIN fionadb.categorias c ON (p.id_user = c.id_user and p.categoria = c.id) 
        WHERE p.categoria = $catego and year = $year and p.id_user = '$id_user'";
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
        list_year();
        break;
    case 2:
        info_presu_moth();
        break;
}
?>
