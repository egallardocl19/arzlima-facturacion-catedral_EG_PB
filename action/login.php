<?php
session_start();

if (!isset($_POST['token']) || $_POST['token'] === '') {
    header("Location: ../");
    exit;
}

// Conexión
require_once __DIR__ . "/../config/config.php";

$email = mysqli_real_escape_string($con, strip_tags($_POST["email"], ENT_QUOTES));
$pwdPlain = mysqli_real_escape_string($con, strip_tags($_POST["password"], ENT_QUOTES));
// mismo algoritmo que usaba tu app: sha1(md5(plain))
$pwdHash = sha1(md5($pwdPlain));

$res = mysqli_query($con, "CALL session_login('$email','$pwdHash');");

// ÉXITO SOLO si la consulta fue bien y hay filas
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $_SESSION['user_id'] = $row['id'];

    // Libera resultados del SP y drena cualquier resultset adicional
    mysqli_free_result($res);
    while (mysqli_more_results($con) && mysqli_next_result($con)) {
        if ($tmp = mysqli_use_result($con)) { mysqli_free_result($tmp); }
    }

    header('Location: ../dashboardadmin.php');
    exit;
}

// FALLO: limpia resultados (si los hubiera), registra error y redirige
if ($res instanceof mysqli_result) { mysqli_free_result($res); }
while (mysqli_more_results($con) && mysqli_next_result($con)) {
    if ($tmp = mysqli_use_result($con)) { mysqli_free_result($tmp); }
}

// (opcional) log interno si la consulta falló
if ($res === false) {
    error_log("session_login failed: (" . mysqli_errno($con) . ") " . mysqli_error($con));
}

$invalid = sha1(md5("contrasena y email invalido"));
header("Location: ../index.php?invalid=$invalid");
exit;
