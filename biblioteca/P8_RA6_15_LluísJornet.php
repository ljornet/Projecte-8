<?php
// Connexió a la base de dades
$connexio = new mysqli("localhost", "root", "", "biblioteca");
if ($connexio->connect_error) die("Error de connexió: " . $connexio->connect_error);

// Afegir llibre
if (isset($_POST["afegir"])) {
    $titol = $_POST["titol"];
    $autor = $_POST["autor"];
    $any = $_POST["any"];
    if (!empty($titol) && !empty($autor) && !empty($any)) {
        $stmt = $connexio->prepare("INSERT INTO llibres (`Nom Llibre`, `Autor`, `Any`) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $titol, $autor, $any);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Eliminar llibre
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $connexio->query("DELETE FROM llibres WHERE `id` = $id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Editar llibre
if (isset($_POST["editar"])) {
    $id = $_POST["id"];
    $titol = $_POST["titol"];
    $autor = $_POST["autor"];
    $any = $_POST["any"];
    if (!empty($titol) && !empty($autor) && !empty($any)) {
        $stmt = $connexio->prepare("UPDATE llibres SET `Nom Llibre`=?, `Autor`=?, `Any`=? WHERE `id`=?");
        $stmt->bind_param("ssii", $titol, $autor, $any, $id);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Cerca per paraula clau
$filtre = "";
if (isset($_GET['buscar']) && !empty($_GET['paraula'])) {
    $paraula = $connexio->real_escape_string($_GET['paraula']);
    $filtre = "WHERE `Nom Llibre` LIKE '%$paraula%'";
}

$llibres = $connexio->query("SELECT * FROM llibres $filtre ORDER BY `id` DESC");
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Gestió de Llibres</title>
    <style>
        body { font-family: sans-serif; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; }
        .seccio { display: none; }
        .actiu { display: block; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
    </style>
    <script>
        function mostrar(seccio) {
            document.querySelectorAll('.seccio').forEach(s => s.classList.remove('actiu'));
            document.getElementById(seccio).classList.add('actiu');
        }
    </script>
</head>
<body>
<h1>Panell de Gestió de Llibres</h1>
<nav>
    <a href="#" onclick="mostrar('afegir')">Afegir llibre</a>
    <a href="#" onclick="mostrar('llistar')">Llistar / Cercar</a>
</nav>

<div id="afegir" class="seccio actiu">
    <h2>Afegir llibre</h2>
    <form method="post">
        <input type="text" name="titol" placeholder="Títol" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="number" name="any" placeholder="Any" required>
        <input type="submit" name="afegir" value="Afegir">
    </form>
</div>

<div id="llistar" class="seccio">
    <h2>Llistat de llibres</h2>
    <form method="get">
        <input type="text" name="paraula" placeholder="Cercar per títol">
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <table>
        <tr><th>ID</th><th>Títol</th><th>Autor</th><th>Any</th><th>Accions</th></tr>
        <?php if ($llibres && $llibres->num_rows > 0): ?>
            <?php while ($l = $llibres->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $l['id']; ?></td>
                    <td><?php echo htmlspecialchars($l['Nom Llibre']); ?></td>
                    <td><?php echo htmlspecialchars($l['Autor']); ?></td>
                    <td><?php echo $l['Any']; ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo $l['id']; ?>">
                            <input type="text" name="titol" value="<?php echo htmlspecialchars($l['Nom Llibre']); ?>" required>
                            <input type="text" name="autor" value="<?php echo htmlspecialchars($l['Autor']); ?>" required>
                            <input type="number" name="any" value="<?php echo $l['Any']; ?>" required>
                            <input type="submit" name="editar" value="Editar">
                        </form>
                        <form method="get" style="display:inline-block;" onsubmit="return confirm('Segur que vols eliminar aquest llibre?');">
                            <input type="hidden" name="eliminar" value="<?php echo $l['id']; ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No s'han trobat llibres.</td></tr>
        <?php endif; ?>
    </table>
</div>

<?php if (isset($_GET['buscar'])): ?>
<script>
    window.onload = () => mostrar('llistar');
</script>
<?php endif; ?>

</body>
</html>
