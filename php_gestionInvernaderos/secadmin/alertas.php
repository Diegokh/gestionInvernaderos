<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);
// Eliminar alerta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idUsuario = $_POST['idAlerta'];
    $deleteQuery = "DELETE FROM alertas WHERE idAlerta = $idAlerta";
    mysqli_query($dwes, $deleteQuery);
   header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Consulta para obtener las notificaciones de alerta
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Notificaciones de Alertas</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Notificaciones de Alertas</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tipo de Alerta</th>
                    <th>Descripción de la Alerta</th>
                    <th>Fecha de Notificación</th>
                    <th>Hora de Notificación</th>
                    <th>Nombre de Usuario</th>
                    <th>Apellidos del Usuario</th>
                    <th>ID Invernadero Afectado</th>
                    <th>Eliminar</th>

                </tr>
            </thead>
            <tbody>
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

                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='idAlerta'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No se han encontrado notificaciones de alertas</td></tr>";
                }
                mysqli_close($dwes);
                ?>
            </tbody>
        </table>
        <a href="../agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
