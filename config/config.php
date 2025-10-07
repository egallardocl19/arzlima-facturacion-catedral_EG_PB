<?php
// ==========================================================
// CONFIGURACIÓN DE CONEXIÓN A BASE DE DATOS (Azure + Local)
// ==========================================================

// 1) Cargar variables desde entorno (Azure) con fallback solo para DESARROLLO
$databaseConfig = [
    'host'     => getenv('DB_HOST') ?: '127.0.0.1',
    'port'     => getenv('DB_PORT') ?: '3306',
    'username' => getenv('DB_USERNAME') ?: 'root',        // <-- evita credenciales reales aquí
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_DATABASE') ?: '',
    'charset'  => getenv('DB_CHARSET')  ?: 'utf8mb4',
];

// 2) Preparar conexión (mysqli_init para poder poner opciones/SSL)
$link = mysqli_init();

// Azure Database for MySQL Flexible Server suele requerir TLS.
// Mysqli usa TLS automáticamente, pero activamos flag SSL por claridad.
mysqli_options($link, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// 3) Conectar (usa real_connect para pasar puerto/flags SSL)
$connected = @mysqli_real_connect(
    $link,
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database'],
    (int)$databaseConfig['port'],
    null,
    MYSQLI_CLIENT_SSL
);

if (!$connected) {
    error_log('MySQL connect error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error());
    // Mensaje amable para el usuario final
    die('No se pudo conectar a la base de datos. Contacte al administrador.');
}

// 4) Charset
if (!empty($databaseConfig['charset'])) {
    if (!@mysqli_set_charset($link, $databaseConfig['charset'])) {
        error_log('MySQL set_charset error: ' . mysqli_error($link));
    }
}

// 5) Exponer handle
$con = $link;
