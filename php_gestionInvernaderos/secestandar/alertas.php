<?php
session_start();

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

// Conexión a la base de datos
$dwes = mysqli_connect($server, $user, $pass, $base);

if (!$dwes) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

// Obtener el ID del usuario logueado
$idUsuario = $_SESSION['idUsuario'];

// Eliminar alerta si se recibe el ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idAlerta = $_POST['idAlerta'];
    $deleteQuery = "DELETE FROM alertas WHERE idAlerta = ? AND idUsuario = ?";
    $stmt = mysqli_prepare($dwes, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "ii", $idAlerta, $idUsuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Consulta para obtener las alertas del usuario
$query = "
    SELECT 
        a.idAlerta,
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
        invernadero i ON na.id_Invernadero = i.id_Invernadero
    WHERE
        na.idUsuario = ?"; // Filtramos por el usuario logueado

$stmt = mysqli_prepare($dwes, $query);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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
                                        <input type='hidden' name='idAlerta' value='{$row['idAlerta']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No se han encontrado notificaciones de alertas</td></tr>";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($dwes);
                ?>
            </tbody>
        </table>
        <a href="../agrosmart_estandar.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>

</body>
</html>
