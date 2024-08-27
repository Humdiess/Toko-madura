<?php
include 'utils/db.php';
include('themes/home/header.php');

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero container py-3">
    <div class="hero-wrapper">
        <div class="category-selector align-items-center gap-2 mb-3">
            <p class="text-center mb-0">Kategori pilihan : </p>
            <ul class="category-list nav gap-3">
                <li class="nav-item"><a href="./detail.php">Sabun</a></li>
                <li class="nav-item"><a href="#">Bumbu dapur</a></li>
                <li class="nav-item"><a href="#">Minuman</a></li>
                <li class="nav-item"><a href="#">Peralatan dapur</a></li>
            </ul>
        </div>
        <div class="slider-container overflow-hidden rounded-3">
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
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Alat'">
                <div class="category-card-icon">
                    <i class="fas fa-utensils h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Alat">Alat</a>
                </div>
            </div>
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Minuman'">
                <div class="category-card-icon">
                    <i class="fas fa-bottle-droplet h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Minuman">Minuman</a>
                </div>
            </div>
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Snack'">
                <div class="category-card-icon">
                    <i class="fas fa-cookie-bite h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Snack">Snack</a>
                </div>
            </div>
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Beras'">
                <div class="category-card-icon">
                    <i class="fas fa-bowl-rice h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Beras">Beras</a>
                </div>
            </div>
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Minyak'">
                <div class="category-card-icon">
                    <i class="fas fa-oil-can h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Minyak">Minyak</a>
                </div>
            </div>
            <div class="category-card bg-light d-flex flex-column align-items-center" onclick="window.location.href='category.php?category=Sabun'">
                <div class="category-card-icon">
                    <i class="fas fa-soap h2 mb-2"></i>
                </div>
                <div class="category-card-title">
                    <a href="category.php?category=Sabun">Sabun</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="promo-container py-5 text-dark ">
    <div class="promo-wrapper container text-center">
        <div class="promo">
            <div class="promo-header mb-4">
                <h1 class="promo-title fw-bold fs-3 text-white">Rayakan Kemerdekaan dengan Diskon Merdeka 17%!</h1>
            </div>
            <div class="promo-content d-flex justify-content-center">
                <div class="promo-list">
                    <?php foreach ($products as $product) : ?>
                        <div class="promo-product-card rounded-lg-4 border position-relative overflow-hidden" onclick="window.location.href='detail.php?id=<?php echo $product['id']; ?>' ">
                            <div class="discount-badge position-absolute top-0 start-0 text-white p-2 rounded-end">-17%</div>
                            <div class="promo-product-card-image">
                                <img src="<?php echo get_product_image_src($product['images']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>

                            <div class="promo-product-card-content p-3 text-start bg-white">
                                <h5 class="promo-product-name text-dark mb-1"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <div class="promo-product-pricing d-flex align-items-center">
                                    <p class="promo-product-price mb-0 text-success fw-bold"><?php echo format_rupiah($product['price']); ?></p>
                                    <p class="promo-product-original-price mb-0 text-muted ms-2 text-decoration-line-through">Rp. 15.000</p>
                                </div>
                                <p class="promo-product-location mb-2 text-secondary"><i class="fas fa-map-marker-alt"></i> Jakarta</p>
                                <div class="promo-product-rating d-flex align-items-center gap-1 text-warning">
                                    <i class="fas fa-star"></i><span class="rating-value">4.5</span><span class="rating-count text-muted">(200 ulasan)</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                        <div class="product-card rounded-3 border" onclick="window.location.href='detail.php?id=<?php echo $product['id']; ?>' ">
                            <div class="product-card-image">
                                <img src="<?php echo get_product_image_src($product['images']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                            <div class="product-card-content">
                                <h5 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="product-price mb-0">Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
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

<nav class="bottom-tab-bar d-md-none py-2 fixed-bottom container">
    <ul class="nav justify-content-between container">
        <li class="nav-item d-flex flex-column justify-content-center align-items-center">
            <a class="nav-link active mb-0" href="#">
                <i class="fas fa-home"></i>
                Home
            </a>
        </li>
        <li class="nav-item d-flex flex-column justify-content-center align-items-center">
            <a class="nav-link mb-0" href="#">
                <i class="fas fa-search"></i>
                Search
            </a>
        </li>
        <li class="nav-item d-flex flex-column justify-content-center align-items-center">
            <a class="nav-link mb-0" href="#">
                <i class="fas fa-shopping-cart"></i>
                Cart
            </a>
        </li>
        <li class="nav-item d-flex flex-column justify-content-center align-items-center">
            <a class="nav-link mb-0" href="#">
                <i class="fas fa-user"></i>
                Profile
            </a>
        </li>
    </ul>
</nav>

<button onclick="topFunction()" id="backToTopBtn" class="btn btn-danger">
    <i class="fas fa-arrow-up"></i>
</button>

<?php include 'themes/home/footer.php'; ?>
