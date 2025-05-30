<?php
// Connexió
$connexio = new mysqli("localhost", "root", "", "usuaris");
if ($connexio->connect_error) die("Error de connexió: " . $connexio->connect_error);

// Afegir o editar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $id = isset($_POST["id"]) ? $_POST["id"] : '';

    if (!empty($nom) && !empty($email)) {
        if (empty($id)) {
            $stmt = $connexio->prepare("INSERT INTO clients (nom, email) VALUES (?, ?)");
            $stmt->bind_param("ss", $nom, $email);
        } else {
            $stmt = $connexio->prepare("UPDATE clients SET nom = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nom, $email, $id);
        }
        $stmt->execute();
        $stmt->close();
    }
}

// Llistar
$clients = $connexio->query("SELECT * FROM clients");
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Gestió de clients</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        table { margin: auto; border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #888; padding: 8px; }
        th { background-color: #eee; }
        input[type="text"], input[type="email"] { width: 80%; padding: 6px; }
    </style>
</head>
<body>

<h2>Gestió de clients</h2>

<form method="post" style="margin-bottom: 30px;">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" value="Afegir">
</form>

<table>
    <tr><th>ID</th><th>Nom</th><th>Email</th></tr>
    <?php while ($fila = $clients->fetch_assoc()): ?>
        <tr>
            <td><?= $fila["ID"] ?></td>
            <td><?= $fila["Nom"] ?></td>
            <td><?= $fila["Email"] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>