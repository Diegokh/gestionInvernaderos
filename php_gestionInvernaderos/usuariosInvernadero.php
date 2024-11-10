<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

$query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, i.idUsuario, u.nombreUsuario
FROM invernadero i
INNER JOIN usuarios u ON i.idUsuario = u.idUsuario;";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>AgroSmart</h1>

    <table>
    <tr>
            <th>ID Invernadero</th>
            <th>Ubicación</th>
            <th>ID Usuario</th>
            <th>Nombre Usuario</th>
    </tr>
    <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id_Invernadero']}</td>
                        <td>{$row['ubicacionInvernadero']}</td>
                        <td>{$row['idUsuario']}</td>
                        <td>{$row['nombreUsuario']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se han encontrado usuarios asociados a los invernaderos</td></tr>";
        }
        mysqli_close($dwes);
        ?>
    </table>
</body>
</html>
