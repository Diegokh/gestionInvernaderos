<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

// Consulta para obtener las notificaciones de alerta, usuarios e invernaderos
$query = "SELECT 
    a.tipoAlerta,                            
    a.descripcionAlerta,                     
    na.fechaNotificacion,                    
    na.horaNotificacion,                    
    u.nombreUsuario,                         
    u.apellidoUsuario AS apellidosUsuario,        
    i.id_Invernadero AS Invernadero_Afectado         
FROM 
    notificacionAlertaUsuario na
JOIN 
    usuarios u ON na.idUsuario = u.idUsuario    
JOIN 
    alertas a ON na.idAlerta = a.idAlerta    
JOIN 
    invernadero i ON na.id_Invernadero = i.id_Invernadero;";
$result = mysqli_query($dwes, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones de Alertas</title>
</head>
<body>
    <h1>Notificaciones de Alertas</h1>

    <table border="1">
        <tr>
            <th>Tipo de Alerta</th>
            <th>Descripción de la Alerta</th>
            <th>Fecha de Notificación</th>
            <th>Hora de Notificación</th>
            <th>Nombre de Usuario</th>
            <th>Apellidos del Usuario</th>
            <th>ID Invernadero Afectado</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['tipoAlerta']}</td>
                        <td>{$row['descripcionAlerta']}</td>
                        <td>{$row['fechaNotificacion']}</td>
                        <td>{$row['horaNotificacion']}</td>
                        <td>{$row['nombreUsuario']}</td>
                        <td>{$row['apellidosUsuario']}</td>
                        <td>{$row['Invernadero_Afectado']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se han encontrado notificaciones de alertas</td></tr>";
        }
        // Cerrar la conexión con la base de datos
        mysqli_close($dwes);
        ?>
    </table>
</body>
</html>
