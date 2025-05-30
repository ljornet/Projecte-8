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

$resultat = null;
$missatge = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $autor_buscar = trim($_POST["autor"]);

    if (empty($autor_buscar)) {
        $missatge = "<p style='color:red; text-align:center;'>Introdueix un autor per cercar.</p>";
    } else {
        // Consulta preparada per evitar injeccions SQL
        $stmt = $connexio->prepare("SELECT * FROM llibres WHERE `Autor` LIKE ?");
        $param = "%".$autor_buscar."%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $resultat = $stmt->get_result();

        if ($resultat->num_rows == 0) {
            $missatge = "<p style='color:orange; text-align:center;'>No s'han trobat llibres per aquest autor.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Cerca de llibres per autor</title>
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
    </style>
</head>
<body>

<h2 style="text-align:center;">Cerca llibres per autor</h2>

<form method="post" action="">
    <input type="text" name="autor" placeholder="Nom autor" value="<?= isset($autor_buscar) ? htmlspecialchars($autor_buscar) : '' ?>" required>
    <input type="submit" value="Cercar">
</form>

<?= $missatge ?>

<?php if ($resultat && $resultat->num_rows > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Nom Llibre</th>
        <th>Autor</th>
        <th>Any</th>
    </tr>
    <?php while($fila = $resultat->fetch_assoc()): ?>
    <tr>
        <td><?= $fila["id"] ?></td>
        <td><?= htmlspecialchars($fila["Nom Llibre"]) ?></td>
        <td><?= htmlspecialchars($fila["Autor"]) ?></td>
        <td><?= $fila["Any"] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php endif; ?>

</body>
</html>