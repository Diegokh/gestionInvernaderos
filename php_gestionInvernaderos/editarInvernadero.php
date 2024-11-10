<?php
$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";
$dwes = mysqli_connect($server, $user, $pass, $base);

if (isset($_GET['id_Invernadero'])) {
    $id = $_GET['id_Invernadero'];

    // Obtener los datos del invernadero
    $query_invernadero = "SELECT * FROM invernadero WHERE id_Invernadero = $id";
    $result_invernadero = mysqli_query($dwes, $query_invernadero);
    $invernadero = mysqli_fetch_assoc($result_invernadero);
}

if (isset($_POST['editar_invernadero'])) {
    $id = $_POST['id_Invernadero'];
    $ubicacionInvernadero = $_POST['ubicacionInvernadero'];
    $idUsuario = intval($_POST['idUsuario']);  // Asegúrate de que idUsuario es un número

    // Actualizar los datos del invernadero
    $query_update = "UPDATE invernadero SET ubicacionInvernadero = '$ubicacionInvernadero', idUsuario = '$idUsuario' WHERE id_Invernadero = '$id'";
    mysqli_query($dwes, $query_update);

    // Redirigir después de actualizar
    header("Location: gestionInvernaderos.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Invernadero</title>
</head>
<body>
    <h1>Editar Invernadero</h1>

    <form method="post" action="">
        <input type="hidden" name="id_Invernadero" value="<?php echo $invernadero['id_Invernadero']; ?>">
        <label for="ubicacionInvernadero">Ubicación del invernadero:</label>
        <input type="text" name="ubicacionInvernadero" value="<?php echo $invernadero['ubicacionInvernadero']; ?>" required><br>

        <label for="idUsuario">ID del dueño:</label>
        <input type="text" name="idUsuario" value="<?php echo $invernadero['idUsuario']; ?>" required><br>

        <input type="submit" name="editar_invernadero" value="Guardar Cambios">
    </form>

</body>
</html>
