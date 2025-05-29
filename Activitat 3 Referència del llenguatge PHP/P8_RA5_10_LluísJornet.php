<?php
$usuaris = [
    ["nom" => "Anna", "email" => "anna@example.com", "edat" => 17],
    ["nom" => "Marc", "email" => "marc@example.com", "edat" => 18],
    ["nom" => "Clara", "email" => "clara@example.com", "edat" => 22]
];

function esMajorEdat($edat) {
    return $edat >= 18 ? "Sí" : "No";
}
?>

<table border="1">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Edat</th>
        <th>Major d'edat?</th>
    </tr>
    <?php foreach ($usuaris as $usuari): ?>
    <tr>
        <td><?= $usuari["nom"] ?></td>
        <td><?= $usuari["email"] ?></td>
        <td><?= $usuari["edat"] ?></td>
        <td><?= esMajorEdat($usuari["edat"]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>