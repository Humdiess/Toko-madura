<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;

// Hitung total harga
foreach ($cart as $product_id => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        $total_price += $product['price'] * $quantity;
    }
}

// Proses checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = isset($user['username']) ? $user['username'] : '';
    $customer_email = isset($user['gmail']) ? $user['gmail'] : ''; 

    if (empty($customer_name) || empty($customer_email)) {
        die('User data is incomplete.');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, customer_name, customer_email, total_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $customer_name, $customer_email, $total_price]);
        $order_id = $pdo->lastInsertId();

        foreach ($cart as $product_id => $quantity) {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$order_id, $product_id, $quantity, $product['price']]);
            }
        }

        unset($_SESSION['cart']);
        header('Location: thank_you.php');
        exit();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['gmail']); ?></p>
    <p><strong>Total Price:</strong> $<?php echo number_format($total_price, 2); ?></p>

    <form action="checkout.php" method="post">
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
