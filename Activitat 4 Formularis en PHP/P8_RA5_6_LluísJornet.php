<form method="post">
    Ciutat d'origen:
    <select name="ciutat">
        <option value="Barcelona">Barcelona</option>
        <option value="Tarragona">Tarragona</option>
        <option value="Lleida">Lleida</option>
        <option value="Girona">Girona</option>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php
if (isset($_POST["ciutat"])) {
    echo "<p>Has triat: " . htmlspecialchars($_POST["ciutat"]) . "</p>";
}
?>