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

    <!-- aos -->
    <link href="node_modules/aos/dist/aos.css" rel="stylesheet">
    

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Javanese:wght@400..700&display=swap" rel="stylesheet">

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

        <div class="top-categories mt-4 bg-light py-3 rounded-4">
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

    <section class="promo container">
        <div class="promo-wrapper my-5 pt-5">
            <div class="promo">
                <div class="promo-title">
                    <h1 class="promo-title-text h4">Promo terbatas</h1>
                </div>
                <div class="promo-content px-4 d-flex align-items-center mt-4">
                    <div class="promo-info rounded-4 position-relative overflow-hidden p-2 d-flex align-items-center">
                        <img src="assets/img/promo-info.png" alt="">
                    </div>
                    <div class="promo-list d-flex gap-2">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/navbar.js"></script>
    <script src="assets/js/banner.js"></script>
    <script src="assets/js/splash.js"></script>
    <script src="node_modules/aos/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>