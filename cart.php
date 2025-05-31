<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<h2>Your Cart</h2>
<?php $total = 0; ?>
<?php foreach ($cart as $item): ?>
    <div class="product">
        <img src="images/<?= $item['image'] ?>" width="100"><br>
        <?= $item['name'] ?> - $<?= $item['price'] ?> x <?= $item['quantity'] ?><br>
        Subtotal: $<?= $item['price'] * $item['quantity'] ?><br><br>
        <?php $total += $item['price'] * $item['quantity']; ?>
    </div>
<?php endforeach; ?>
<h3>Total: $<?= $total ?></h3>
<a href="checkout.php">Checkout</a>
</body>
</html>
