<?php
// Connexió a la base de dades
$host = "localhost";
$user = "root";
$password = "";
$bd = "biblioteca";

$connexio = new mysqli($host, $user, $password, $bd);
if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}

$paraula = '';
if (isset($_GET['paraula'])) {
    $paraula = $connexio->real_escape_string($_GET['paraula']);
}

if ($paraula != '') {
    $sql = "SELECT * FROM llibres WHERE `Nom Llibre` LIKE '%$paraula%'";
} else {
    $sql = "SELECT * FROM llibres";
}

$resultat = $connexio->query($sql);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Cerca de Llibres</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            width: 300px;
            margin: 30px auto;
            text-align: center;
        }
        input[type="text"] {
            width: 80%;
            padding: 6px;
        }
        input[type="submit"] {
            padding: 6px 12px;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Cerca llibres per títol</h2>

<form method="get" action="">
    <input type="text" name="paraula" placeholder="Paraula clau al títol" value="<?= htmlspecialchars($paraula) ?>">
    <input type="submit" value="Cercar">
</form>

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
        echo "<tr><td colspan='4'>No s'han trobat llibres</td></tr>";
    }

    $connexio->close();
    ?>
</table>

</body>
</html>