<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$insert = "SELECT * FROM Vpresupuesto WHERE id_user = '$id_user' ORDER BY grupo DESC, categoria ASC";
$ejecutar =mysqli_query( $conn,$insert);
$aux = "";
$acumulado = 0;
$utilidad = 0;
echo "<table class='table table-hover' style='width: 100%;'>
<thead>
    <tr class='text-dark'>
        <th>CATEGORIA</th>
        <th>VALOR ANUAL</th>
    </tr>
</thead>
<tbody>";

while ($lista = mysqli_fetch_array($ejecutar)){
    $cantidad = $lista["cantidad"];
    $categoria = $lista["categoria"];
    $grupo = $lista["grupo"];
    if ($categoria != $aux && $aux != ""){
        echo "<tr class='table-dark text-dark'>
            <th class='font-weight-bold'>$aux</th>
            <th>".formatDollars($acumulado)."</th>
        </tr>";
        $acumulado = 0;
    }
    if ($lista["sub_categoria"] == NULL){
        $sub_categoria = $categoria;
    } else {
        $sub_categoria = $lista["sub_categoria"];
    }
    if ($cantidad == NULL){
        $cantidad = 0;
    }
    echo "<tr>
        <th>$sub_categoria</th>
        <th>".formatDollars($cantidad)."</th>
    </tr>";
    $aux = $categoria;
    $acumulado += $cantidad;
    if ($grupo == 4){
        $utilidad += $cantidad;
    } else {
        $utilidad -= $cantidad;
    }
}
if ($utilidad >= 0){
    $style = "success";
} else {
    $style = "danger";
}
echo "<tr class='table-dark text-dark'>
<th class='font-weight-bold'>$aux</th>
<th>".formatDollars($acumulado)."</th>
</tr>
<tr class='table-$style text-dark'>
<th class='font-weight-bold'>UTILIDAD</th>
<th>".formatDollars($utilidad)."</th>
</tr>
</tbody>
</table>";
mysqli_close($conn);

function formatDollars($dollars)
{
    $formatted = "$" . number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}
?>