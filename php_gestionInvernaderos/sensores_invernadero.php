<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

$query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, s.idSensor, s.tipo_sensor
    FROM invernadero i
    INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
    INNER JOIN sensores s ON si.idSensor = s.idSensor;";
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
        <th>ID Invernadero:</th>
        <th>ID Sensor:</th>
        <th>Ubicacion:</th>
        <th>Tipo Sensor:</th>
    </tr>
    <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id_Invernadero']}</td>
                        <td>{$row['idSensor']}</td>
                        <td>{$row['ubicacionInvernadero']}</td>
                        <td>{$row['tipo_sensor']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se han encontrado sensores en invernaderos</td></tr>";
        }
        mysqli_close($dwes);
        ?>
    </table>
</body>
</html>
