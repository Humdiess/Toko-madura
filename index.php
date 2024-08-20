<?php include('themes/header.php') ?>
    <section class="hero container py-3">
        <div class="hero-wrapper">
            <div class="category-selector align-items-center gap-2 mb-3">
                <p class="text-center mb-0 fw-semibold">Kategori pilihan : </p>
                <ul class="category-list nav gap-3">
                    <li class="nav-item"><a href="./detail.php">Sabun</a></li>
                    <li class="nav-item"><a href="#">Bumbu dapur</a></li>
                    <li class="nav-item"><a href="#">Minuman</a></li>
                    <li class="nav-item"><a href="#">Peralatan dapur</a></li>
                </ul>
            </div>
            <div class="slider-container overflow-hidden rounded-4">
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

        <div class="top-categories py-5">
            <div class="category-header mb-3 d-flex justify-content-between">
                <h1 class="fw-medium fs-5">Kategori terpopuler</h1>
                <a class="text-decoration-none text-dark fw-normal fs-6" href="#">Lihat semua</a>
            </div>
            <div class="categories-list d-flex flex-wrap gap-3 px-3">
                <div class="category-card bg-light d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-utensils h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Alat</a>
                    </div>
                </div>
                <div class="category-card bg-light d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-bottle-droplet h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Minuman</a>
                    </div>
                </div>
                <div class="category-card bg-light d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-cookie-bite h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Snack</a>
                    </div>
                </div>
                <div class="category-card bg-light d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-bowl-rice h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Beras</a>
                    </div>
                </div>
                <div class="category-card bg-light d-flex flex-column align-items-center">
                    <div class="category-card-icon">
                        <i class="fas fa-oil-can h2 mb-2"></i>
                    </div>
                    <div class="category-card-title">
                        <a href="#">Minyak</a>
                    </div>
                </div>
                <div class="category-card bg-light d-flex flex-column align-items-center">
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

    <section class="promo-container py-5">
        <div class="promo-wrapper container text-center">
            <div class="promo">
                <div class="promo-header mb-4">
                    <h1 class="promo-title fw-bold fs-3 text-white">Rayakan Kemerdekaan dengan Diskon Merdeka 17%!</h1>
                </div>
                <div class="promo-content">
                    <div class="promo-list d-flex">
                        <div class="product-card rounded-4 border" onclick="window.location.href='./detail.php' ">
                            <div class="product-card-image">
                                <img src="assets/img/product/product.jpg" alt="product-image">
                            </div>
                            <div class="product-card-content">
                                <h5 class="product-name">Cupcake</h5>
                                <p class="product-price mb-0">Rp. 15.000</p>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product container mt-5">
        <div class="product-wrapper">
            <div class="product">
                <div class="product-header mb-3 d-flex justify-content-between">
                    <h1 class="fw-medium fs-5">Produk terlaris</h1>
                    <a class="text-decoration-none text-dark fw-normal fs-6" href="#">Lihat semua</a>
                </div>
                <div class="product-content">
                    <div class="product-list">
                        <?php foreach ($products as $product) : ?>
                            <div class="product-card rounded-4 border" onclick="window.location.href='./detail.php' ">
                                <div class="product-card-image">
                                    <img src="assets/img/product/product.jpg" alt="product-image">
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
<?php include 'themes/footer.php'; ?>