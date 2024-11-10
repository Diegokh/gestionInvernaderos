<?php
$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";
$dwes = mysqli_connect($server, $user, $pass, $base);

if (isset($_GET['id_Invernadero'])) {
    $id = $_GET['id_Invernadero'];

    // Obtenengo los datos del invernadero
    $query_invernadero = "SELECT * FROM invernadero WHERE id_Invernadero = $id";
    $result_invernadero = mysqli_query($dwes, $query_invernadero);
    $invernadero = mysqli_fetch_assoc($result_invernadero);
}

if (isset($_POST['editar_invernadero'])) {
    $id = $_POST['id_Invernadero'];
    $ubicacionInvernadero = $_POST['ubicacionInvernadero'];
    $idUsuario = intval($_POST['idUsuario']); 

    // Actualizo los datos del invernadero con Update
    $query_update = "UPDATE invernadero SET ubicacionInvernadero = '$ubicacionInvernadero', idUsuario = '$idUsuario' WHERE id_Invernadero = '$id'";
    mysqli_query($dwes, $query_update);
    header("Location: gestionInvernaderos.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Invernadero</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Invernadero</h1>

        <form method="post" action="">
            <input type="hidden" name="id_Invernadero" value="<?php echo $invernadero['id_Invernadero']; ?>">
            <div class="mb-3">
                <label for="ubicacionInvernadero" class="form-label">Ubicación del invernadero:</label>
                <input type="text" name="ubicacionInvernadero" class="form-control" value="<?php echo $invernadero['ubicacionInvernadero']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID del dueño:</label>
                <input type="text" name="idUsuario" class="form-control" value="<?php echo $invernadero['idUsuario']; ?>" required>
            </div>
            <button type="submit" name="editar_invernadero" class="btn btn-primary">Guardar Cambios</button>
        </form>
        <a href="agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>

</body>
</html>
