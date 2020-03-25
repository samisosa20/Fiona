<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $id = $_POST["id"];
    $delete = "DELETE FROM fionadb.cuentas
    WHERE id=$id and id_user='$id_user';";
    $save = mysqli_query($conn, $delete);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>