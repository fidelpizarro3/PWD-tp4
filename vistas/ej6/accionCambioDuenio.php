<?php
include_once "../../control/autoControl.php";
include_once "../../control/personaControl.php";
include_once "../../utils/request.php";

$patente = Request::post("patente");
$dni = Request::post("dni");

$autoControl = new AutoControl();
$personaControl = new PersonaControl();

$auto = $autoControl->buscar($patente);
$persona = $personaControl->buscar($dni);

$resultado = false;
$mensaje = "";

if ($auto && $persona) {
    // Cambiar dueño
    $resultado = $autoControl->cambiarDuenio($patente, $dni);
    if ($resultado) {
        $mensaje = " El dueño del auto con patente <b>$patente</b> fue actualizado correctamente.";
    } else {
        $mensaje = " No se pudo realizar el cambio de dueño.";
    }
} else {
    if (!$auto) {
        $mensaje .= " No se encontró un auto con la patente ingresada.<br>";
    }
    if (!$persona) {
        $mensaje .= " No se encontró una persona con el DNI ingresado.<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado Cambio Dueño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../menu.php" class="btn btn-outline-primary">Volver al Menú</a>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
    <h2 class="text-center mb-4 text-primary">Resultado del Cambio de Dueño</h2>

    <div class="alert <?= $resultado ? 'alert-success' : 'alert-danger' ?>" role="alert">
      <?= $mensaje ?>
    </div>

    <div class="text-center">
      <a href="CambioDuenio.php" class="btn btn-outline-primary">Volver</a>
    </div>
  </div>

  <script src="../../Public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
