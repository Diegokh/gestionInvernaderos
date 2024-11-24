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

// Muestro los usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestionar Usuarios</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Teléfono</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
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
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                                <td>
                                    <form method='get' action='editarUsuario.php' style='display:inline-block;'>
                                        <input type='hidden' name='idUsuario' value='{$row['idUsuario']}'>
                                        <input type='submit' value='Editar' class='btn btn-primary'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No se han encontrado usuarios</td></tr>";
                }
                mysqli_close($dwes);
                ?>
            </tbody>
        </table>

        <!-- Formulario agregar usuario -->
        <h2 class="mb-3">Agregar Usuario</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre Usuario:</label>
                <input type="text" name="nombreUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellidoUsuario" class="form-label">Apellido Usuario:</label>
                <input type="text" name="apellidoUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email Usuario:</label>
                <input type="email" name="emailUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="passwordUsuario" class="form-label">Password Usuario:</label>
                <input type="password" name="passwordUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefonoUsuario" class="form-label">Teléfono Usuario:</label>
                <input type="text" name="telefonoUsuario" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success">Agregar Usuario</button>
        </form>
        <a href="agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
