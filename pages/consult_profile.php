<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$action=$_GET["action"];
$insert = "SELECT * FROM fionadb.users WHERE id_user='$id_user'";
$ejecutar =mysqli_query( $conn,$insert);
$lista = mysqli_fetch_array($ejecutar);
$name = $lista["name"];
$last_name = $lista["last_name"];
$email = $lista["email"];
$divisa = $lista["divisa_prim"];
if ($action == 1) {
    echo $name;
} else if ($action == 2){
    echo $last_name;
} else if ($action == 3){
    echo $email;
} else if ($action == 4){
    echo $divisa;
}
mysqli_close($conn);
?>