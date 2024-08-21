<?php include('themes/header.php'); ?>

<div class="product-detail-wrapper container mt-4">
    <div class="banner position-relative bg-light overflow-hidden py-4 rounded-3">
        <img src="assets/img/banner/detail-banner.png" alt="">
    </div>

    <div class="product-detail row gx-4 mt-4">
        <div class="product-image-detail col-lg-4 col-md-12 mb-4">
            <div class="image-detail rounded">
                <div class="image-detail-preview mb-3 border rounded">
                    <img id="mainImage" src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" class="img-fluid w-100 rounded" alt="Product Image">
                </div>
                <div class="image-detail-selector d-flex gap-2">
                    <img src="assets/img/product/product.jpg" class="img-thumbnail selector" alt="Product Thumbnail">
                    <img src="assets/img/product/product-1.jpg" class="img-thumbnail selector" alt="Product Thumbnail">
                    <img src="assets/img/product/product-2.jpg" class="img-thumbnail selector" alt="Product Thumbnail">
                </div>
            </div>
        </div>

        <div class="product-description col-lg-5 col-md-12 mb-4">
            <div class="description rounded">
                <h2>Sabun colek kurang tau berapa mili liter hehe</h2>
                <div class="product-info d-flex gap-3">
                    <p class="mb-0">500+ terjual</p>
                    <p class="mb-0">
                        <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span> 
                        4.5 (200 ulasan)
                    </p>
                </div>
                <p class="product-price fs-3 text-danger">Rp 1.000.000</p>
                <div class="seller-info d-flex align-items-center gap-3">
                    <div class="seller-photo rounded-circle overflow-hidden">
                        <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Seller Photo">
                    </div>
                    <div class="seller-name">
                        <a href="#" class="mb-0 fw-bold text-decoration-none text-dark">Seller Name</a>
                        <p class="text-muted mb-0 fs-6">Jakarta</p>
                    </div>
                </div>

                <div class="product-description mt-3">
                    <p>Deskripsi singkat mengenai produk ini. Anda bisa menambahkan informasi penting mengenai produk, seperti ukuran, bahan, dan lain-lain.</p>
                </div>
            </div>
        </div>


        <div class="product-checkout col-lg-3 col-md-12 mb-4">
            <div class="border p-2 rounded-3">
                <p class="mb-3">Jumlah barang</p>
                <div class="input-group mb-2">
                    <button id="minusBtn" class="btn btn-outline-secondary">-</button>
                    <input type="number" id="orderQuantity" class="form-control text-center" value="1" min="1">
                    <button id="plusBtn" class="btn btn-danger">+</button>
                </div>
                <p id="subtotal" class="mb-3">Subtotal: Rp. 0</p>
                <button class="btn btn-danger w-100 mb-2">Tambah ke Keranjang</button>
                <button class="btn btn-outline-secondary w-100">Beli Sekarang</button>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const selectors = document.querySelectorAll('.image-detail-selector .selector');

        selectors.forEach(function(selector) {
            selector.addEventListener('click', function() {
                mainImage.src = this.src;
            });
        });
    });
</script>

<?php include('themes/footer.php'); ?>
