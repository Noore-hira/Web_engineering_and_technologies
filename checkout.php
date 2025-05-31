<?php
session_start();
require_once "db.php";

$cart = $_SESSION['cart'] ?? [];
$user_id = $_SESSION['user_id'];
$total = 0;

foreach ($cart as $item) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $item['name'], $item['quantity'], $item['price']]);
    $total += $item['price'] * $item['quantity'];
}

$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<h2>Checkout Complete</h2>
<p>Thanks <?= $_SESSION['login_id'] ?>! Your total bill is <strong>$<?= $total ?></strong>.</p>
</body>
</html>
