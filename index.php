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
            <div class="slider-container overflow-hidden rounded-3">
                <div class="slider">
                    <div class="slide">
                        <img src="assets/img/banner-1.png" alt="banner">
                    </div>
                    <div class="slide">
                        <img src="assets/img/banner-2.png" alt="banner">
                    </div>
                    <div class="slide">
                        <img src="assets/img/banner-3.png" alt="banner">
                    </div>
                </div>
                <button class="slider-button prev rounded-2" onclick="prevSlide()">&#10094;</button>
                <button class="slider-button next rounded-2" onclick="nextSlide()">&#10095;</button>
            </div>
        </div>

        <div class="title">
            <h1 class="fw-bold fs-4 mb-0 ps-3 py-3 section-title">Kategori teratas</h1>
        </div>

        <div class="top-categories bg-light py-3 rounded-3 border">
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

    <section class="promo-container container">
        <div class="promo-wrapper">
            <div class="promo">
                <div class="promo-title">
                    <h1 class="fw-bold fs-4 ps-3 pt-5 pb-4 mb-0 section-title">Promo spesial kemerdekaan</h1>
                </div>
                <div class="promo-content px-5 overflow-hidden d-flex align-items-center">
                    <div class="promo-info-card p-5 rounded-3">
                        <img src="assets/img/promo-info.png" alt="">
                    </div>
                    <div class="promo-list d-flex gap-3">
                        <div class="promo-product-card overflow-hidden rounded-3 border">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-1 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <div class="price-discount d-flex align-items-center gap-2">
                                    <p class="fw-bold fs-6 mb-0">Rp. 10.000</p>
                                    <!-- label discount percent -->
                                    <span class="badge rounded-pill bg-danger-transparent">-10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="promo-product-card overflow-hidden rounded-3 border">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-1 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <div class="price-discount d-flex align-items-center gap-2">
                                    <p class="fw-bold fs-6 mb-0">Rp. 10.000</p>
                                    <!-- label discount percent -->
                                    <span class="badge rounded-pill bg-danger-transparent">-10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="promo-product-card border overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-1 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <div class="price-discount d-flex align-items-center gap-2">
                                    <p class="fw-bold fs-6 mb-0">Rp. 10.000</p>
                                    <!-- label discount percent -->
                                    <span class="badge rounded-pill bg-danger-transparent">-10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="promo-product-card border overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-1 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <div class="price-discount d-flex align-items-center gap-2">
                                    <p class="fw-bold fs-6 mb-0">Rp. 10.000</p>
                                    <!-- label discount percent -->
                                    <span class="badge rounded-pill bg-danger-transparent">-10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product container">
        <div class="product-wrapper">
            <div class="product">
                <div class="product-title">
                    <h1 class="fw-bold fs-4 ps-3 pt-5 pb-4 mb-0 section-title">Tumbass</h1>
                </div>
                <div class="product-content">
                    <div class="product-list">
                        <?php foreach ($products as $product) : ?>
                        <div class="product-card">
                            <div class="product-card-image">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="product-image">
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