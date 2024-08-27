<?php 
session_start();

include 'services/c_cartController.php';

include('themes/home/header.php'); 
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="cart-header d-flex justify-content-between align-items-center mb-3">
                <h1 class="fw-medium fs-5">Keranjang Belanja</h1>
                <div class="form-check">
                    <input type="checkbox" id="selectAllCheckbox" class="form-check-input" checked>
                    <label class="form-check-label" for="selectAllCheckbox">Pilih Semua</label>
                </div>
            </div>
            <form id="cartForm" action="checkout.php" method="post">
                <?php if (empty($cart_items)): ?>
                    <p>Tidak ada barang di keranjang.</p>
                <?php else: ?>
                    <?php 
                    $total_price = 0;
                    foreach ($cart_items as $item): 
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
                <?php endif; ?>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="total-price-wrapper p-3 border rounded-3 mt-5">
                <h4 class="fw-bold">Subtotal Terpilih:</h4>
                <p class="fw-bold text-danger">Rp. <span id="selectedSubtotal"><?php echo number_format($total_price, 0, ',', '.'); ?></span></p>
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
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1" value="Transfer Bank" checked>
                        <label class="form-check-label" for="paymentMethod1">
                            Transfer Bank
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" value="E-Wallet">
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
</div>

<?php include('themes/home/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const selectedSubtotal = document.getElementById('selectedSubtotal');
    const payButton = document.getElementById('payButton');
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

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
            const productId = this.getAttribute('data-product-id');
            const cartItem = this.closest('.cart-item');

            fetch('services/c_delete_cart_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}`
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    cartItem.remove();  // Remove the item from the DOM
                    updateSubtotal();
                } else {
                    alert('Error removing item from cart');
                }
            });
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

    document.getElementById('confirmPaymentButton').addEventListener('click', function () {
        const form = document.getElementById('cartForm');
        const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

        if (selectedPaymentMethod) {
            // Remove previous payment method input if exists
            const existingPaymentMethodInput = form.querySelector('input[name="paymentMethod"]');
            if (existingPaymentMethodInput) {
                existingPaymentMethodInput.remove();
            }

            // Create and append new payment method input
            const paymentMethodInput = document.createElement('input');
            paymentMethodInput.type = 'hidden';
            paymentMethodInput.name = 'paymentMethod';
            paymentMethodInput.value = selectedPaymentMethod.value;
            form.appendChild(paymentMethodInput);

            // Submit the form
            form.submit();
        } else {
            alert('Pilih metode pembayaran.');
        }
    });

    // Initialize subtotal
    updateSubtotal();
});
</script>
