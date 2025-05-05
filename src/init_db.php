<?php
require 'db.php'; // تحميل الاتصال

$sql = file_get_contents('ecommerce_db.sql'); // تحميل السكريبت من ملف خارجي إذا أردت

try {
    $pdo->exec($sql);
    echo "تم إنشاء الجداول وإضافة البيانات بنجاح.";
} catch (PDOException $e) {
    die("فشل في تنفيذ السكريبت: " . $e->getMessage());
}
?>
