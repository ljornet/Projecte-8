<form method="post">
    Introdueix la teva edat: <input type="number" name="edat">
    <input type="submit" value="Comprova">
</form>

<?php
if (isset($_POST["edat"])) {
    $edat = $_POST["edat"];
    if ($edat >= 18) {
        echo "Ets major d'edat.";
    } else {
        echo "Ets menor d'edat.";
    }
}
?>
