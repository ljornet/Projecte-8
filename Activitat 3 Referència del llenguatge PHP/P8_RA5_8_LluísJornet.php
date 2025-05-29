<?php
function factorial($num) {
    $fact = 1;
    for ($i = 1; $i <= $num; $i++) {
        $fact *= $i;
    }
    return $fact;
}

echo "El factorial de 5 és: " . factorial(5);
?>
