<?php include('themes/header.php'); ?>

<div class="container mt-4">
    <h1 class="fw-medium fs-4 mb-4">Keranjang Belanja</h1>

        <div class="row">
            <div class="col-lg-8">
                <form id="cartForm" action="checkout.php" method="post">
                    <?php foreach ($cart as $product_id => $quantity): ?>
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                        $stmt->execute([$product_id]);
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);
                        $subtotal = $product['price'] * $quantity;
                        ?>
                        <div class="cart-item row align-items-center mb-4 p-3 border rounded-3">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-4 text-center">
                                <input type="checkbox" name="selected_products[]" value="<?php echo $product_id; ?>" class="product-checkbox">
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                <img src="assets/img/product/<?php echo htmlspecialchars($product['images']); ?>" alt="Product Image" class="img-fluid rounded">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="text-danger">Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-6 text-center">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary btn-sm">-</button>
                                    <input type="text" value="<?php echo $quantity; ?>" class="form-control text-center border-0" readonly>
                                    <button class="btn btn-outline-secondary btn-sm">+</button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-6 text-end">
                                <p class="fw-bold">Subtotal: Rp. <span class="subtotal"><?php echo number_format($subtotal, 0, ',', '.'); ?></span></p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 text-end">
                                <form action="remove_from_cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>

            <!-- Kotak Subtotal -->
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

        <!-- Modal Pembayaran -->
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

        <!-- Modal Pembayaran Berhasil -->
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

        <p>Keranjang belanja Anda kosong.</p>
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

        // Modal pembayaran
        document.getElementById('confirmPaymentButton').addEventListener('click', function () {
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.hide();

            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    });
</script>
