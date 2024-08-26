<?php 
session_start();
include 'utils/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

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
    <div class="row">
        <div class="col-lg-8">
            <div class="cart-header d-flex justify-content-between align-items-center mb-3">
                <h1 class="fw-medium fs-5">Keranjang Belanja</h1>
                <div class="form-check">
                    <input type="checkbox" id="selectAllCheckbox" class="form-check-input">
                    <label class="form-check-label" for="selectAllCheckbox">Pilih Semua</label>
                </div>
            </div>
            <form id="cartForm" action="checkout.php" method="post">
                <?php foreach ($cart_items as $item): ?>
                    <?php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                    ?>
                    <div class="cart-item row align-items-center mb-4 p-3 border rounded-3">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-4 text-center">
                            <input type="checkbox" name="selected_products[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" class="product-checkbox" checked>
                        </div>
                        <div class="cart-product-image col-lg-2 col-md-3 col-sm-4 col-6">
                            <?php
                                $imagePaths = explode(',', $item['images']);
                                $imageSrc = !empty($imagePaths[0]) ? "assets/img/product/" . htmlspecialchars($imagePaths[0]) : "assets/img/default/default_image.png";
                            ?>
                            <img src="<?php echo $imageSrc; ?>" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <h5 class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="text-danger">Rp. <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-6 text-center">
                            <div class="input-group">
                                <input type="text" name="quantities[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" class="form-control text-center border-0" readonly>
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

        <div class="col-lg-4">
            <div class="total-price-wrapper p-3 border rounded-3 mt-5">
                <h4 class="fw-bold">Subtotal Terpilih:</h4>
                <p class="fw-bold text-danger">Rp. <span id="selectedSubtotal">0</span></p>
                <div class="checkout-btn-wrapper mt-4 w-100">
                    <button id="payButton" type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#paymentModal">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
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
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="successModalLabel">Pembayaran Berhasil!</h5>
                    <p>Terima kasih atas pembayaran Anda.</p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('themes/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const selectedSubtotal = document.getElementById('selectedSubtotal');
    const payButton = document.getElementById('payButton');
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

    // Update subtotal
    function updateSubtotal() {
        let subtotal = 0;
        let anySelected = false;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                anySelected = true;
                const item = checkbox.closest('.cart-item');
                const itemSubtotal = parseInt(item.querySelector('.subtotal').textContent.replace(/\./g, ''));
                subtotal += itemSubtotal;
            }
        });

        selectedSubtotal.textContent = subtotal.toLocaleString('id-ID');
        payButton.disabled = !anySelected;
    }

    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
        updateSubtotal();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSubtotal);
    });

    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.cart-item').remove();
            updateSubtotal();
        });
    });

    payButton.addEventListener('click', function (event) {
        if (payButton.disabled) {
            event.preventDefault();
            alert('Silakan pilih setidaknya satu produk untuk melanjutkan pembayaran.');
        } else {
            paymentModal.show();
        }
    });
});

</script>
