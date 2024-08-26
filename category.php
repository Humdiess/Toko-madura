<?php
include 'utils/db.php';
include 'config/helper.php';
include('themes/header.php');

// Ambil kategori dari URL
$selectedCategory = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';

// Ambil produk berdasarkan kategori
$products = getProductsByCategory($pdo, $selectedCategory);
?>

<section class="product container mt-5">
    <div class="product-wrapper">
        <div class="product">
            <div class="product-header mb-3 d-flex justify-content-between">
                <h1 class="fw-medium fs-5">
                    <?php 
                    if ($products) {
                        echo "Produk dengan kategori " . $selectedCategory;
                    } else {
                        echo "Tidak ada produk yang ditemukan untuk kategori " . $selectedCategory;
                    }
                    ?>
                </h1>
            </div>
            <div class="product-content">
                <div class="product-list">
                    <?php if ($products): ?>
                        <?php foreach ($products as $product) : ?>
                            <div class="product-card rounded-4 border" onclick="window.location.href='detail.php?id=<?php echo $product['id']; ?>' ">
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
                    <?php else: ?>
                        <!-- Tidak ada produk, jadi tidak ada yang ditampilkan di sini -->
                    <?php endif; ?>
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

<?php include 'themes/footer.php'; ?>
