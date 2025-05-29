<?php
$nom = "Lluís Jornet";
$data = date("d/m/Y");
$missatge = "Benvingut a la meva targeta personal!";
$imatge = "https://i.imgur.com/Yz84fEs.jpeg"; // pots posar una altra URL o pujar una imatge local
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Targeta personal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .targeta {
            background-color: white;
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        .imatge {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="targeta">
    <img src="<?php echo $imatge; ?>" class="imatge" alt="Foto personal">
    <h2><?php echo $nom; ?></h2>
    <p><?php echo $missatge; ?></p>
    <p>Data d’avui: <?php echo $data; ?></p>
</div>

</body>
</html>
