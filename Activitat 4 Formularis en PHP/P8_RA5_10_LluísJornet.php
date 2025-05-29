<?php
$errors = [];
$nom = $email = $assumpte = $missatge = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $assumpte = $_POST["assumpte"];
    $missatge = $_POST["missatge"];

    if (empty($nom)) $errors[] = "El nom és obligatori.";
    if (empty($email)) $errors[] = "El correu electrònic és obligatori.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "El correu no és vàlid.";
    if (empty($assumpte)) $errors[] = "L'assumpte és obligatori.";
    if (empty($missatge)) $errors[] = "El missatge és obligatori.";
}
?>

<form method="post">
    Nom: <input type="text" name="nom" value="<?= htmlspecialchars($nom) ?>"><br>
    Correu electrònic: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
    Assumpte: <input type="text" name="assumpte" value="<?= htmlspecialchars($assumpte) ?>"><br>
    Missatge:<br><textarea name="missatge"><?= htmlspecialchars($missatge) ?></textarea><br>
    <input type="submit" value="Enviar">
</form>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p style='color:green;'>Missatge enviat correctament!</p>";
}
?>