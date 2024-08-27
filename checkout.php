<?php 
session_start();
include 'utils/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

// Fetch cart items
$stmt = $pdo->prepare("
    SELECT c.product_id, c.quantity, p.name, p.price 
    FROM carts c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;

// Calculate total price
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['paymentMethod'] ?? '';

    if (empty($payment_method)) {
        die('Payment method is missing.');
    }

    if (empty($user['username']) || empty($user['gmail'])) {
        die('User data is incomplete.');
    }

    try {
        // Save order data
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, customer_name, customer_email, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, htmlspecialchars($user['username']), htmlspecialchars($user['gmail']), $total_price, $payment_method]);
        $order_id = $pdo->lastInsertId();

        // Save order items
        foreach ($cart_items as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
        }

        // Remove items from cart
        $stmt = $pdo->prepare("DELETE FROM carts WHERE user_id = ?");
        $stmt->execute([$user_id]);

        header('Location: history.php');
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
    <p><strong>Total Price:</strong> Rp. <?php echo number_format($total_price, 0, ',', '.'); ?></p>

    <form action="checkout.php" method="post">
        <h3>Select Payment Method:</h3>
        <div>
            <input type="radio" name="paymentMethod" id="paymentMethod1" value="Transfer Bank" checked>
            <label for="paymentMethod1">Transfer Bank</label>
        </div>
        <div>
            <input type="radio" name="paymentMethod" id="paymentMethod2" value="E-Wallet">
            <label for="paymentMethod2">E-Wallet</label>
        </div>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>