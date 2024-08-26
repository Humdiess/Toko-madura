<?php
    function get_product_image_src($images, $defaultImage = 'assets/img/default/default_image.png') {
        $imagePaths = explode(',', $images); 
        $imageSrc = !empty($imagePaths[0]) ? "assets/img/product/" . htmlspecialchars($imagePaths[0]) : $defaultImage;
        return $imageSrc;
    }

    function getProductsByCategory($pdo, $categoryName) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = ?)");
        $stmt->execute([$categoryName]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function format_rupiah($number) {
        return 'Rp. ' . number_format($number, 0, ',', '.');
    }    
?>