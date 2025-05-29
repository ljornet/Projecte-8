<form method="post">
    Aficions:<br>
    <input type="checkbox" name="aficions[]" value="Música"> Música<br>
    <input type="checkbox" name="aficions[]" value="Esport"> Esport<br>
    <input type="checkbox" name="aficions[]" value="Lectura"> Lectura<br>
    <input type="checkbox" name="aficions[]" value="Videojocs"> Videojocs<br>
    <input type="submit" value="Enviar">
</form>

<?php
if (!empty($_POST['aficions'])) {
    echo "<ul>";
    foreach ($_POST['aficions'] as $aficio) {
        echo "<li>" . htmlspecialchars($aficio) . "</li>";
    }
    echo "</ul>";
}
?>
