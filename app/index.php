<?php
// Parámetros de conexión al servidor de base de datos
$dbHost = 'srv-datos'; 
$dbUser = 'inv_user';
$dbPassword = 'inv_password';
$dbName = 'inventario_db';

// Intento de conexión
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_errno) {
    http_response_code(503);
    exit('Error crítico: No se pudo conectar a la base de datos de inventario.');
}

// Consulta de prueba
$result = $conn->query('SELECT VERSION() AS version');

if (!$result) {
    http_response_code(503);
    exit('MariaDB respondió, pero la consulta de versión falló.');
}

$row = $result->fetch_assoc();
$conn->close();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Examen - Sistema de Inventario</title>
</head>
<body>
    <h1>Panel de Inventario</h1>
    <p>La aplicación web se ha conectado exitosamente al motor de base de datos.</p>
    <p>Versión de MariaDB detectada: <strong><?= htmlspecialchars($row['version'], ENT_QUOTES, 'UTF-8') ?></strong></p>
</body>
</html>
