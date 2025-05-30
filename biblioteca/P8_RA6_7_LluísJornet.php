<?php
// Connexió a la base de dades
$host = "localhost";
$user = "root";
$password = "";
$bd = "biblioteca";

// Crear connexió
$connexio = new mysqli($host, $user, $password, $bd);

// Comprovar connexió
if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}

// Consulta per obtenir tots els llibres ordenats per any descendent
$sql = "SELECT * FROM llibres ORDER BY `Any` DESC";
$resultat = $connexio->query($sql);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llibres de la Biblioteca</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 30px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Llibres disponibles</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom Llibre</th>
        <th>Autor</th>
        <th>Any</th>
    </tr>

    <?php
    if ($resultat->num_rows > 0) {
        while ($fila = $resultat->fetch_assoc()) {
            echo "<tr>
                    <td>" . $fila["id"] . "</td>
                    <td>" . $fila["Nom Llibre"] . "</td>
                    <td>" . $fila["Autor"] . "</td>
                    <td>" . $fila["Any"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hi ha llibres</td></tr>";
    }

    $connexio->close();
    ?>
</table>

</body>
</html>