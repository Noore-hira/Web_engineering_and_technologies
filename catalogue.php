<?php
// Demonstrates how to access products from products.php
require_once 'products.php'; // Loads the array and any defined logic

foreach ($products as $product) {
    echo "Product: {$product['name']} - Price: \${$product['price']} - Quantity: {$product['quantity']}<br>";
}
?>
