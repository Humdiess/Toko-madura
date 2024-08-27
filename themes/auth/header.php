<?php
    include '../utils/db.php';
    include_once '../config/helper.php';
    
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/banner.css">
    <link rel="stylesheet" href="assets/css/category.css">
    <link rel="stylesheet" href="assets/css/splash.css">
    <link rel="stylesheet" href="assets/css/promo.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- aos -->
    <link href="node_modules/aos/dist/aos.css" rel="stylesheet">
    
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">

    <!-- icon -->
    <script src="https://kit.fontawesome.com/cff8b87f33.js" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/img/default/app-logo.png">
    <title>Madura</title>
</head>
<body>  

    <div class="content h-100">