<?php
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $images = $_FILES['images'];

    $targetDir = "../assets/img/";
    $imagePaths = [];

    // Get existing images
    $stmt = $pdo->prepare("SELECT images FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $existingImages = explode(',', $product['images']);

    // Process new images
    for ($i = 0; $i < count($images['name']); $i++) {
        if (empty($images['tmp_name'][$i])) {
            continue; // Skip if no file is uploaded
        }

        $targetFile = $targetDir . basename($images["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($images["tmp_name"][$i]);
        if ($check === false) {
            $uploadOk = 0;
            echo "File " . $images["name"][$i] . " is not an image.";
            continue;
        }

        // Check file size (limit to 5MB)
        if ($images["size"][$i] > 5000000) {
            $uploadOk = 0;
            echo "Sorry, your file " . $images["name"][$i] . " is too large.";
            continue;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for file " . $images["name"][$i] . ".";
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file " . $images["name"][$i] . " was not uploaded.";
            continue;
        } else {
            if (move_uploaded_file($images["tmp_name"][$i], $targetFile)) {
                $imagePaths[] = basename($images["name"][$i]);
            } else {
                echo "Sorry, there was an error uploading your file " . $images["name"][$i] . ".";
            }
        }
    }

    // Merge existing images with new images
    $updatedImages = array_merge($existingImages, $imagePaths);
    $imagePathsString = implode(',', $updatedImages);

    // Update product
    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, images = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $imagePathsString, $product_id]);

    header('Location: index.php');
    exit();
}

$product_id = $_GET['product_id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
$imagePaths = explode(',', $product['images']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="edit_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        <br>
        <label for="images">Upload New Images:</label>
        <input type="file" name="images[]" id="images" multiple>
        <br>
        <button type="submit">Update Product</button>
    </form>

    <h2>Current Images</h2>
    <?php foreach ($imagePaths as $imagePath): ?>
        <?php if (!empty($imagePath)): ?>
            <img src="../assets/img/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
