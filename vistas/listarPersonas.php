<?php
require_once __DIR__ . '/../Control/personaControl.php';

$personaCtrl = new PersonaControl();
$personas = $personaCtrl->listarPersonas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Personas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
    <h2 class="mb-4 text-center">Listado de Personas</h2>

    <?php if (empty($personas)) { ?>
        <div class="alert alert-warning text-center">No hay personas cargadas.</div>
    <?php } else { ?>
        <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>DNI</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($personas as $p) {
                    $dni      = is_object($p) ? $p->getNroDni()   : ($p['NroDni'] ?? '');
                    $apellido = is_object($p) ? $p->getApellido() : ($p['Apellido'] ?? '');
                    $nombre   = is_object($p) ? $p->getNombre()   : ($p['Nombre'] ?? '');
                ?>
                <tr>
                    <td><?= htmlspecialchars($dni) ?></td>
                    <td><?= htmlspecialchars($apellido) ?></td>
                    <td><?= htmlspecialchars($nombre) ?></td>
                    <td>
                    <form action="autosPersonas.php" method="post" style="display:inline;">
                        <input type="hidden" name="dni" value="<?= htmlspecialchars($dni) ?>">
                        <button type="submit" class="btn btn-sm btn-primary">
                        Ver autos
                        </button>
                    </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
