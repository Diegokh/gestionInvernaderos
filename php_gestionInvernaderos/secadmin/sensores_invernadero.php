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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>AgroSmart</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">AgroSmart</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>ID Sensor</th>
                    <th>Ubicación</th>
                    <th>Tipo de Sensor</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
        <a href="agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
