



<?php
include 'db.php';
session_start();



$search = isset($_GET["search"]) ? $_GET["search"] : "";

$sql = "SELECT * FROM products WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 300px;
        }
        button {
            padding: 8px 15px;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 200px;
            transition: 0.3s;
        }
        .product-card:hover {
            transform: scale(1.02);
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product-card h4 {
            margin: 10px 0 5px;
            font-size: 18px;
        }
        .product-card p {
            margin: 5px 0;
            font-size: 14px;
        }
        .product-card .price {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<a href="logout.php">Logout</a>

<form method="GET">
    <input type="text" name="search" placeholder="Search products" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<h3>Product List:</h3>
<div class="product-container">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="product-card">
        <img src="<?php echo htmlspecialchars($row["image_url"]); ?>" alt="<?php echo htmlspecialchars($row["name"]); ?>">
        <h4><?php echo htmlspecialchars($row["name"]); ?></h4>
        <p><?php echo htmlspecialchars($row["description"]); ?></p>
        <p class="price">$<?php echo $row["price"]; ?></p>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
