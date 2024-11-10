<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

$query = "SELECT 
    h.idHistorial, 
    h.accionHistorial, 
    h.fechaHistorial, 
    h.horaHistorial, 
    d.tipo_Dispositivo, 
    CASE 
        WHEN h.accionHistorial = 1 THEN 'Encendido'
        WHEN h.accionHistorial = 2 THEN 'Apagado'
    END AS estado_Dispositivo
    FROM 
        historial_control h
    JOIN 
        dispositivos_control d ON h.id_Dispositivo = d.id_Dispositivo;

";
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
    <h1>Historial de Control de Dispositivos</h1>

    <table border="1">
        <tr>
            <th>ID Historial</th>
            <th>Acción</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo de Dispositivo</th>
            <th>Estado del Dispositivo</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['idHistorial']}</td>
                        <td>{$row['accionHistorial']}</td>
                        <td>{$row['fechaHistorial']}</td>
                        <td>{$row['horaHistorial']}</td>
                        <td>{$row['tipo_Dispositivo']}</td>
                        <td>{$row['estado_Dispositivo']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se ha encontrado historial de control</td></tr>";
        }
        // Cerrar la conexión con la base de datos
        mysqli_close($dwes);
        ?>
    </table>
</body>
</html>
