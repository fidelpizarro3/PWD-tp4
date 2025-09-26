<?php // Vistas/CambioDuenio.php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Cambio de Dueño de Auto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <a href="../menu.php" class="btn btn-secondary">Volver al menú</a>
</head>
<body>
    <div class="card shadow-sm">
    <div class="card-header">Cambiar dueño de un auto</div>
    <div class="card-body">
        <form id="formCambio" class="row g-3 needs-validation" method="post" action="accionCambioDuenio.php" onsubmit="return validar()">
        <div class="col-sm-6">
            <label for="patente" class="form-label">Patente</label>
            <input type="text" class="form-control" id="patente" name="patente" 
                    placeholder="ABC123 o AA123BB"
                    required pattern="^[A-Z0-9]{6,7}$" maxlength="8" />
        <div class="invalid-feedback">Ingrese una patente valida (6 o 7 caracteres, solo letras y numeros).</div>
    </div>

        <div class="col-sm-6">
            <label for="DniNuevo" class="form-label">DNI nuevo dueño</label>
            <input type="text" class="form-control" id="dniNuevo" name="dniNuevo"
                    required pattern="^\d{7,8}$" inputmode="numeric" maxlength="8" />
            <div class="invalid-feedback">Ingrese un DNI valido (7 u 8 digitos).</div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Cambiar duenio</button>
        </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function () {
        const form = document.getElementById('formCambio');
        const patente = document.getElementById('patente');
        const dni = document.getElementById('dniNuevo');

        form.addEventListener('submit', function (e) {
        patente.value = (patente.value || '').trim().toUpperCase();
        dni.value = (dni.value || '').trim();

        // Reglas extra por si el browser no aplica pattern:
        const okPatente = /^[A-Z0-9]{6,7}$/.test(patente.value);
        const okDni = /^\d{7,8}$/.test(dni.value);
        patente.setCustomValidity(okPatente ? '' : 'Patente invalida');
        dni.setCustomValidity(okDni ? '' : 'DNI invalido');

        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
        }, false);
    })();
    </script>
</body>
</html>
