<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .img-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 15rem;
            margin-top: 3rem;
        }

        .img {
            max-width: 100%;
            max-height: 100%;
        }

        footer{
            align-items: center;
        }
    </style>
</head>


<body>
    <header class="container">
        <h1>AgroSmart</h1>
    </header>

    <div class="container mt-4">
        <div class="list-group">
            <a href="./secestandar/sensores_invernadero.php" class="list-group-item list-group-item-action">Consultar Sensores en invernadero</a>
            <a href="./secestandar/historialControl.php" class="list-group-item list-group-item-action">Consultar Historial de control</a>
            <a href="./secestandar/alertas.php" class="list-group-item list-group-item-action">Consultar Alertas</a>
            <!--<a href="#">Consultar Lecturas de sensores</a>-->
        </div>
    </div>

    <div class="img-container">
        <img class="img" src="/img/logo.png" alt="Logo de AgroSmart">
    </div>

</body>
<footer>
    <p>All Rights Reserved Diego Inc.©</p>
</footer>
</html>

