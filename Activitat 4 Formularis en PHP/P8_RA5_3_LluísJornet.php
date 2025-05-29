<form method="post">
    Nom: <input type="text" name="nom"><br>
    Correu electrònic: <input type="email" name="email"><br>
    Missatge: <textarea name="missatge"></textarea><br>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $missatge = $_POST["missatge"];

    if (empty($nom) || empty($email) || empty($missatge)) {
        echo "<p style='color:red;'>Tots els camps són obligatoris.</p>";
    } else {
        echo "<p>Nom: $nom</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Missatge: $missatge</p>";
    }
}
?>