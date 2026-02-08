<?php
// Obtenemos los datos de las variables de entorno de Railway
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');
$port = getenv('PORT') ?: 3306;

// Intentamos la conexión a la base de datos MySQL Online
$conn = new mysqli($host, $user, $pass, $name, $port);

// Verificamos si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Creamos la tabla 'notes' si no existe (importante para bases de datos nuevas)
$conn->query("CREATE TABLE IF NOT EXISTS notes (id INT AUTO_INCREMENT PRIMARY KEY, text VARCHAR(255))");

// Si el usuario envía una nota, la guardamos
if (isset($_POST['note'])) {
    // Escapamos el texto para evitar inyecciones SQL (Seguridad Web)
    $note = $conn->real_escape_string($_POST['note']);
    $conn->query("INSERT INTO notes (text) VALUES ('$note')");
}

// Obtenemos todas las notas guardadas
$res = $conn->query("SELECT * FROM notes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Mi App en la Nube - Olger</title>
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1 class="text-center mb-4">🚀 Mi App en la Nube</h1>
        
        <div class="card bg-secondary p-4 mb-4 shadow">
            <form method="POST" class="d-flex">
                <input type="text" name="note" class="form-control me-2" placeholder="Escribe algo aquí..." required>
                <button class="btn btn-primary">Guardar Nota</button>
            </form>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="mb-3">Notas Guardadas:</h3>
                <ul class="list-group">
                    <?php if ($res && $res->num_rows > 0): ?>
                        <?php while($row = $res->fetch_assoc()): ?>
                            <li class="list-group-item bg-light text-dark mb-2 rounded shadow-sm">
                                <?php echo htmlspecialchars($row['text']); ?>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-muted">Aún no hay notas. ¡Escribe la primera!</p>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
