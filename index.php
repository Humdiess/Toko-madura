<?php include('themes/header.php') ?>
    <section class="hero container py-3">
        <div class="hero-wrapper">
            <div class="category-selector d-flex align-items-center gap-2 mb-3">
                <p class="text-center mb-0 fw-semibold">Kategori pilihan : </p>
                <ul class="category-list nav gap-3">
                    <li class="nav-item"><a href="#">Sabun</a></li>
                    <li class="nav-item"><a href="#">Bumbu dapur</a></li>
                    <li class="nav-item"><a href="#">Minuman</a></li>
                    <li class="nav-item"><a href="#">Peralatan dapur</a></li>
                </ul>
            </div>
            <div class="slider-container overflow-hidden rounded-top-3">
                <div class="slider">
                    <div class="slide">
                        <img src="assets/img/banner/banner-1.png" alt="banner">
                    </div>
                    <div class="slide">
                        <img src="assets/img/banner/banner-2.png" alt="banner">
                    </div>
                    <div class="slide">
                        <img src="assets/img/banner/banner-3.png" alt="banner">
                    </div>
                </div>
                <button class="slider-button prev rounded-2" onclick="prevSlide()">&#10094;</button>
                <button class="slider-button next rounded-2" onclick="nextSlide()">&#10095;</button>
            </div>
        </div>

        <div class="top-categories bg-light py-3 rounded-bottom-3 border">
            <div class="categories-list d-flex flex-wrap gap-3 px-3">
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-utensils h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Alat</a>
                    </div>
                </div>
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-bottle-droplet h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Minuman</a>
                    </div>
                </div>
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-cookie-bite h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Snack</a>
                    </div>
                </div>
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-bowl-rice h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Beras</a>
                    </div>
                </div>
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-oil-can h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Minyak</a>
                    </div>
                </div>
                <div class="category-card d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-soap h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Sabun</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="promo container mt-5">
        <div class="promo-wrapper px-5">
            <div class="promo-content rounded-3 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="promo-header text-center">
                    <h1 class="fw-bold mb-4 fs-4">PROMO SPESIAL 17 AGUSTUS!!</h1>
                </div>
                <div class="promo-product-list d-flex gap-3">
                    <div class="promo-product-card bg-light rounded-3 shadow-sm">
                        <div class="promo-product-card-image overflow-hidden rounded-top">
                            <img src="assets/img/product/product.jpg" alt="Product Image">
                        </div>
                        <div class="promo-product-card-body p-3">
                            <p class="product-title mb-2">Sabun Colek Ukuran 200ml Warna Biru</p>
                            <div class="price-discount d-flex align-items-center justify-content-between">
                                <p class="price fw-bold fs-6 mb-0">Rp. 10.000</p>
                                <span class="badge rounded-pill bg-danger text-light">-10%</span>
                            </div>
                        </div>
                    </div>
                    <div class="promo-product-card bg-light rounded-3 shadow-sm">
                        <div class="promo-product-card-image overflow-hidden rounded-top">
                            <img src="assets/img/product/product-1.jpg" alt="Product Image">
                        </div>
                        <div class="promo-product-card-body p-3">
                            <p class="product-title mb-2">Sabun Colek Ukuran 200ml Warna Biru</p>
                            <div class="price-discount d-flex align-items-center justify-content-between">
                                <p class="price fw-bold fs-6 mb-0">Rp. 10.000</p>
                                <span class="badge rounded-pill bg-danger text-light">-10%</span>
                            </div>
                        </div>
                    </div>
                    <div class="promo-product-card bg-light rounded-3 shadow-sm">
                        <div class="promo-product-card-image overflow-hidden rounded-top">
                            <img src="assets/img/product/product-2.jpg" alt="Product Image">
                        </div>
                        <div class="promo-product-card-body p-3">
                            <p class="product-title mb-2">Sabun Colek Ukuran 200ml Warna Biru</p>
                            <div class="price-discount d-flex align-items-center justify-content-between">
                                <p class="price fw-bold fs-6 mb-0">Rp. 10.000</p>
                                <span class="badge rounded-pill bg-danger text-light">-10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product container mt-5">
        <div class="product-wrapper">
            <div class="product">
                <div class="product-title d-flex align-items-center justify-content-between px-3">
                    <h1 class="fw-bold fs-5">Cari semua barang yang kamu butuhkan</h1>
                    <div class="filter-button">
                        <a href="#">Lihat semua</a>
                    </div>
                </div>
                <div class="product-content">
                    <div class="product-list">
                        <?php foreach ($products as $product) : ?>
                        <div class="product-card">
                            <div class="product-card-image">
                                <img src="assets/img/product/product.jpg" alt="product-image">
                            </div>
                            <div class="product-card-content p-2">
                                <p class="product-name mb-0"><?php echo htmlspecialchars($product['nama']); ?></p>
                                <p class="product-price mb-0 fw-bold mb-3">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                                <div class="product-rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star text-warning"></i>
                                    <p class="rating-text mb-0">4.5</p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include 'themes/footer.php'; ?>