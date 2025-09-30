<?php
require_once __DIR__ . '/../../Control/autoControl.php';
require_once __DIR__ . '/../../Control/personaControl.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
    die('<div class="alert alert-danger m-3 text-center">Método no permitido. Envíe el formulario por POST.</div>');
}

function v(string $key): string {
    return isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
}

$data = [
    'Patente'   => strtoupper(v('Patente')),
    'Marca'     => v('Marca'),
    'Modelo'    => v('Modelo'),
    'DniDuenio' => v('DniDuenio'),
];

// Validaciones servidor
$errores = [];
if (!preg_match('/^[A-Z0-9]{6,7}$/', $data['Patente'])) $errores[] = 'Patente inválida.';
if ($data['Marca'] === '')  $errores[] = 'La marca es obligatoria.';
if ($data['Modelo'] === '') $errores[] = 'El modelo es obligatorio.';
if (!preg_match('/^\d{7,8}$/', $data['DniDuenio'])) $errores[] = 'DNI inválido.';

echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Resultado</title>';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light">';
echo '<div class="container py-4">';

if ($errores) {
    echo '<div class="alert alert-danger"><strong>No se pudo registrar el auto.</strong><ul class="mb-0">';
    foreach ($errores as $e) echo '<li>'.htmlspecialchars($e).'</li>';
    echo '</ul></div>';
    echo '<a href="NuevoAuto.php" class="btn btn-secondary">Volver</a>';
    echo '</div></body></html>';
    exit;
}

$autoCtrl = new AutoControl();
$personaCtrl = new PersonaControl();

$persona = $personaCtrl->buscar($data['DniDuenio']);
if (!$persona) {
    echo '<div class="alert alert-warning">No existe ninguna persona con el DNI <b>'.htmlspecialchars($data['DniDuenio']).'</b>.</div>';
    echo '<a href="../ej7/NuevaPersona.php" class="btn btn-primary me-2">Registrar nueva persona</a>';
    echo '<a href="NuevoAuto.php" class="btn btn-secondary">Volver</a>';
    echo '</div></body></html>';
    exit;
}

$ok = $autoCtrl->insertar($data['Patente'], $data['Marca'], $data['Modelo'], $data['DniDuenio']);

if ($ok) {
    echo '<div class="alert alert-success">El auto con patente <strong>'.htmlspecialchars($data['Patente']).'</strong> fue registrado correctamente.</div>';
} else {
    echo '<div class="alert alert-danger">Ocurrió un error al registrar el auto.</div>';
}

echo '<a href="NuevoAuto.php" class="btn btn-primary me-2">Registrar otro</a>';
echo '<a href="../menu.php" class="btn btn-secondary">Volver al menú</a>';
echo '</div></body></html>';
