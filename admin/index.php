<?php
include '../utils/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id']; // Get the category ID from the form
    $images = $_FILES['images'];

    $targetDir = "../assets/img/product/";
    $imagePaths = [];

    // Loop through each file
    for ($i = 0; $i < count($images['name']); $i++) {
        $targetFile = $targetDir . basename($images["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($images["tmp_name"][$i]);
        if ($check === false) {
            $uploadOk = 0;
            echo "File " . $images["name"][$i] . " is not an image.";
        }

        // Check file size (limit to 5MB)
        if ($images["size"][$i] > 5000000) {
            $uploadOk = 0;
            echo "Sorry, your file " . $images["name"][$i] . " is too large.";
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for file " . $images["name"][$i] . ".";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file " . $images["name"][$i] . " was not uploaded.";
        } else {
            if (move_uploaded_file($images["tmp_name"][$i], $targetFile)) {
                $imagePaths[] = basename($images["name"][$i]);
            } else {
                echo "Sorry, there was an error uploading your file " . $images["name"][$i] . ".";
            }
        }
    }

    // Insert product with image paths and category_id
    $imagePathsString = implode(',', $imagePaths);
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, images, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $imagePathsString, $category_id]);

    header('Location: index.php');
    exit();
}

$stmt = $pdo->query("SELECT products.*, categories.name as category_name FROM products JOIN categories ON products.category_id = categories.id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>Welcome, <?php echo $_SESSION['role']; ?>!</p>
    <a href="../logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
        <br>
        <label for="category">Category:</label>
        <select name="category_id" id="category" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM categories");
            while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=\"" . htmlspecialchars($category['id']) . "\">" . htmlspecialchars($category['name']) . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="images">Images:</label>
        <input type="file" name="images[]" id="images" multiple required>
        <br>
        <button type="submit">Add Product</button>
    </form>

    <h2>Existing Products</h2>
    <div>
        <?php foreach ($products as $product): ?>
            <div>
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                <p>Category: <?php echo htmlspecialchars($product['category_name']); ?></p>
                <?php $imagePaths = explode(',', $product['images']); ?>
                <?php foreach ($imagePaths as $imagePath): ?>
                    <img src="../assets/img/product/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
                <?php endforeach; ?>
                <a href="edit_product.php?product_id=<?php echo $product['id']; ?>">Edit</a>
                <form action="delete_product.php" method="get">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <button type="submit">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
