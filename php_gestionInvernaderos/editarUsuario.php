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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>

    <form method="post" action="">
        <input type="hidden" name="idUsuario" value="<?php echo $user['idUsuario']; ?>">
        <label for="nombreUsuario">Nombre:</label>
        <input type="text" name="nombreUsuario" value="<?php echo $user['nombreUsuario']; ?>" required><br>
        <label for="apellidoUsuario">Apellido:</label>
        <input type="text" name="apellidoUsuario" value="<?php echo $user['apellidoUsuario']; ?>" required><br>
        <label for="emailUsuario">Email:</label>
        <input type="email" name="emailUsuario" value="<?php echo $user['emailUsuario']; ?>" required><br>
        <label for="passwordUsuario">Contraseña:</label>
        <input type="text" name="passwordUsuario" value="<?php echo $user['passwordUsuario']; ?>" required><br>
        <label for="telefonoUsuario">Teléfono:</label>
        <input type="text" name="telefonoUsuario" value="<?php echo $user['telefonoUsuario']; ?>" required><br>
        <input type="submit" name="edit_user" value="Guardar Cambios">
    </form>
</body>
</html>
