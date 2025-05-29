<?php
$notes = [5, 7, 8, 6, 4];
$mitjana = array_sum($notes) / count($notes);

echo "Nota mitjana: $mitjana<br>";

if ($mitjana >= 5) {
    echo "Estàs aprovat!";
} else {
    echo "Estàs suspès.";
}
?>