<?php
/**
 * config.php — Conexión MySQL (Azure + Local) con SSL
 *
 * Variables de entorno esperadas (Azure App Service > Configuración):
 *   DB_HOST        = syscatedral.mysql.database.azure.com
 *   DB_PORT        = 3306
 *   DB_USERNAME    = cate@syscatedral
 *   DB_PASSWORD    = ********
 *   DB_DATABASE    = syscatedral
 *   DB_CHARSET     = utf8mb4
 *
 * Opcionales:
 *   MYSQL_SSL_CA       = /home/site/wwwroot/ssl/DigiCertGlobalRootG2.crt.pem
 *   MYSQL_SSL_VERIFY   = 1  (1=verificar cert del servidor, 0=no verificar)  [por defecto 1 si existe CA, 0 si no]
 */

mysqli_report(MYSQLI_REPORT_OFF);

// 1) Carga de configuración (env con defaults razonables para local)
$cfg = [
    'host'    => getenv('DB_HOST')     ?: '127.0.0.1',
    'port'    => (int)(getenv('DB_PORT') ?: 3306),
    'user'    => getenv('DB_USERNAME') ?: 'root',
    'pass'    => getenv('DB_PASSWORD') ?: '',
    'db'      => getenv('DB_DATABASE') ?: '',
    'charset' => getenv('DB_CHARSET')  ?: 'utf8mb4',
];

// 2) Ruta del certificado CA
// Si viene por env, úsalo; si no, usa el que solemos dejar en /ssl a nivel del proyecto.
// OJO: este config suele vivir en /config; subimos un nivel para llegar a /ssl.
$defaultCaPath = dirname(__DIR__) . '/ssl/DigiCertGlobalRootG2.crt.pem';
$caPath = getenv('MYSQL_SSL_CA') ?: $defaultCaPath;

// 3) Política de verificación del certificado del servidor (estricto por defecto si hay CA)
$sslVerifyEnv = getenv('MYSQL_SSL_VERIFY');
$verifyServer = null;
if ($sslVerifyEnv === '0' || strtolower($sslVerifyEnv) === 'false') {
    $verifyServer = false;
} elseif ($sslVerifyEnv === '1' || strtolower($sslVerifyEnv) === 'true') {
    $verifyServer = true;
} else {
    // Si no se definió, por defecto: verificar si existe CA; si no hay CA, no verificar.
    $verifyServer = is_readable($caPath);
}

// 4) Inicializa conexión
$mysqli = mysqli_init();

// Timeouts razonables
@mysqli_options($mysqli, MYSQLI_OPT_CONNECT_TIMEOUT, 10);
@mysqli_options($mysqli, MYSQLI_OPT_READ_TIMEOUT, 15);

// Carga CA si está disponible; si no, seguimos con SSL sin CA (dependiendo de $verifyServer)
if (is_readable($caPath)) {
    @mysqli_ssl_set($mysqli, null, null, $caPath, null, null);
}

// Controla verificación del certificado del servidor
if (defined('MYSQLI_OPT_SSL_VERIFY_SERVER_CERT')) {
    @mysqli_options($mysqli, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, $verifyServer ? 1 : 0);
}

// 5) Conecta forzando SSL (Azure Flexible Server requiere TLS por defecto)
$connected = @mysqli_real_connect(
    $mysqli,
    $cfg['host'],
    $cfg['user'],
    $cfg['pass'],
    $cfg['db'],
    $cfg['port'],
    null,
    MYSQLI_CLIENT_SSL // fuerza TLS
);

// 6) Manejo de error de conexión
if (!$connected) {
    error_log('MySQL connect error [' . mysqli_connect_errno() . ']: ' . mysqli_connect_error());
    // Mensaje neutro para usuario final:
    die('No se pudo conectar a la base de datos.');
}

// 7) Charset
if (!empty($cfg['charset'])) {
    if (!@mysqli_set_charset($mysqli, $cfg['charset'])) {
        error_log('Error al establecer charset (' . $cfg['charset'] . '): ' . mysqli_error($mysqli));
    }
}

// 8) Exponer conexión
$con = $mysqli;

// (Opcional) Diagnóstico mínimo local:
// echo "OK config.php\n";
