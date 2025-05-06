<?php
include 'db.php';  // ينشئ المتغيّر $pdo

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email    = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // تحضير استعلام الإدراج عبر PDO
    $stmt = $pdo->prepare("
        INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password)
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email',    $email);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        $success = "Registration successful! <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        // يمكنك تحسين الرسالة بحسب رمز الخطأ
        if ($e->getCode() == '23505') {
            // 23505 = unique_violation
            $error = "Username or email already exists.";
        } else {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: #eef2f5;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .success, .error {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <?php if (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
