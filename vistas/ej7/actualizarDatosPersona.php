<?php
include_once "../../control/personaControl.php";
include_once "../../utils/request.php";

$dni = Request::post("dni");
$apellido = Request::post("apellido");
$nombre = Request::post("nombre");
$fecha = Request::post("fechaNacimiento");
$telefono = Request::post("telefono");
$domicilio = Request::post("domicilio");

$control = new PersonaControl();
$exito = $control->modificar($dni, $apellido, $nombre, $fecha, $telefono, $domicilio);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Persona</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../menu.php" class="btn btn-secondary">Volver al Menú</a>
</head>
<body class="container mt-5">
  <h2>Resultado de actualización</h2>
  <?php if ($exito): ?>
    <p class="text-success"> Los datos de la persona fueron actualizados correctamente.</p>
  <?php else: ?>
    <p class="text-danger"> Hubo un error al intentar actualizar los datos.</p>
  <?php endif; ?>
</body>
</html>
