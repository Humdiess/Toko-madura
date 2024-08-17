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
    <link rel="stylesheet" href="assets/css/global.css">
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

    <div class="content">