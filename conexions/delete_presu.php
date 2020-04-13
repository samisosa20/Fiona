<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $ano = $_POST["ano"];
    $delete1 = "DELETE FROM fionadb.presupuesto
    WHERE year = $ano";
    $save1 = mysqli_query($conn, $delete1);
    if(!$save1){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>