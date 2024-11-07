<?php
if(isset($_REQUEST['email'])){
    $email = $_REQUEST['email'];
}


if(isset($_REQUEST['passw'])){
    $passw = $_REQUEST['passw'];
}


$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";


$dwes = mysqli_connect($server, $user, $pass, $base);


$sql = "SELECT * FROM usuarios where emailUsuario ='$email' and passwordUsuario='$passw' ";
$resultado = $dwes ->query($sql);
$dwes->close();


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
    <h2>Inicio de Sesión</h2>
    <form action="index.php" method="post">
        <label  for="email">Email:</label>
        <input type="text" name="email">
        <label for="passw">Contraseña:</label>
        <input type="password" name="passw">
        <button type="submit">Iniciar Sesion</button>
    </form>

</body>
</html>