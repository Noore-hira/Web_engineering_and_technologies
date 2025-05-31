<?php
session_start();

// Product array
$products = [
    [
        "name" => "Phone",
        "price" => 500,
        "quantity" => 10,
        "image" => "phone.jpg"
    ],
    [
        "name" => "Headphones",
        "price" => 150,
        "quantity" => 20,
        "image" => "headphones.jpg"
    ],
    [
        "name" => "HTML Book",
        "price" => 25,
        "quantity" => 15,
        "image" => "html.jpg"
    ],
    [
        "name" => "PHP Book",
        "price" => 35,
        "quantity" => 12,
        "image" => "php.jpg"
    ]
];

// Save in session
$_SESSION['products'] = $products;

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $name) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1
        ];
    }

    // Redirect to prevent resubmission
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<h2>Available Products</h2>

<div class="product-container">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="images/<?= $product['image'] ?>" width="100"><br>
            <strong><?= $product['name'] ?></strong><br>
            Price: $<?= $product['price'] ?><br>
            In Stock: <?= $product['quantity'] ?><br>
            <form method="POST">
                <input type="hidden" name="name" value="<?= $product['name'] ?>">
                <input type="hidden" name="price" value="<?= $product['price'] ?>">
                <input type="hidden" name="image" value="<?= $product['image'] ?>">
                <button type="submit" name="add">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<!-- Go to Cart Button (outside all forms) -->
<div style="margin-top: 30px;">
    <a href="cart.php" class="cart-link">🛒 Go to Cart</a>
</div>
</body>
</html>
