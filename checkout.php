<?php
session_start();
include 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

// Ambil data keranjang dari tabel carts
$stmt = $pdo->prepare("
    SELECT c.product_id, c.quantity, p.name, p.price 
    FROM carts c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;

// Hitung total harga
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = htmlspecialchars($user['username']);
    $customer_email = htmlspecialchars($user['gmail']);

    if (empty($customer_name) || empty($customer_email)) {
        die('User data is incomplete.');
    }

    try {
        // Simpan data pesanan
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, customer_name, customer_email, total_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $customer_name, $customer_email, $total_price]);
        $order_id = $pdo->lastInsertId();

        // Simpan detail pesanan
        foreach ($cart_items as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
        }

        // Hapus data cart setelah checkout
        $stmt = $pdo->prepare("DELETE FROM carts WHERE user_id = ?");
        $stmt->execute([$user_id]);

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
