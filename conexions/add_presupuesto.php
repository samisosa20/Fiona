<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $action = $_GET["act"];
    $mes_ini = $_POST["mes_ini"];
    $valor = $_POST["valor"];
    $categoria = $_POST["categoria"];
    $modo_presu = $_POST["modo_presu"];
    $divisa = $_POST["divisa"];
    $ano = $_POST["ano"];

    if ($action == "1"){
        for ($i = $mes_ini; $i <= 12; $i += $modo_presu) {
            $insert = "INSERT INTO fionadb.presupuesto
            (categoria, valor, divisa, mes, `year`, id_user)
            VALUES('$categoria', $valor, '$divisa', $i, $ano, '$id_user');
            ";
            $save = mysqli_query($conn, $insert);
        }
    } else if ($action == 2){
        if ($mes_ini == 1 && $_POST["replicar_val"] == 1){
            for ($i = 1; $i <= 12; $i++) {
                $insert = "INSERT INTO fionadb.presupuesto
                (categoria, valor, divisa, mes, `year`, id_user)
                VALUES('$categoria', $valor, '$divisa', $i, $ano, '$id_user');
                ";
                $save = mysqli_query($conn, $insert);
            }
        } else {
            $insert = "INSERT INTO fionadb.presupuesto
            (categoria, valor, divisa, mes, `year`, id_user)
            VALUES('$categoria', $valor, '$divisa', $mes_ini, $ano, '$id_user');
            ";
            $save = mysqli_query($conn, $insert);
        }

    }

    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>