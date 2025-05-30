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
        $stmt->bind_param("sss", $titol, $autor, $any);
        $stmt->execute();
        $stmt->close();
        $missatge = "Llibre afegit correctament.";
    } else {
        $missatge = "Tots els camps són obligatoris.";
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
            background: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .missatge {
            text-align: center;
            margin-top: 15px;
            color: #444;
        }
    </style>
</head>
<body>

<h2>Afegir un nou llibre</h2>

<form action="" method="post">
    <label for="titol">Títol:</label>
    <input type="text" name="titol" id="titol" required>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" id="autor" required>

    <label for="any">Any:</label>
    <input type="number" name="any" id="any" required>

    <input type="submit" value="Afegir llibre">
</form>

<?php if ($missatge): ?>
    <div class="missatge"><?= $missatge ?></div>
<?php endif; ?>

</body>
</html>