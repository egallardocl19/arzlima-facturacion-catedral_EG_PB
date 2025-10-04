<?php
// Database connection bootstrap.
// Load configuration from environment variables or optional secure file.
$databaseConfig = [
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'port' => getenv('DB_PORT') ?: '3306',
    'username' => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_DATABASE') ?: '',
    'charset' => getenv('DB_CHARSET') ?: 'utf8mb4',
];

$secureConfigFile = __DIR__ . '/database.php';
if (is_readable($secureConfigFile)) {
    $fileConfig = include $secureConfigFile;
    if (is_array($fileConfig)) {
        $databaseConfig = array_merge($databaseConfig, array_filter($fileConfig, static function ($value) {
            return $value !== null && $value !== '';
        }));
    }
}

$con = @mysqli_connect(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database'],
    (int) $databaseConfig['port']
);

if (!$con) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    die('No se pudo establecer la conexión a la base de datos.');
}

if (!empty($databaseConfig['charset']) && !@mysqli_set_charset($con, $databaseConfig['charset'])) {
    error_log('Error al establecer el charset de la conexión: ' . mysqli_error($con));
}
