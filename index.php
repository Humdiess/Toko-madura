<?php
$jsonFilePath = 'utils/data.json';

$jsonData = file_get_contents($jsonFilePath);

$products = json_decode($jsonData, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/banner.css">
    <link rel="stylesheet" href="assets/css/category.css">
    <link rel="stylesheet" href="assets/css/splash.css">
    <link rel="stylesheet" href="assets/css/promo.css">
    <link rel="stylesheet" href="assets/css/product.css">

    <!-- aos -->
    <link href="node_modules/aos/dist/aos.css" rel="stylesheet">
    
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- icon -->
    <script src="https://kit.fontawesome.com/cff8b87f33.js" crossorigin="anonymous"></script>
    <title>Madura</title>
</head>
<body>  
    <?php include('components/splash-screen.php') ?>

    <header class="d-flex justify-content-center">
        <?php include('components/navbar.php');  ?>
    </header>

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
            <div class="slider-container overflow-hidden rounded-4">
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
            <h1 class="fw-bold fs-4 mb-0 ps-3 py-3">Kategori teratas</h1>
        </div>

        <div class="top-categories bg-light py-3 rounded-4 border">
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
                    <h1 class="fw-bold fs-4 ps-3 pt-5 pb-4 mb-0">Promo spesial kemerdekaan</h1>
                </div>
                <div class="promo-content px-5 overflow-hidden d-flex align-items-center">
                    <div class="promo-info-card p-5 rounded-4">
                        <img src="assets/img/promo-info.png" alt="">
                    </div>
                    <div class="promo-list d-flex gap-3">
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light border">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
                            </div>
                        </div>
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
                            </div>
                        </div>
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
                            </div>
                        </div>
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
                            </div>
                        </div>
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
                            </div>
                        </div>
                        <div class="promo-product-card border shadow-sm overflow-hidden rounded-3">
                            <div class="promo-product-card-image bg-light">
                                <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="">
                            </div>
                            <div class="promo-product-card-title p-2">
                                <p class="mb-3 word-break">Sabun colek ukuran 200ml warna biru</p>
                                <p class="text-decoration-line-through mb-0">Rp. 13.000</p>
                                <p class="fw-bold fs-5">Rp. 10.000</p>
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
                    <h1 class="fw-bold fs-4 ps-3 pt-5 pb-4 mb-0">Tumbass</h1>
                </div>
                <div class="product-content">
                    <div class="product-list">
                    <?php foreach ($products as $product) : ?>
                        <div class="product-card border shadow-sm overflow-hidden rounded-4">
                            <div class="product-card-image">
                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//91/MTA-26202726/no-brand_no-brand_full01.jpg" alt="product-image" loading="lazy">
                            </div>
                            <div class="product-card-title p-2">
                                <p class="mb-2 word-break"><?php echo htmlspecialchars($product['nama']); ?></p>
                                <!-- rating -->
                                <div class="rating d-flex align-items-center gap-2">
                                    <i class="fas fa-star text-warning"></i>
                                    <p class="mb-0 ms-1">4.5</p>
                                </div>
                                <p class="card-price fw-bold fs-5">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('constant/script.php') ?>
</body>
</html>