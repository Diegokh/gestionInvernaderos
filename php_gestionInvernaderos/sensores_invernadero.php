<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";


$dwes = mysqli_connect($server, $user, $pass, $base);

$query = "SELECT i.id_Invernadero, s.idSensor, s.Ubicacion 
          FROM sensores_inver s 
          JOIN invernadero i ON s.id_Invernadero = i.id_Invernadero";
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
    </tr>
    <?php
        if ($consulta && mysqli_num_rows($consulta) > 0) {
            while ($row = mysqli_fetch_assoc($consulta)) {
                echo "<tr>
                        <td>{$row['id_Invernadero']}</td>
                        <td>{$row['idSensor']}</td>
                        <td>{$row['Ubicacion']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se han encontrado sensores en invernaderos</td></tr>";
        }
        mysqli_close($dwes);
        ?>


    </table>
</body>
</html>