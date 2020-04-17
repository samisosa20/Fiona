<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$insert = "select
a.categoria, b.categoria AS sub_categoria, if(isnull(b.categoria), a.id, b.id) AS nro_sub_catego,
b.grupo, a.id_user from fionadb.categorias a left join fionadb.categorias b on
(a.id_user = b.id_user and b.sub_categoria = a.id) where
a.grupo <> 5 and a.id_user = '$id_user' and b.categoria IS NOT NULL 
order by a.categoria, nro_sub_catego";
$ejecutar =mysqli_query( $conn,$insert);
if (!$_GET["act"]){
    $select = 0;
} else{
    $select = $_GET["act"];
}
$aux = "";
$flag = 0;
echo "<option value='0' selected>Sin categoria</option>";
while ($lista = mysqli_fetch_array($ejecutar)){
    $id = $lista["nro_sub_catego"];
    $sub_categoria = $lista ["sub_categoria"];
    $categoria = $lista ["categoria"];
    if ($categoria != $aux){
        if ($select == $id){
            echo "<option value='$id' selected class='font-weight-bold'>$categoria</option>";
        } else {
            echo "<option value='$id' class='font-weight-bold'>$categoria</option>";
        }
        $flag = 1;
    } else {
        $flag = 0;
    }
    if ($sub_categoria != $categoria){
        if ($select == $id){
            echo "<option value='$id' selected>&nbsp;&nbsp;&nbsp$sub_categoria</option>";
        } else {
            echo "<option value='$id'>&nbsp;&nbsp;&nbsp$sub_categoria</option>";
        }
    }   
    $aux = $categoria;
}
mysqli_close($conn);
?>