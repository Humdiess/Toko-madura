<?php
session_start();
include 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    echo 'error';
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? '';

if ($product_id) {
    // Delete the item from the carts table
    $stmt = $pdo->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
    $result = $stmt->execute([$user_id, $product_id]);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
