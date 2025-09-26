<?php

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
    'NroDni'    => v('NroDni'),
    'Apellido'  => v('Apellido'),
    'Nombre'    => v('Nombre'),
    'FechaNac'  => v('FechaNac'),
    'Telefono'  => v('Telefono'),
    'Domicilio' => v('Domicilio'),
];

$errores = [];
    if (!preg_match('/^\d{7,8}$/', $data['NroDni'])) $errores[] = 'DNI inválido.';
    if ($data['Nombre'] === '')   $errores[] = 'Nombre es obligatorio.';
    if ($data['Apellido'] === '') $errores[] = 'Apellido es obligatorio.';
    if ($data['Domicilio'] === '')$errores[] = 'Domicilio es obligatorio.';
    if ($data['FechaNac'] === '') $errores[] = 'Fecha de nacimiento es obligatoria.';

    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Resultado</title>';
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light">';
    echo '<div class="container py-4">';

    if ($errores) {
        echo '<div class="alert alert-danger"><strong>No se pudo cargar.</strong><ul class="mb-0">';
        foreach ($errores as $e) echo '<li>'.htmlspecialchars($e).'</li>';
        echo '</ul></div>';
        echo '<a href="NuevaPersona.php" class="btn btn-secondary">Volver</a>';
        echo '</div></body></html>';
        exit;
    }

$ctrl = new PersonaControl();

$ok = $ctrl->insertar($data['NroDni'], $data['Apellido'], $data['Nombre'], $data['FechaNac'], $data['Telefono'], $data['Domicilio']);

    if ($ok) {
        echo '<div class="alert alert-success">La persona se cargó <strong>correctamente</strong>.</div>';
    } else {
        echo '<div class="alert alert-danger">Ocurrió un <strong>error</strong> al guardar la persona.</div>';
    }   

echo '<a href="NuevaPersona.php" class="btn btn-primary me-2">Cargar otra</a>';
echo '<a href="listarPersonas.php" class="btn btn-secondary">Volver al listado</a>';
echo '</div></body></html>';
