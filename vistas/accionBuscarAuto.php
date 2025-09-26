<?php
include_once "../Control/autoControl.php";
include_once "../Utils/Request.php"; // agrego la utils pra el encapsulado

$patente = Request::post('patente'); // ahora encapsulado

$control = new AutoControl();
$auto = $control->buscar($patente); // usamos el controlador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Búsqueda</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <h1>Resultado de la búsqueda</h1>

    <?php if($auto): ?>
        <table>
            <tr>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Dueño</th>
            </tr>
            <tr>
                <td><?= $auto['Patente'] ?></td>
                <td><?= $auto['Marca'] ?></td>
                <td><?= $auto['Modelo'] ?></td>
                <td><?= $auto['Nombre'] . " " . $auto['Apellido'] ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p> No se encontró ningún auto con la patente ingresada.</p>
    <?php endif; ?>
</body>
</html>
