<?php
$databaseUrl = getenv('DATABASE_URL');

if (!$databaseUrl) {
    die("DATABASE_URL غير معرف في البيئة.");
}

// معالجة الرابط - تأكد من أنه PostgreSQL
if (strpos($databaseUrl, "postgres://") === 0) {
    $databaseUrl = str_replace("postgres://", "postgresql://", $databaseUrl);
}

$parts = parse_url($databaseUrl);

// تأكد من أن كل جزء موجود قبل استخدامه
$host = isset($parts['host']) ? $parts['host'] : '';
$port = isset($parts['port']) ? $parts['port'] : '5432'; // PostgreSQL default
$user = isset($parts['user']) ? $parts['user'] : '';
$pass = isset($parts['pass']) ? $parts['pass'] : '';
$dbname = isset($parts['path']) ? ltrim($parts['path'], '/') : '';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "تم الاتصال بقاعدة البيانات!";
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
