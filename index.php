<?php
$conn = new mysqli("db", "user", "pass", "app_db");
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$conn->query("CREATE TABLE IF NOT EXISTS notes (id INT AUTO_INCREMENT PRIMARY KEY, text VARCHAR(255))");

if (isset($_POST['note'])) {
    $note = $_POST['note'];
    $conn->query("INSERT INTO notes (text) VALUES ('$note')");
}

$res = $conn->query("SELECT * FROM notes ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Docker Cloud App</title>
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1 class="text-center mb-4">🚀 Mi App en la Nube</h1>
        <div class="card bg-secondary p-4 mb-4">
            <form method="POST" class="d-flex">
                <input type="text" name="note" class="form-control me-2" placeholder="Escribe algo chido..." required>
                <button class="btn btn-primary">Guardar</button>
            </form>
        </div>
        <ul class="list-group">
            <?php while($row = $res->fetch_assoc()): ?>
                <li class="list-group-item bg-light text-dark mb-2 rounded"><?php echo $row['text']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>