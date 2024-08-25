<?php
include 'utils/db.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple E-commerce</title>
</head>
<body>
    <h1>Products</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Welcome, <?php echo $_SESSION['role']; ?>!</p>
        <a href="logout.php">Logout</a>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin.php">Manage Products</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>

    <div>
        <?php foreach ($products as $product): ?>
            <div>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><?php echo htmlspecialchars($product['price']); ?></p>
                <?php $imagePaths = explode(',', $product['images']); ?>
                <?php foreach ($imagePaths as $imagePath): ?>
                    <img src="assets/img/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="200">
                <?php endforeach; ?>
                <form action="services/add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
