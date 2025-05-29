<form method="post">
    Comentari: <textarea name="comentari"></textarea><br>
    <input type="submit" value="Enviar">
</form>

<?php
if (isset($_POST["comentari"])) {
    $comentari = htmlspecialchars($_POST["comentari"]);
    echo "<p>Has escrit:</p><p>$comentari</p>";
}
?>