<?php
session_start();

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$conn = mysqli_connect($server, $user, $pass, $base);

if (!isset($_SESSION['idUsuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

$idUsuario = $_SESSION['idUsuario'];

$sql = "
    SELECT 
        hc.idHistorial, 
        hc.accionHistorial, 
        hc.fechaHistorial, 
        hc.horaHistorial, 
        dc.tipo_Dispositivo, 
        inv.ubicacionInvernadero
    FROM 
        historial_control hc
    JOIN 
        invernadero inv ON hc.id_Invernadero = inv.id_Invernadero
    JOIN 
        dispositivos_control dc ON hc.id_Dispositivo = dc.id_Dispositivo
    WHERE 
        inv.idUsuario = ?
    ORDER BY 
        hc.fechaHistorial DESC, hc.horaHistorial DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Acción</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Dispositivo</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['idHistorial'] . "</td>";
                echo "<td>" . ($row['accionHistorial'] == 1 ? 'Encendido' : 'Apagado') . "</td>";
                echo "<td>" . $row['fechaHistorial'] . "</td>";
                echo "<td>" . $row['horaHistorial'] . "</td>";
                echo "<td>" . $row['tipo_Dispositivo'] . "</td>";
                echo "<td>" . $row['ubicacionInvernadero'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>No hay ningun registro.</div>";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
        
        <a href="../agrosmart_estandar.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
