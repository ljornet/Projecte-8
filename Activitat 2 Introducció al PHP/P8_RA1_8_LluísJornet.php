<?php
$a = 5;
$b = 10;

echo "Abans de l'intercanvi:<br>";
echo "a = $a<br>";
echo "b = $b<br>";

// Intercanvi
$temp = $a;
$a = $b;
$b = $temp;

echo "<br>Després de l'intercanvi:<br>";
echo "a = $a<br>";
echo "b = $b<br>";
?>