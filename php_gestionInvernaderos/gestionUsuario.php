<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idUsuario = $_POST['idUsuario'];
    $deleteQuery = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";
    mysqli_query($dwes, $deleteQuery);
   header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Añadir usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombreUsuario'];
    $apellido = $_POST['apellidoUsuario'];
    $email = $_POST['emailUsuario'];
    $password = $_POST['passwordUsuario'];
    $telefono = $_POST['telefonoUsuario'];

    $addQuery = "INSERT INTO usuarios (nombreUsuario, apellidoUsuario, emailUsuario, passwordUsuario, telefonoUsuario) 
                 VALUES ('$nombre', '$apellido', '$email', '$password', '$telefono')";
    mysqli_query($dwes, $addQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Mostrar usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
</head>
<body>
    <h1>Gestionar Usuarios</h1>

    <table border="1">
        <tr>
            <th>idUsuario</th>
            <th>nombreUsuario</th>
            <th>apellidoUsuario</th>
            <th>emailUsuario</th>
            <th>passwordUsuario</th>
            <th>telefonoUsuario</th>
            <th>Eliminar</th>
            <th>Editar</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['idUsuario']}</td>
                        <td>{$row['nombreUsuario']}</td>
                        <td>{$row['apellidoUsuario']}</td>
                        <td>{$row['emailUsuario']}</td>
                        <td>{$row['passwordUsuario']}</td>
                        <td>{$row['telefonoUsuario']}</td>
                        <td>
                            <form method='POST' style='display:inline-block;'>
                                <input type='hidden' name='idUsuario' value='{$row['idUsuario']}'>
                                <input type='submit' name='delete' value='Eliminar'>
                            </form>
                        </td>

                        <td>
                        <form method='get' action='editarUsuario.php' style='display:inline-block;'>
                                <input type='hidden' name='idUsuario' value='{$row['idUsuario']}'>
                                <input type='submit' value='Editar'>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se han encontrado Usuarios</td></tr>";
        }
        mysqli_close($dwes);
        ?>
    </table>

    <!-- Formulario agregar usuario -->
    <h2>Agregar Usuario</h2>
    <form method="POST">
        <label>Nombre Usuario:</label>
        <input type="text" name="nombreUsuario" required><br>
        <label>Apellido Usuario:</label>
        <input type="text" name="apellidoUsuario" required><br>
        <label>Email Usuario:</label>
        <input type="email" name="emailUsuario" required><br>
        <label>Password Usuario:</label>
        <input type="password" name="passwordUsuario" required><br>
        <label>Teléfono Usuario:</label>
        <input type="text" name="telefonoUsuario" required><br>
        <input type="submit" name="add" value="Agregar Usuario">
    </form>
</body>
</html>
