<?php
$nom = $email = $missatge = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $missatge = $_POST["missatge"];

    if (empty($nom)) $errors[] = "El nom és obligatori.";
    if (empty($email)) $errors[] = "El correu és obligatori.";
    if (empty($missatge)) $errors[] = "El missatge és obligatori.";
}
?>

<form method="post">
    Nom: <input type="text" name="nom" value="<?= htmlspecialchars($nom) ?>"><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
    Missatge: <textarea name="missatge"><?= htmlspecialchars($missatge) ?></textarea><br>
    <input type="submit" value="Enviar">
</form>

<?php
foreach ($errors as $error) {
    echo "<p style='color:red;'>$error</p>";
}
?>