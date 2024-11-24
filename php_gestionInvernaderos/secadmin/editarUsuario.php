<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";
$dwes = mysqli_connect($server, $user, $pass, $base);

if (isset($_GET['idUsuario'])) {
    $id = $_GET['idUsuario'];

    // Obtenengo los datos del usuario
    $query_user = "SELECT * FROM usuarios WHERE idUsuario = $id";
    $result_user = mysqli_query($dwes, $query_user);
    $user = mysqli_fetch_assoc($result_user);
}

if (isset($_POST['edit_user'])) {
    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombreUsuario'];
    $apellido = $_POST['apellidoUsuario'];
    $email = $_POST['emailUsuario'];
    $password = $_POST['passwordUsuario'];
    $telefono = $_POST['telefonoUsuario'];

    $query_update = "UPDATE usuarios SET nombreUsuario='$nombre', apellidoUsuario='$apellido', emailUsuario='$email', passwordUsuario='$password', telefonoUsuario='$telefono' WHERE idUsuario=$id";
    mysqli_query($dwes, $query_update);
    header("Location: gestionUsuario.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuario</h1>

        <form method="post" action="">
            <input type="hidden" name="idUsuario" value="<?php echo $user['idUsuario']; ?>">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre:</label>
                <input type="text" name="nombreUsuario" class="form-control" value="<?php echo $user['nombreUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidoUsuario" class="form-label">Apellido:</label>
                <input type="text" name="apellidoUsuario" class="form-control" value="<?php echo $user['apellidoUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email:</label>
                <input type="email" name="emailUsuario" class="form-control" value="<?php echo $user['emailUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="passwordUsuario" class="form-label">Contraseña:</label>
                <input type="text" name="passwordUsuario" class="form-control" value="<?php echo $user['passwordUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefonoUsuario" class="form-label">Teléfono:</label>
                <input type="text" name="telefonoUsuario" class="form-control" value="<?php echo $user['telefonoUsuario']; ?>" required>
            </div>
            <button type="submit" name="edit_user" class="btn btn-primary">Guardar Cambios</button>
        </form>
        <a href="../agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
