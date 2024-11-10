<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

// Eliminar Invernadero
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_Invernadero = $_POST['id_Invernadero'];
    $deleteQuery = "DELETE FROM invernadero WHERE id_Invernadero = $id_Invernadero";
    mysqli_query($dwes, $deleteQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Añadir Invernadero
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $ubicacionInvernadero = $_POST['ubicacionInvernadero'];
    $idUsuario = $_POST['idUsuario'];
    
    $addQuery = "INSERT INTO invernadero (ubicacionInvernadero, idUsuario)
                 VALUES ('$ubicacionInvernadero', $idUsuario)";
    mysqli_query($dwes, $addQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Muestro Invernaderos
$query = "SELECT * FROM invernadero";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestionar Invernaderos</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestionar Invernaderos</h1>
        
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>Ubicación</th>
                    <th>ID Usuario</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id_Invernadero']}</td>
                                <td>{$row['ubicacionInvernadero']}</td>
                                <td>{$row['idUsuario']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='id_Invernadero' value='{$row['id_Invernadero']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                                <td>
                                    <form method='get' action='editarInvernadero.php' style='display:inline-block;'>
                                        <input type='hidden' name='id_Invernadero' value='{$row['id_Invernadero']}'>
                                        <input type='submit' value='Editar' class='btn btn-primary'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No se han encontrado Invernaderos</td></tr>";
                }
                mysqli_close($dwes);
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar Invernadero -->
        <h2>Agregar Invernadero</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="ubicacionInvernadero" class="form-label">Ubicación del invernadero:</label>
                <input type="text" name="ubicacionInvernadero" id="ubicacionInvernadero" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID del usuario:</label>
                <input type="text" name="idUsuario" id="idUsuario" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success">Agregar Invernadero</button>
        </form>
        <a href="agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
