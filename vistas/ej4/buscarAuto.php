<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Auto</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <a href="../menu.php" class="btn btn-secondary">Volver al menú</a>
    <script>
        function validarFormulario() {
            const patente = document.getElementById("patente").value.trim();
            if (patente === "") {
                alert("Por favor ingrese una patente.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Buscar Auto</h1>
    <form action="./accionBuscarAuto.php" method="post" onsubmit="return validarFormulario()">
        <label for="patente">Ingrese la patente:</label>
        <input type="text" id="patente" name="patente">
        <button type="submit">Buscar</button>
    </form>
</body>
</html>
