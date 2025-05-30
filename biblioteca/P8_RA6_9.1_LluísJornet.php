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

// Agafem l'id per GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID invàlid.");
}

// Si s'envia el formulari per actualitzar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = $_POST["titol"];
    $autor = $_POST["autor"];
    $any = $_POST["any"];

    // Prepared statement per actualitzar
    $stmt = $connexio->prepare("UPDATE llibres SET `Nom Llibre` = ?, `Autor` = ?, `Any` = ? WHERE id = ?");
    $stmt->bind_param("ssii", $titol, $autor, $any, $id);

    if ($stmt->execute()) {
        echo "<p style='text-align:center;color:green;'>Llibre actualitzat correctament.</p>";
    } else {
        echo "<p style='text-align:center;color:red;'>Error actualitzant el llibre.</p>";
    }

    $stmt->close();
}

// Consulta per agafar les dades actuals del llibre
$stmt = $connexio->prepare("SELECT `Nom Llibre`, `Autor`, `Any` FROM llibres WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($titol, $autor, $any);
if (!$stmt->fetch()) {
    die("No s'ha trobat el llibre.");
}
$stmt->close();
$connexio->close();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Llibre</title>
    <style>
        form {
            width: 300px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #aaa;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 7px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background-color: #007BFF;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 3px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="" method="post">
    <h2 style="text-align:center;">Editar Llibre</h2>

    <label for="titol">Títol:</label>
    <input type="text" id="titol" name="titol" value="<?php echo htmlspecialchars($titol); ?>" required>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($autor); ?>" required>

    <label for="any">Any:</label>
    <input type="number" id="any" name="any" value="<?php echo $any; ?>" required>

    <input type="submit" value="Actualitzar llibre">
</form>

<a href="P8_RA6_9_LluísJornet.php">Tornar al llistat</a>

</body>
</html>