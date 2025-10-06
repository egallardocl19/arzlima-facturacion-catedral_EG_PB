<?php
// ==========================================================
// CONFIGURACIÓN DE CONEXIÓN A BASE DE DATOS (Azure + Local)
// ==========================================================

// 1️⃣ Intenta cargar desde variables de entorno (Azure App Service)
$databaseConfig = [
    'host'     => getenv('DB_HOST') ?: '127.0.0.1',
    'port'     => getenv('DB_PORT') ?: '3306',
    'username' => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_DATABASE') ?: 'syscatedral',
    'charset'  => getenv('DB_CHARSET') ?: 'utf8mb4',
];

// 2️⃣ Conectar a la base de datos MySQL
$con = @mysqli_connect(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database'],
    (int)$databaseConfig['port']
);

// 3️⃣ Verificación de conexión
if (!$con) {
    error_log("❌ Error de conexión MySQL: " . mysqli_connect_error());
    die("No se pudo conectar a la base de datos. Verifica la configuración.");
}

// 4️⃣ Establecer conjunto de caracteres
if (!empty($databaseConfig['charset'])) {
    if (!@mysqli_set_charset($con, $databaseConfig['charset'])) {
        error_log("⚠️ No se pudo establecer el charset: " . mysqli_error($con));
    }
}

// 5️⃣ Confirmar conexión (opcional para depurar)
# echo "✅ Conectado a la BD: " . $databaseConfig['database'];
?>
