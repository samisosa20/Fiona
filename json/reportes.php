<?php
function consolidado(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT nombre, FORMAT(SUM(IF(valor > 0, valor, 0)),2) AS ingreso, 
        FORMAT(SUM(IF(valor < 0, valor, 0)),2) AS egreso, 
        SUM(valor) AS utilidad, a.divisa, a.id_user
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        WHERE a.id_user = '$id_user' and a.divisa = '$divi' and
        fecha>='$fecha_ini' and fecha<='$fecha_fin' GROUP BY a.cuenta, a.divisa";
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

function ingreso(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE grupo= 4
        and a.id_user='$id_user' and divisa='$divi' and
        fecha>='$fecha_ini' and fecha<='$fecha_fin' GROUP BY b.categoria";
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
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad FROM fionadb.movimientos AS a
        JOIN fionadb.categorias AS b ON (a.categoria = b.id and a.id_user = b.id_user) WHERE (grupo= 1
        or grupo = 2) and a.id_user='$id_user' and divisa='$divi' and
        fecha>='$fecha_ini' and fecha<='$fecha_fin' GROUP BY b.categoria";
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
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT nombre, SUM(valor) + monto_inicial AS cantidad FROM fionadb.cuentas AS a JOIN fionadb.movimientos AS b
        ON(a.id_user = b.id_user and b.cuenta = a.id) WHERE a.id_user='$id_user' and b.divisa='$divi' and
        fecha>='$fecha_ini' and fecha<='$fecha_fin' and cuenta_ahorro = 1 GROUP BY nombre";
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

function top_gasto(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT b.categoria, SUM(valor) AS cantidad, a.divisa, a.id_user
        FROM fionadb.movimientos AS a JOIN fionadb.categorias AS b ON(a.id_user = b.id_user and a.categoria = b.id) 
        WHERE a.id_user = '$id_user' and a.divisa = '$divi' and fecha>='$fecha_ini' and fecha<='$fecha_fin' and valor < 0
        and id_transfe IS NULL GROUP BY a.categoria, a.divisa ORDER BY cantidad ASC LIMIT 10";
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

function consolidado_year(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi = $_GET['divi'];
        $strsql = "SELECT nombre, SUM(IF(valor > 0, valor, 0)) AS ingreso, 
        SUM(IF(valor < 0, valor, 0)) AS egreso, 
        SUM(valor) AS utilidad, a.divisa, a.id_user
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        WHERE a.id_user = '$id_user' and a.divisa = '$divi' GROUP BY a.cuenta, a.divisa";
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

function move_year(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $cuenta = $_GET['account'];
        $sig = $_GET['sig'];
        if ($sig == 1){
            $compa = '>';
        } else {
            $compa = '<';
        }
        
        $strsql = "SELECT b.nombre, SUM(valor) AS cantidad, a.divisa, a.id_user, MONTHNAME(fecha) AS mes
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        WHERE a.id_user = '$id_user' and a.divisa = '$divi' and valor $compa 0
        and b.nombre = '$cuenta' GROUP BY MONTH(fecha) ORDER BY MONTH(fecha) ASC";
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

function move_account_moth(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $cuenta = $_GET['account'];
        $mes = $_GET['mes'];
        $sig = $_GET['sig'];
        if ($sig == 1){
            $compa = '>';
        } else {
            $compa = '<';
        }
        $strsql = "SELECT c.categoria, SUM(valor) AS cantidad, a.divisa, a.id_user, fecha
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        JOIN fionadb.categorias AS c ON (a.id_user = c.id_user and a.categoria =c.id) WHERE a.id_user = '$id_user' 
        and a.divisa = '$divi' and valor $compa 0 and MONTHNAME(fecha) = '$mes'
        and b.nombre = '$cuenta' GROUP BY a.categoria ORDER BY fecha ASC";
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

function move_account_interval(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $cuenta = $_GET['account'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT c.categoria, SUM(valor) AS cantidad, a.divisa, a.id_user, fecha
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        JOIN fionadb.categorias AS c ON (a.id_user = c.id_user and a.categoria =c.id) WHERE a.id_user = '$id_user' 
        and a.divisa = '$divi' and fecha >= '$fecha_ini' and fecha <= '$fecha_fin'
        and b.nombre = '$cuenta' GROUP BY a.categoria ORDER BY fecha ASC";
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

function move_catego_interval(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $catego = $_GET['catego'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT b.nombre, SUM(valor) AS cantidad, a.divisa, a.id_user, fecha
        FROM fionadb.movimientos AS a JOIN fionadb.cuentas AS b ON(a.id_user = b.id_user and a.cuenta = b.id) 
        JOIN fionadb.categorias AS c ON (a.id_user = c.id_user and a.categoria =c.id) WHERE a.id_user = '$id_user' 
        and a.divisa = '$divi' and fecha >= '$fecha_ini' and fecha <= '$fecha_fin'
        and c.categoria = '$catego' GROUP BY a.cuenta ORDER BY fecha ASC";
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

function cumpli_presu_lvl_1(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $fecha_ini = $_GET['fecha_ini'];
        $fecha_fin = $_GET['fecha_fin'];
        $strsql = "SELECT categoria, grupo, SUM(cantidad) AS cantidad, SUM(generado) AS generado, ROUND(SUM(generado)/SUM(cantidad) * 100, 2) 
        AS cumplimiento, MONTHNAME(CONCAT(year,'-',mes,'-',1)) AS name_mes, mes, year, id_user FROM compara_presu WHERE id_user = '$id_user' and mes >= MONTH('$fecha_ini') and mes <= MONTH('$fecha_fin')
        GROUP BY categoria, mes, year, id_user ORDER BY grupo DESC, categoria, year, mes";
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

function cumpli_presu_lvl_2(){
    include_once('../conexions/connect.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $id_user = $_GET['idu'];
        $divi =  $_GET['divi'];
        $catego = $_GET['catego'];
        $mes = $_GET['mes'];
        $strsql = "SELECT * FROM fionadb.compara_presu WHERE categoria = '$catego' and mes = $mes and id_user = '$id_user'";
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
        consolidado();
        break;
    case 2:
        ingreso();
        break;
    case 3:
        egreso();
        break;
    case 4:
        ahorros();
        break;
    case 5:
        top_gasto();
        break;
    case 6:
        consolidado_year();
        break;
    case 7:
        move_year();
        break;
    case 8:
        move_account_moth();
        break;
    case 9:
        move_account_interval();
        break;
    case 10:
        move_catego_interval();
        break;
    case 11:
        cumpli_presu_lvl_1();
        break;
    case 12:
        cumpli_presu_lvl_2();
        break;
}
?>
