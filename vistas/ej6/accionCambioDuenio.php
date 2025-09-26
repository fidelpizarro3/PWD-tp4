<?php
require_once __DIR__ . '/../../Control/autoControl.php';
require_once __DIR__ . '/../../Control/personaControl.php';

$patente = isset($_POST['patente']) ? trim($_POST['patente']) : '';
$dni     = isset($_POST['dniNuevo']) ? trim($_POST['dniNuevo']) : '';

$mensaje = '';
$ok      = false;

if ($patente === '' || $dni === '') {
    $mensaje = "Debe ingresar patente y DNI.";
} else {
    $autoCtrl    = new AutoControl();
    $personaCtrl = new PersonaControl();

    $persona = $personaCtrl->buscar($dni);   
    $auto    = $autoCtrl->buscar($patente);   

    if (!$auto) {
        $mensaje = "No se encontro el auto con patente " . htmlspecialchars($patente) . ".";
    } elseif (!$persona) {
        $mensaje = "No se encontro la persona con DNI " . htmlspecialchars($dni) . ".";
    } else {
        $ok = $autoCtrl->cambiarDuenio($patente, $dni);
        $mensaje = $ok
            ? "El duenio del auto <strong>" . htmlspecialchars($patente) . "</strong> fue cambiado correctamente."
            : "No se pudo realizar el cambio (verifique la patente y que el DNI exista).";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Cambio de Duenio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">Resultado</div>
            <div class="card-body">
            <div class="alert alert-<?= $ok ? 'success' : 'danger' ?> text-center">
                <?= $mensaje ?>
            </div>
            <div class="text-center d-flex gap-2 justify-content-center">
                <a href="CambioDuenio.php" class="btn btn-secondary">Volver</a>
                <a href="../menu.php" class="btn btn-outline-primary">Menú</a>
            </div>
            </div>
        </div>

        <?php if (!$ok && $patente !== '' && $dni !== '') { ?>
            <div class="mt-3 small text-muted">
            <ul>
                <li>¿La patente en la BD tiene espacios o guiones? (ej: <code>AA-123-BB</code>)</li>
                <li>¿El DNI <code><?= htmlspecialchars($dni) ?></code> existe en la tabla <code>persona</code>?</li>
                <li>¿Hay restricción FOREIGN KEY sobre <code>auto.DniDuenio</code>? Si no existe la persona, el UPDATE falla.</li>
            </ul>
            </div>
        <?php } ?>
        </div>
    </div>
     </div>
</body>
</html>
