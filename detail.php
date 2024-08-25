<?php include('themes/header.php'); ?>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mengambil detail produk berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>
<?php foreach ($products as $product): ?>
<div class="product-detail-wrapper container mt-4">
    <div class="banner position-relative bg-light overflow-hidden py-4 rounded-3">
        <img src="assets/img/banner/detail-banner.png" alt="">
    </div>

    <div class="product-detail row gx-4 mt-4">
        <div class="product-image-detail col-lg-4 col-md-12 mb-4">
            <div class="image-detail rounded">
                <div class="image-detail-preview mb-3 border rounded">
                    <img id="mainImage" class="img-fluid w-100 rounded" alt="Product Image">
                </div>
                <?php $imagePaths = explode(',', $product['images']); ?>
                <div class="image-detail-selector d-flex gap-2">
                    <?php foreach ($imagePaths as $imagePath): ?>
                    <img src="assets/img/product/<?php echo htmlspecialchars($imagePath); ?>" class="img-thumbnail selector" alt="Product Thumbnail">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="product-description col-lg-5 col-md-12 mb-4">
            <div class="description rounded">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <div class="product-info d-flex gap-3">
                    <p class="mb-0">500+ terjual</p>
                    <p class="mb-0">
                        <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span> 
                        4.5 (200 ulasan)
                    </p>
                </div>
                <p class="product-price fs-3 text-danger">Rp. <?php echo htmlspecialchars($product['price']); ?></p>
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
                    <p class="description-text"><?php echo htmlspecialchars($product['description']); ?></p>
                    <a href="#" class="read-more text-danger" style="display: none;">Baca Lebih Lanjut</a>
                </div>

            </div>
        </div>


        <div class="product-checkout col-lg-3 col-md-12 mb-4">
            <div class="border p-2 rounded-3">
                <p class="mb-3">Jumlah barang</p>
                <div class="input-group mb-2 border rounded-3">
                    <button id="minusBtn" class="btn">-</button>
                    <input type="number" id="orderQuantity" class="form-control border border-0 text-center" value="1" min="1">
                    <button id="plusBtn" class="btn">+</button>
                </div>
                <p id="subtotal" class="mb-3">Subtotal: Rp. 0</p>
                <button class="btn btn-danger w-100 mb-2">Tambah ke Keranjang</button>
                <button class="btn border w-100">Beli Sekarang</button>
            </div>
        </div>

    </div>
</div>

<div class="product-reviews container mt-4">
    <h1 class="mb-4 fs-5 fw-medium">Ulasan Produk</h2>

    <div class="review-list d-flex flex-column gap-4 container">
        <div class="review-item border rounded-3 p-3">
            <div class="review-content">
                <div class="reviewer-photo rounded-circle overflow-hidden">
                    <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Reviewer Photo">
                </div>
                <div class="reviewer-info">
                    <h5 class="mb-1">Reviewer Name</h5>
                    <p class="text-muted mb-2">Jakarta</p>
                    <div class="rating mb-2">
                        <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                        <span class="text-muted">(4.0)</span>
                    </div>
                    <p class="review-text">Deskripsi singkat mengenai ulasan produk ini. Ulasan ini memberikan gambaran tentang pengalaman reviewer dengan produk.</p>
                </div>
            </div>
        </div>

        <div class="review-item border rounded-3 p-3">
            <div class="d-flex gap-3">
                <div class="reviewer-photo rounded-circle overflow-hidden">
                    <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Reviewer Photo">
                </div>
                <div class="reviewer-info">
                    <h5 class="mb-1">Reviewer Name</h5>
                    <p class="text-muted mb-2">Jakarta</p>
                    <div class="rating mb-2">
                        <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        <span class="text-muted">(5.0)</span>
                    </div>
                    <p class="review-text">Deskripsi singkat mengenai ulasan produk ini. Ulasan ini memberikan gambaran tentang pengalaman reviewer dengan produk.</p>
                </div>
            </div>
        </div>

        <div class="review-item border rounded-3 p-3">
            <div class="d-flex gap-3">
                <div class="reviewer-photo rounded-circle overflow-hidden">
                    <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Reviewer Photo">
                </div>
                <div class="reviewer-info">
                    <h5 class="mb-1">Reviewer Name</h5>
                    <p class="text-muted mb-2">Jakarta</p>
                    <div class="rating mb-2">
                        <span class="text-warning">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                        <span class="text-muted">(3.0)</span>
                    </div>
                    <p class="review-text">Deskripsi singkat mengenai ulasan produk ini. Ulasan ini memberikan gambaran tentang pengalaman reviewer dengan produk.</p>
                </div>
            </div>
        </div>

    </div>
</div>


<section class="product container mt-5">
    <div class="product-wrapper">
        <div class="product">
            <div class="product-header mb-3 d-flex justify-content-between">
                <h1 class="fw-medium fs-5">Produk serupa</h1>
                <a class="text-decoration-none text-dark fw-normal fs-6" href="#">Lihat semua</a>
            </div>
            <div class="product-content">
                <div class="product-list">
                    <?php foreach ($products as $product) : ?>
                        <div class="product-card rounded-4 border" onclick="window.location.href='./detail.php' ">
                            <div class="product-card-image">
                                <img src="assets/img/product/product.jpg" alt="product-image" loading="lazy">
                            </div>
                            <div class="product-card-content">
                                <h5 class="product-name"><?php echo htmlspecialchars($product['nama']); ?></h5>
                                <p class="product-price mb-0">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                                <p class="product-location mb-2">
                                    <i class="fas fa-map-marker-alt text-secondary"></i>
                                    Jakarta
                                </p>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <span class="rating-value">4.5</span>
                                    <span class="rating-count">(200 ulasan)</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endforeach; ?>

<div class="bottom-navbar d-lg-none">
    <div class="container">
        <button class="btn btn-danger w-100 mb-2">Tambah ke Keranjang</button>
        <button class="btn border w-100">Beli Sekarang</button>
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
