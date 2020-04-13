<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$select = $_GET["select"];
$insert = "SELECT DISTINCT(divisa) FROM fionadb.cuentas WHERE id_user='$id_user'";
$ejecutar =mysqli_query($conn,$insert);
while ($lista = mysqli_fetch_array($ejecutar)){
    $divisa = $lista ["divisa"];
    if ($select == $divisa){
        echo "<option selected value='$divisa'>$divisa</option>";
    } else {
        echo "<option value='$divisa'>$divisa</option>";
    }
}
mysqli_close($conn);
?>