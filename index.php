<?php
/**
 * Archivo de prueba principal
 * Muestra información del sistema y conexión a MySQL
 */

echo "<h1>✅ Nginx + PHP-FPM funcionan correctamente</h1>";
echo "<hr>";

// Información del servidor
echo "<h2>Información del Sistema</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> Nginx + PHP-FPM</p>";
echo "<p><strong>Hostname:</strong> " . gethostname() . "</p>";
echo "<hr>";

// Verificar extensiones PHP
echo "<h2>Extensiones PHP Disponibles</h2>";
$extensions = ['pdo', 'pdo_mysql', 'mysqli'];
foreach ($extensions as $ext) {
    $status = extension_loaded($ext) ? '✅' : '❌';
    echo "<p>$status $ext</p>";
}
echo "<hr>";

// Prueba de conexión a MySQL
echo "<h2>Conexión a MySQL</h2>";
$host = getenv('MYSQL_HOST') ?: 'mysql';
$user = getenv('MYSQL_USER') ?: 'admin';
$password = getenv('MYSQL_PASSWORD') ?: 'admin_password';
$database = getenv('MYSQL_DATABASE') ?: 'myapp_db';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "<p>✅ <strong>Conexión exitosa a MySQL</strong></p>";
    echo "<p>Host: $host</p>";
    echo "<p>Base de datos: $database</p>";
    echo "<p>Usuario: $user</p>";
    
    // Obtener información de la base de datos
    $result = $pdo->query("SELECT DATABASE() as db, VERSION() as version");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>MySQL Version:</strong> " . $row['version'] . "</p>";
} catch (PDOException $e) {
    echo "<p>❌ <strong>Error de conexión a MySQL</strong></p>";
    echo "<p><em>" . htmlspecialchars($e->getMessage()) . "</em></p>";
}
echo "<hr>";

// phpinfo
echo "<h2>Detalles completos (phpinfo)</h2>";
phpinfo();
?>
