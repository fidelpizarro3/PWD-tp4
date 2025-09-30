<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Nuevo Auto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <a href="../menu.php" class="btn btn-secondary mb-3">Volver al menú</a>

  <div class="card shadow-sm">
    <div class="card-header">Registrar nuevo auto</div>
    <div class="card-body">
      <form id="formAuto" class="row g-3 needs-validation" novalidate method="post" action="./accionNuevoRegistro.php">
        
        <div class="col-sm-6">
          <label for="Patente" class="form-label">Patente</label>
          <input type="text" class="form-control" id="Patente" name="Patente"
                 required pattern="^[A-Z0-9]{6,7}$" maxlength="7"/>
          <div class="invalid-feedback">Ingrese una patente válida (6–7 caracteres alfanuméricos en mayúscula).</div>
        </div>

        <div class="col-sm-6">
          <label for="Marca" class="form-label">Marca</label>
          <input type="text" class="form-control" id="Marca" name="Marca" required maxlength="40"/>
          <div class="invalid-feedback">La marca es obligatoria.</div>
        </div>

        <div class="col-sm-6">
          <label for="Modelo" class="form-label">Modelo</label>
          <input type="text" class="form-control" id="Modelo" name="Modelo" required maxlength="40"/>
          <div class="invalid-feedback">El modelo es obligatorio.</div>
        </div>

        <div class="col-sm-6">
          <label for="DniDuenio" class="form-label">DNI del dueño</label>
          <input type="text" class="form-control" id="DniDuenio" name="DniDuenio"
                 required pattern="^\d{7,8}$" inputmode="numeric" maxlength="8"/>
          <div class="invalid-feedback">Ingrese un DNI válido (7–8 dígitos).</div>
        </div>

        <div class="col-12 d-flex gap-2">
          <button class="btn btn-success" type="submit">Registrar Auto</button>
          <a href="../menu.php" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
  const form = document.getElementById('formAuto');
  form.addEventListener('submit', function (e) {
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
