<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$insert = "SELECT b.categoria, FORMAT(a.valor,2) AS valor, a.divisa, a.fecha, a.descripcion, c.nombre FROM fionadb.movimientos 
AS a LEFT JOIN fionadb.categorias AS b ON (b.id = a.categoria and a.id_user = b.id_user) LEFT JOIN 
fionadb.cuentas AS c ON (a.id_user = c.id_user and a.cuenta = c.id)
WHERE a.id_user='$id_user' ORDER BY a.fecha DESC LIMIT 4";
$ejecutar =mysqli_query( $conn,$insert);
while ($lista = mysqli_fetch_array($ejecutar)){
    $categoria = $lista["categoria"];
    $cuenta = $lista["nombre"];
    $valor = $lista["valor"];
    $descripcion = $lista["descripcion"];
    $fecha = $lista["fecha"];
    if ((int)$valor < 0 && $categoria != "Transferencia"){
        echo "<div class='d-flex align-items-start border-left-line pb-3'>
        <div>
            <a href='javascript:void(0)' class='btn btn-danger btn-circle mb-2 btn-item'>
                <i class='fas fa-arrow-up'></i>
            </a>
        </div>
        <div class='ml-3 mt-2'>
            <h5 class='text-dark font-weight-medium mb-2'>$cuenta - $categoria</h5>
            <p class='font-14 mb-2 text-muted'>$valor</p>
            <p class='font-14 mb-2 text-muted'>$descripcion</p>
            <span class='font-weight-light font-14 text-muted'>$fecha</span>
        </div>
    </div>";
    } else if ((int)$valor > 0 && $categoria != "Transferencia"){
        echo "<div class='d-flex align-items-start border-left-line pb-3'>
        <div>
            <a href='javascript:void(0)' class='btn btn-success btn-circle mb-2 btn-item'>
                <i class='fas fa-arrow-down'></i>
            </a>
        </div>
        <div class='ml-3 mt-2'>
            <h5 class='text-dark font-weight-medium mb-2'>$cuenta - $categoria</h5>
            <p class='font-14 mb-2 text-muted'>$valor</p>
            <p class='font-14 mb-2 text-muted'>$descripcion
            </p>
            <span class='font-weight-light font-14 text-muted'>$fecha</span>
        </div>
    </div>";
    } else if ((int)$valor > 0 && $categoria == "Transferencia"){
        echo "<div class='d-flex align-items-start border-left-line pb-3'>
        <div>
            <a href='javascript:void(0)' class='btn btn-cyan btn-circle mb-2 btn-item'>
                <i class='fas fa-exchange-alt'></i>
            </a>
        </div>
        <div class='ml-3 mt-2'>
            <h5 class='text-dark font-weight-medium mb-2'>$cuenta - $categoria</h5>
            <p class='font-14 mb-2 text-muted'>$valor</p>
            <p class='font-14 mb-2 text-muted'>$descripcion
            </p>
            <span class='font-weight-light font-14 text-muted'>$fecha</span>
        </div>
    </div>";
    }
}
mysqli_close($conn);
?>