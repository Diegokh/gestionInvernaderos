<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$dwes = mysqli_connect($server, $user, $pass, $base);

// Eliminar historial
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idUsuario = $_POST['idHistorial'];
    $deleteQuery = "DELETE FROM historial_control WHERE idHistorial = $idHistorial";
    mysqli_query($dwes, $deleteQuery);
   header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Control de Dispositivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Historial de Control de Dispositivos</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Historial</th>
                    <th>Acción</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo de Dispositivo</th>
                    <th>Estado del Dispositivo</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
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
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='idHistorial'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se ha encontrado historial de control</td></tr>";
                }
                mysqli_close($dwes);
                ?>
            </tbody>
        </table>
        <a href="../agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a> </div>

    </div>
</body>
</html>
