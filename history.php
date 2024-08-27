<?php
session_start();
require_once 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders and their items
$stmt = $pdo->prepare("
    SELECT orders.id AS order_id, orders.created_at AS order_date, orders.total_price,
           order_items.product_id, order_items.quantity, order_items.price,
           products.name AS product_name
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    JOIN products ON order_items.product_id = products.id
    WHERE orders.user_id = ?
    ORDER BY orders.created_at DESC
");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('themes/home/header.php'); ?>

<div class="container mt-4">
    <h1 class="mb-4 fw-bold fs-4">Riwayat Pembelian</h1>

    <?php if (empty($orders)): ?>
        <div class="alert alert-danger">Anda belum memiliki pesanan.</div>
    <?php else: ?>
        <div class="order-list">
            <?php
            $current_order_id = null;
            foreach ($orders as $order):
                if ($order['order_id'] !== $current_order_id):
                    if ($current_order_id !== null):
                        echo '</div>'; // Close previous order div
                    endif;
                    $current_order_id = $order['order_id'];
            ?>
                    <div class="order-card mb-4 p-3 border rounded-3">
                        <h4 class="fw-bold fs-5">Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h4>
                        <p class="text-muted">Tanggal: <?php echo htmlspecialchars(date('d M Y, H:i', strtotime($order['order_date']))); ?></p>
                        <p class="text-danger fs-5">Total: Rp. <?php echo htmlspecialchars(number_format($order['total_price'], 0, ',', '.')); ?></p>
                        <ul class="list-unstyled">
            <?php endif; ?>
                            <li class="mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold"><?php echo htmlspecialchars($order['product_name']); ?></h5>
                                        <p class="mb-0">Jumlah: <?php echo htmlspecialchars($order['quantity']); ?></p>
                                    </div>
                                    <p class="text-danger mb-0">Rp. <?php echo htmlspecialchars(number_format($order['price'], 0, ',', '.')); ?></p>
                                </div>
                            </li>
            <?php endforeach; ?>
                        </ul>
                    </div>
            <?php endif; ?>
        </div>
</div>

<?php include('themes/home/footer.php'); ?>
