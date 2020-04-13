<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$id=$_GET["id"];
$action=$_GET["action"];
$insert = "SELECT nombre, a.descripcion, FORMAT(SUM(valor) + monto_inicial,2) AS cantidad, b.divisa 
FROM fionadb.cuentas AS a JOIN fionadb.movimientos AS b ON (a.id_user = b.id_user 
and b.cuenta = a.id) WHERE a.id_user='$id_user' and a.id=$id GROUP BY nombre, divisa";
$ejecutar =mysqli_query( $conn,$insert);
$lista = mysqli_fetch_array($ejecutar);
$nombre = $lista["nombre"];
$descripcion =  $lista["descripcion"];
$cantidad =  $lista["cantidad"];
$divisa =  $lista["divisa"];
if ($action == 1) {
    echo "Movimientos de $nombre";
} else if ($action == 2) {
    echo "<strong>Descripción: </strong>$descripcion";
} else if ($action == 3) {
    echo "<strong>Balance: </strong>$cantidad $divisa";
}
mysqli_close($conn);
?>