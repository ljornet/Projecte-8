<form method="post">
    Correu electrònic: <input type="text" name="email">
    <input type="submit" value="Validar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Correu vàlid: $email</p>";
    } else {
        echo "<p style='color:red;'>Format de correu no vàlid.</p>";
    }
}
?>