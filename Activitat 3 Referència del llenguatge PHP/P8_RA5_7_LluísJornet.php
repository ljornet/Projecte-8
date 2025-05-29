<?php
function calcularIVA($preu, $iva) {
    return $preu + ($preu * $iva / 100);
}

$preu = 100;
$iva = 21;
$total = calcularIVA($preu, $iva);

echo "Preu amb IVA: $total €";
?>
