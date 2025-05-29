<form method="get">
    Nom: <input type="text" name="nom"><br>
    Edat: <input type="number" name="edat"><br>
    <input type="submit" value="Enviar">
</form>

<?php
if (isset($_GET["nom"]) && isset($_GET["edat"])) {
    $nom = htmlspecialchars($_GET["nom"]);
    $edat = (int)$_GET["edat"];
    echo "<p>Hola $nom, tens $edat anys.</p>";
}
?>