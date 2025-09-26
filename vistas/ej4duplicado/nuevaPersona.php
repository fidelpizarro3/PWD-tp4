<?php
// Vistas/NuevaPersona.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Nueva persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../menu.php" class="btn btn-secondary">Volver al menú</a>
</head>

<body>
    <div class="card shadow-sm">
    <div class="card-header">Cargar nueva persona</div>
    <div class="card-body">
        <form id="formPersona" class="row g-3 needs-validation" novalidate method="post" action="accionNuevaPersona.php">
        <div class="col-sm-6">
            <label for="NroDni" class="form-label">DNI</label>
            <input type="text" class="form-control" id="NroDni" name="NroDni"
                required pattern="^\d{7,8}$" inputmode="numeric" maxlength="8" />
        <div class="invalid-feedback">Ingrese un DNI válido (7 u 8 dígitos numéricos).</div>
        </div>

        <div class="col-sm-6">
            <label for="Telefono" class="form-label">Teléfono</label>
            <input type="tel" 
            class="form-control" 
            id="Telefono" 
            name="Telefono"
            required 
            pattern="^[0-9]{6,20}$" 
            inputmode="numeric" />
        <div class="invalid-feedback">Ingrese solo numeros (6 a 20 digitos).</div>
        </div>


        <div class="col-sm-6">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" required maxlength="60" />
            <div class="invalid-feedback">El nombre es obligatorio.</div>
        </div>

        <div class="col-sm-6">
            <label for="Apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="Apellido" name="Apellido" required maxlength="60" />
            <div class="invalid-feedback">El apellido es obligatorio.</div>
        </div>

        <div class="col-sm-6">
            <label for="FechaNac" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="FechaNac" name="FechaNac" required />
            <div class="invalid-feedback">Seleccione una fecha válida (no futura).</div>
        </div>

        <div class="col-12">
            <label for="Domicilio" class="form-label">Domicilio</label>
            <input type="text" class="form-control" id="Domicilio" name="Domicilio" required maxlength="120" />
            <div class="invalid-feedback">El domicilio es obligatorio.</div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <a href="listarPersonas.php" class="btn btn-secondary">Volver al listado</a>
        </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function () {
      const form = document.getElementById('formPersona');
      const dni  = document.getElementById('NroDni');
      const fecha= document.getElementById('FechaNac');

      form.addEventListener('submit', function (e) {
        // DNI numérico 7-8
        const dniOk = /^\d{7,8}$/.test(dni.value.trim());
        if (!dniOk) dni.setCustomValidity('DNI inválido'); else dni.setCustomValidity('');

        // Fecha no futura
        if (fecha.value) {
          const hoy = new Date().toISOString().slice(0,10);
          if (fecha.value > hoy) {
            fecha.setCustomValidity('La fecha no puede ser futura');
          } else {
            fecha.setCustomValidity('');
          }
        }

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
