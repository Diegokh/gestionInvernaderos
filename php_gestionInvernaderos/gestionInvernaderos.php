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

// Mostrar Invernaderos
$query = "SELECT * FROM invernadero";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Invernaderos</title>
</head>
<body>
    
    <h1>Gestionar Invernaderos</h1>
    
    <table border="1">
        <tr>
            <th>ID Invernadero</th>
            <th>Ubicación</th>
            <th>ID Usuario</th>
            <th>Eliminar</th>
            <th>Editar</th>
        </tr>

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
                                <input type='submit' name='delete' value='Eliminar'>
                            </form>
                        </td>
                        <td>
                            <form method='get' action='editarInvernadero.php' style='display:inline-block;'>
                                <input type='hidden' name='id_Invernadero' value='{$row['id_Invernadero']}'>
                                <input type='submit' value='Editar'>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se han encontrado Invernaderos</td></tr>";
        }
        mysqli_close($dwes);
        ?>
    </table>

    <!-- Formulario para agregar Invernadero -->
    <h2>Agregar Invernadero</h2>
    <form method="POST">
        <label>Ubicación del invernadero:</label>
        <input type="text" name="ubicacionInvernadero" required><br>
        <label>ID del usuario:</label>
        <input type="text" name="idUsuario" required><br>
        <input type="submit" name="add" value="Agregar Invernadero">
    </form>

</body>
</html>
