<?php
    include_once __DIR__ . '/../control/autoControl.php';

    $autoControl = new AutoControl();
    $autos = $autoControl->listarAutoConDuenio();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Autos Cargados en la BD</h1>
    <?php if (count($autos)> 0) : ?>
        <table border="1">
            <tr>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Dueño</th>
            </tr>
            <?php foreach($autos as $auto) : ?>
                <tr>
                    <td><?= $auto['Patente']?></td>
                    <td><?= $auto['Marca']?></td>
                    <td><?= $auto['Modelo']?></td>
                    <td><?= $auto['Nombre'] . " " . $auto["Apellido"]?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p> NO HAY AUTOS CARGADOS EN LA BD</p>
            <?php endif; ?>
</body>
</html>