<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$id = $_GET["id"];
$insert = "SELECT * FROM fionadb.cuentas WHERE id_user='$id_user' and id='$id'";
$ejecutar =mysqli_query( $conn,$insert);
while ($lista = mysqli_fetch_array($ejecutar)){
    $divisa = $lista ["Divisa"];
    echo "<option value='$divisa'>$divisa</option>";
}
mysqli_close($conn);
?>