<?php
require_once __DIR__ . '/../Control/personaControl.php';
require_once __DIR__ . '/../Control/autoControl.php';

/* === Recibir SOLO por POST === */
$dni = $_POST['dni'] ?? $_GET['dni'] ?? '';

if ($dni === '') {
    http_response_code(400);
    die('<div class="alert alert-danger m-3 text-center">Falta el parámetro DNI.</div>');
}

/* === Controles === */
$personaCtrl = new PersonaControl();
$autoCtrl    = new AutoControl();

$persona = $personaCtrl->buscar($dni);     // usa tu método real
$autos   = $autoCtrl->buscarPorDni($dni);  // método que devuelve los autos del dueño
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autos de la Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body class="bg-light">
    <div class="container py-4">
    <h2 class="mb-4 text-center">Autos por Persona</h2>

    <?php if (!$persona) { ?>
        <div class="alert alert-danger text-center">
        No se encontró la persona con DNI <strong><?= htmlspecialchars($dni) ?></strong>.
        </div>
        <div class="text-center">
        <a href="listaPersonas.php" class="btn btn-secondary">Volver al listado</a>
        </div>
    <?php } else { ?>

        <!-- Datos de la persona -->
        <div class="card shadow-sm mb-4">
        <div class="card-header">Datos de la Persona</div>
        <div class="card-body">
            <div class="row g-3">
            <div class="col-sm-4"><strong>DNI:</strong> <?= htmlspecialchars($dni) ?></div>
            <div class="col-sm-4"><strong>Nombre:</strong> <?= htmlspecialchars($persona->getNombre()) ?></div>
            <div class="col-sm-4"><strong>Apellido:</strong> <?= htmlspecialchars($persona->getApellido()) ?></div>
            </div>
        </div>
        </div>

        <div class="card shadow-sm">
        <div class="card-header">Autos asociados</div>
        <div class="card-body p-0">
        <?php if (empty($autos)) { ?>
            <div class="p-3">Esta persona no tiene autos asociados.</div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autos as $a) {
                        $patente = is_object($a) ? $a->getPatente() : ($a['Patente'] ?? '');
                        $marca   = is_object($a) ? $a->getMarca()   : ($a['Marca'] ?? '');
                        $modelo  = is_object($a) ? $a->getModelo()  : ($a['Modelo'] ?? '');
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($patente) ?></td>
                        <td><?= htmlspecialchars($marca) ?></td>
                        <td><?= htmlspecialchars($modelo) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
        </div>

        <div class="mt-3 text-center">
        <a href="/PWD-tp4/Vistas/listarPersonas.php" class="btn btn-secondary">Volver al listado</a>
        </div>

    <?php 
    } 
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
