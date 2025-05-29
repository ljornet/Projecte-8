<form method="post">
    Introdueix un número: <input type="number" name="num">
    <input type="submit" value="Comprova">
</form>

<?php
if (isset($_POST["num"])) {
    $num = $_POST["num"];
    if ($num % 2 == 0) {
        echo "$num és parell.";
    } else {
        echo "$num és senar.";
    }
}
?>
