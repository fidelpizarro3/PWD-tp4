<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cambio de Dueño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../menu.php" class="btn btn-outline-primary">Volver al Menú</a>
  <script>
    function validarFormulario() {
      const patente = document.getElementById("patente").value.trim();
      const dni = document.getElementById("dni").value.trim();

      if (patente === "") {
        alert("Por favor ingrese la patente del auto");
        return false;
      }
      if (dni === "" || isNaN(dni)) {
        alert("Ingrese un número de documento válido");
        return false;
      }
      return true;
    }
  </script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
    <h2 class="text-center mb-4 text-primary">Cambio de Dueño</h2>
    
    <form action="accionCambioDuenio.php" method="post" onsubmit="return validarFormulario()">
      <div class="mb-3">
        <label for="patente" class="form-label">Patente del auto:</label>
        <input type="text" id="patente" name="patente" class="form-control" placeholder="Ej: ABC123">
      </div>
      <div class="mb-3">
        <label for="dni" class="form-label">DNI del nuevo dueño:</label>
        <input type="text" id="dni" name="dni" class="form-control" placeholder="Ej: 40123456">
      </div>
      <button type="submit" class="btn btn-success w-100">Cambiar dueño</button>
    </form>
  </div>

  <script src="../../Public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
