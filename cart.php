<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <div>
        <?php foreach ($cart as $product_id => $quantity): ?>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            $total_price += $product['price'] * $quantity;
            ?>
            <div>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Quantity: <?php echo $quantity; ?></p>
                <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                <p>Subtotal: <?php echo htmlspecialchars($product['price'] * $quantity); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <p>Total Price: <?php echo htmlspecialchars($total_price); ?></p>
    <form action="checkout.php" method="post">
        <button type="submit">Checkout</button>
    </form>
</body>
</html>
