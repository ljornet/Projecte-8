<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "biblioteca";

$connexio = new mysqli($host, $user, $password, $bd);

if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $connexio->prepare("DELETE FROM llibres WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $connexio->close();
        header("Location: P8_RA6_9_LluísJornet.php?eliminat=1");
        exit();
    } else {
        echo "Error eliminant el llibre: " . $connexio->error;
    }
} else {
    echo "ID no vàlid.";
}
?>