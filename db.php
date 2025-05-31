<?php
$host = 'localhost';
$db = 'shopping_cart';
$user = 'root';
$pass = ''; // change if you have a DB password

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create DB if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
    $pdo->exec("USE $db");

    // Create users and orders tables if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        login_id VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_name VARCHAR(100),
        quantity INT,
        price DECIMAL(10,2),
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Insert default user if not exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login_id = ?");
    $stmt->execute(['noorehira']);
    if ($stmt->rowCount() == 0) {
        $insert = $pdo->prepare("INSERT INTO users (login_id, password) VALUES (?, ?)");
        $insert->execute(['noorehira', '123password']);
    }

} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>




