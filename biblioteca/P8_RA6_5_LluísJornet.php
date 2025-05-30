<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "biblioteca";

$connexio = new mysqli($host, $user, $password, $bd);
if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}

$missatge = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = trim($_POST["titol"]);
    $autor = trim($_POST["autor"]);
    $any = trim($_POST["any"]);

    if (!empty($titol) && !empty($autor) && !empty($any)) {
        $sql = "INSERT INTO llibres (`Nom Llibre`, `Autor`, `Any`) VALUES (?, ?, ?)";
        $stmt = $connexio->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $titol, $autor, $any);
            $stmt->execute();
            $stmt->close();
            $missatge = "<p style='color:green; text-align:center;'>Llibre afegit correctament.</p>";
        } else {
            $missatge = "<p style='color:red; text-align:center;'>Error en preparar la consulta.</p>";
        }
    } else {
        $missatge = "<p style='color:red; text-align:center;'>Tots els camps són obligatoris.</p>";
    }
}

$connexio->close();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir llibre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 350px;
            margin: 50px auto;
        }
        form {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 6px;
            margin: 6px 0 12px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Afegir un nou llibre</h2>

<form action="" method="post">
    <label>Títol:</label>
    <input type="text" name="titol" required>

    <label>Autor:</label>
    <input type="text" name="autor" required>

    <label>Any:</label>
    <input type="number" name="any" required>

    <input type="submit" value="Afegir llibre">
</form>

<?= $missatge ?>

</body>
</html>
