<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "biblioteca";

$connexio = new mysqli($host, $user, $password, $bd);

// Comprovar connexió
if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = isset($_POST["titol"]) ? $_POST["titol"] : null;
    $autor = isset($_POST["autor"]) ? $_POST["autor"] : null;
    $any = isset($_POST["any"]) ? $_POST["any"] : null;

    // Prepara la consulta amb placeholders
    $sql = "INSERT INTO llibres (`Nom Llibre`, `Autor`, `Any`) VALUES (?, ?, ?)";
    $stmt = $connexio->prepare($sql);
    $stmt->bind_param("sss", $titol, $autor, $any);
    $stmt->execute();
    $stmt->close();
}

$connexio->close();
?>

<form action="" method="post">
    <label>Títol:</label><br>
    <input type="text" name="titol"><br><br>

    <label>Autor:</label><br>
    <input type="text" name="autor"><br><br>

    <label>Any:</label><br>
    <input type="number" name="any"><br><br>

    <input type="submit" value="Afegir llibre">
</form>
