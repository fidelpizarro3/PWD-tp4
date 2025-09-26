<?php
include_once "../control/autoControl.php";
include_once "../utils/Request.php"; // agrego la utils pra el encapsulado

$patente = Request::post('patente'); // ahora encapsulado

$control = new AutoControl();
$auto = $control->buscar($patente); // usamos el controlador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Búsqueda</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        p { font-weight: bold; color: red; }
    </style>
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
