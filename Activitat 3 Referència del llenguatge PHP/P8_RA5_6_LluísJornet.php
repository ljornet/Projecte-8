<?php
$alumnes = [
    "Anna" => 17,
    "Marc" => 18,
    "Joan" => 20,
    "Clara" => 16,
    "Lluís" => 19
];

foreach ($alumnes as $nom => $edat) {
    if ($edat >= 18) {
        echo "$nom és major d'edat ($edat anys)<br>";
    }
}
?>
