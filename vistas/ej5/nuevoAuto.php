<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nuevo Auto</title>
  <link href="../../Public/CSS/bootstrap.min.css" rel="stylesheet">
  <script>
    function validarFormulario() {
      const patente = document.getElementById("patente").value.trim();
      const marca = document.getElementById("marca").value.trim();
      const modelo = document.getElementById("modelo").value.trim();
      const dni = document.getElementById("dni").value.trim();

      if (patente === "" || marca === "" || modelo === "" || dni === "") {
        alert("Todos los campos son obligatorios");
        return false;
      }
      if (isNaN(dni)) {
        alert("El DNI debe ser un número");
        return false;
      }
      return true;
    }
  </script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
    <h2 class="text-center mb-4 text-primary">Registrar Nuevo Auto</h2>
    <form action="accionNuevoAuto.php" method="post" onsubmit="return validarFormulario()">
      <div class="mb-3">
        <label for="patente" class="form-label">Patente:</label>
        <input type="text" id="patente" name="patente" class="form-control" placeholder="Ej: ABC123">
      </div>
      <div class="mb-3">
        <label for="marca" class="form-label">Marca:</label>
        <input type="text" id="marca" name="marca" class="form-control">
      </div>
      <div class="mb-3">
        <label for="modelo" class="form-label">Modelo:</label>
        <input type="text" id="modelo" name="modelo" class="form-control">
      </div>
      <div class="mb-3">
        <label for="dni" class="form-label">DNI del dueño:</label>
        <input type="text" id="dni" name="dni" class="form-control">
      </div>
      <button type="submit" class="btn btn-success w-100">Registrar Auto</button>
    </form>
  </div>

  <script src="../../Public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
