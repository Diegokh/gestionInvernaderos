<?php

$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";


$conn = mysqli_connect($server, $user, $pass, $base);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE emailUsuario = '$email' AND passwordUsuario = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['nombreUsuario'] = $user['nombreUsuario'];
        $_SESSION['rolUsuario'] = $user['rolUsuario'];
        
        if ($user['rolUsuario'] == 'Administrador') {
            header("Location: agrosmart.php");
        } else {
            header("Location: agrosmart_estandar.php");
        }
        exit();
    } else {
        $error = "Uusario erroneo";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AgroSmart</title>
</head>
<body>
    <h1>Inicio de sesión en AgroSmart</h1>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php if ($error): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
