<?php
echo "<h1>Hola món!</h1>";

$host = 'db';
$user = 'ljornet';
$pass = 'ljornet';
$db = 'exemple';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de connexió: " . mysqli_connect_error());
}

echo "<p>Connexió a la base de dades feta amb èxit!</p>";
?>
