<form method="post">
    Introdueix el teu nom: <input type="text" name="nom">
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nom"])) {
    $nom = htmlspecialchars($_POST["nom"]);
    echo "<p>Benvingut/da, $nom!</p>";
}
?>
