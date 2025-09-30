<?php
include_once "../../control/autoControl.php";
include_once "../../control/personaControl.php";
include_once "../../utils/request.php";

$patente = Request::post("patente");
$marca = Request::post("marca");
$modelo = Request::post("modelo");
$dni = Request::post("dni");

$autoControl = new AutoControl();
$personaControl = new PersonaControl();

$persona = $personaControl->buscar($dni);
$resultado = false;
$mensaje = "";

if ($persona) {
    // Si la persona existe → inserto el auto
    $resultado = $autoControl->insertar($patente, $marca, $modelo, $dni);
    if ($resultado) {
        $mensaje = "✅ El auto con patente <b>$patente</b> fue registrado correctamente.";
    } else {
        $mensaje = "❌ No se pudo registrar el auto.";
    }
} else {
    $mensaje = "❌ No existe ninguna persona con el DNI <b>$dni</b>. <br>
    <a href='../ej7/NuevaPersona.php' class='btn btn-link'>Registrar nueva persona</a>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado Nuevo Auto</title>
  <link href="../../Public/CSS/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
    <h2 class="text-center mb-4 text-primary">Resultado del Registro</h2>
    <div class="alert <?= $resultado ? 'alert-success' : 'alert-danger' ?>" role="alert">
      <?= $mensaje ?>
    </div>
    <div class="text-center">
      <a href="NuevoAuto.php" class="btn btn-outline-primary">Volver</a>
    </div>
  </div>
  <script src="../../Public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
