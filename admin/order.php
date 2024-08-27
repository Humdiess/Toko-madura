<?php include '../themes/admin/header.php'; ?>
<?php
include '../utils/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    header('Location: orders.php');
    exit();
}

$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="admin-header">
        <h1>Manage Orders</h1>
    </div>
    
    <table class="table border rounded-3 mt-3 bg-white">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Total Price</th>
                <th scope="col">Created At</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['customer_email']); ?></td>
                    <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                    <td>
                        <a href="orders.php?action=delete&order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-danger">Mark as Completed</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../themes/admin/footer.php'; ?>
