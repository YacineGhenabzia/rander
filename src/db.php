<?php
$databaseUrl = getenv('postgresql://project_name_24lm_user:rw3dng1fMKXXPrKV5ET5bXJTZGAy2lNo@dpg-d0ci17mmcj7s73ajkfa0-a/project_name_24lm');
$parts = parse_url($databaseUrl);

$host = $parts['host'];
$port = $parts['port'];
$user = $parts['user'];
$pass = $parts['pass'];
$dbname = ltrim($parts['path'], '/');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
