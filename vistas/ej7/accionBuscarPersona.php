<?php
include_once "../../control/personaControl.php";
include_once "../../utils/request.php";

$dni = Request::post("dni");

$control = new PersonaControl();
$persona = $control->buscar($dni);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado de búsqueda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <a href="../menu.php" class="btn btn-secondary">Volver al Menú</a>
</head>
<body class="container mt-5">
  <h2>Resultado de búsqueda</h2>

  <?php if ($persona): ?>
    <form action="ActualizarDatosPersona.php" method="post">
      <div class="mb-3">
        <label>DNI:</label>
        <input type="text" name="dni" value="<?= $persona->getNroDni(); ?>" readonly class="form-control">
      </div>
      <div class="mb-3">
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= $persona->getApellido(); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $persona->getNombre(); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Fecha Nacimiento:</label>
        <input type="date" name="fechaNacimiento" value="<?= $persona->getFechaNac(); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?= $persona->getTelefono(); ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Domicilio:</label>
        <input type="text" name="domicilio" value="<?= $persona->getDomicilio(); ?>" class="form-control">
      </div>
      <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
  <?php else: ?>
    <p class="text-danger">No se encontró ninguna persona con el DNI ingresado.</p>
  <?php endif; ?>
</body>
</html>
