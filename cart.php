<?php 
session_start();
include 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve cart data based on user_id
$stmt = $pdo->prepare("
    SELECT c.product_id, c.quantity, p.name, p.price, p.images 
    FROM carts c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;

include('themes/header.php'); 
?>

<div class="container mt-4">
    <h1 class="fw-medium fs-4 mb-4">Keranjang Belanja</h1>
    <div class="row">
        <div class="col-lg-8">
            <form id="cartForm" action="checkout.php" method="post">
                <?php foreach ($cart_items as $item): ?>
                    <?php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                    ?>
                    <div class="cart-item row align-items-center mb-4 p-3 border rounded-3">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-4 text-center">
                            <input type="checkbox" name="selected_products[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" class="product-checkbox">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                            <img src="assets/img/product/<?php echo htmlspecialchars($item['images']); ?>" alt="Product Image" class="img-fluid rounded">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <h5 class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="text-danger">Rp. <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-6 text-center">
                            <div class="input-group">
                                <!-- <button type="button" class="btn btn-outline-secondary btn-sm quantity-decrease" data-product-id="<?php echo $item['product_id']; ?>">-</button> -->
                                <input type="text" name="quantities[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" class="form-control text-center border-0" readonly>
                                <!-- <button type="button" class="btn btn-outline-secondary btn-sm quantity-increase" data-product-id="<?php echo $item['product_id']; ?>">+</button> -->
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-6 text-end">
                            <p class="fw-bold">Subtotal: Rp. <span class="subtotal"><?php echo number_format($subtotal, 0, ',', '.'); ?></span></p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 text-end">
                            <button type="button" class="btn btn-danger remove-item" data-product-id="<?php echo $item['product_id']; ?>">Hapus</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>

        <!-- Subtotal Box -->
        <div class="col-lg-4">
            <div class="total-price-wrapper mt-4 p-3 border rounded-3">
                <h4 class="fw-bold">Subtotal Terpilih:</h4>
                <p class="fw-bold text-danger">Rp. <span id="selectedSubtotal">0</span></p>
                <div class="checkout-btn-wrapper mt-4 w-100">
                    <button id="payButton" type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#paymentModal">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <!-- <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Metode Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pilih metode pembayaran:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1" value="transfer" checked>
                        <label class="form-check-label" for="paymentMethod1">
                            Transfer Bank
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" value="ewallet">
                        <label class="form-check-label" for="paymentMethod2">
                            E-Wallet
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="confirmPaymentButton" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Success Modal -->
    <!-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="successModalLabel">Pembayaran Berhasil!</h5>
                    <p>Terima kasih atas pembayaran Anda.</p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div> -->
</div>

<?php include('themes/footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const selectedSubtotal = document.getElementById('selectedSubtotal');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSubtotal);
        });

        function updateSubtotal() {
            let subtotal = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const item = checkbox.closest('.cart-item');
                    const itemSubtotal = parseInt(item.querySelector('.subtotal').textContent.replace(/\./g, ''));
                    subtotal += itemSubtotal;
                }
            });

            selectedSubtotal.textContent = subtotal.toLocaleString('id-ID');
        }

        // Increase or decrease quantity
        document.querySelectorAll('.quantity-increase, .quantity-decrease').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const quantityInput = this.closest('.input-group').querySelector('input');
                let quantity = parseInt(quantityInput.value);
                const isIncrease = this.classList.contains('quantity-increase');
                if (isIncrease) {
                    quantity += 1;
                } else if (quantity > 1) {
                    quantity -= 1;
                }
                quantityInput.value = quantity;

                // Update subtotal
                const item = this.closest('.cart-item');
                const price = parseInt(item.querySelector('.text-danger').textContent.replace(/[^0-9]/g, ''));
                const newSubtotal = price * quantity;
                item.querySelector('.subtotal').textContent = newSubtotal.toLocaleString('id-ID');

                // Update selected subtotal
                updateSubtotal();
            });
        });

        // Remove item from cart
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;

                fetch('remove_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + productId
                })
                .then(response => response.text())
                .then(data => {
                    // Reload page to reflect changes
                    location.reload();
                });
            });
        });

        // Payment Modal
        document.getElementById('confirmPaymentButton').addEventListener('click', function () {
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.hide();

            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    });
</script>



<?php
session_start();
include 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Ambil data keranjang dari tabel carts berdasarkan user_id
$stmt = $pdo->prepare("
    SELECT c.product_id, c.quantity, p.name, p.price 
    FROM carts c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <?php foreach ($cart_items as $item): ?>
            <?php
            // Hitung total harga untuk setiap produk
            $subtotal = $item['price'] * $item['quantity'];
            $total_price += $subtotal;
            ?>
            <div>
                <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                <p>Price: RP<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></p>
                <p>Subtotal: RP<?php echo htmlspecialchars(number_format($subtotal, 2)); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <p>Total Price: RP <?php echo htmlspecialchars(number_format($total_price, 2)); ?></p>
    <form action="checkout.php" method="post">
        <button type="submit">Checkout</button>
    </form>
</body>
</html>

