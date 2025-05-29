<form method="post">
    Introdueix un número (1-10): <input type="number" name="num" min="1" max="10">
    <input type="submit" value="Mostrar taula">
</form>

<?php
if (isset($_POST["num"])) {
    $num = $_POST["num"];
    if ($num >= 1 && $num <= 10) {
        echo "<h3>Taula de multiplicar del $num</h3>";
        for ($i = 1; $i <= 10; $i++) {
            echo "$num x $i = " . ($num * $i) . "<br>";
        }
    } else {
        echo "Només es permeten números de l’1 al 10.";
    }
}
?>
