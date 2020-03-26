<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$insert = "SELECT * FROM fionadb.categorias WHERE id_user='$id_user' and grupo != 5";
$ejecutar =mysqli_query( $conn,$insert);
if (!$_GET["act"]){
    $select = 0;
} else{
    $select = $_GET["act"];
}
echo "<option value='0' selected>Sin categoria</option>";
while ($lista = mysqli_fetch_array($ejecutar)){
    $id = $lista["id"];
    $nombre = $lista ["categoria"];
    if ($select == $id){
        echo "<option value='$id' selected>$nombre</option>";
    } else {
        echo "<option value='$id'>$nombre</option>";
    }
}
mysqli_close($conn);
?>