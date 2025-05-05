<?php
include 'db.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $imagePath = "";

    // رفع الصورة
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "images/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . time() . "_" . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    // إدخال البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $imagePath);
    $stmt->execute();

    $success = "Product added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
<h2>Add New Product</h2>
<a href="index.php">Back to Product List</a>
<br><br>

<?php if ($success): ?>
    <p style="color: green;"><?php echo $success; ?></p>
<?php endif; ?>

<form action="add_product.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Price ($):</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Product Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Add Product</button>
</form>
</body>
</html>
