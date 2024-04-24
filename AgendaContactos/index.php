<!DOCTYPE html>
<html lang="es">
<head>
    <title>Agenda de contactos web</title>
    <link rel="icon" type="image/jpg" href="public/img/favicon.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center; /* Centra los elementos en la barra */
            align-items: center;
            padding: 10px 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px; /* Aumenta el área de clic, mejor accesibilidad */
        }
        .navbar a:hover {
            background-color: #0056b3; /* Efecto hover para mejorar la interactividad */
            border-radius: 5px;
        }
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .jumbotron {
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin-top: 20px;
            padding: 10px;
        }
        .img-fluid {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Inicio</a>
        <a href="contactos.php">Contactos</a>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Agenda de contactos con PHP y MySQL</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="public/img/FotoPerf.jpg" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>Agenda desarrollada en el año 2024</th>
                                </tr>
                                <tr>
                                    <th>Hecha por Facultad autodidacta y modificada por Julian Nunez para eliminar el uso de frameworks</th>
                                </tr>
                                <tr>
                                    <th>Hecho con php y mysql</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <p>Agenda de contactos con php y mysql By Facultad Autodidacta & Julian Nunez</p>
        </div>
    </div>
</body>
</html>
