<?php include '../themes/admin/header.php'; ?>
<?php
include '../utils/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id']; 
    $images = $_FILES['images'];

    $targetDir = "../assets/img/product/";
    $imagePaths = [];

    for ($i = 0; $i < count($images['name']); $i++) {
        $targetFile = $targetDir . basename($images["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($images["tmp_name"][$i]);
        if ($check === false) {
            $uploadOk = 0;
            echo "File " . $images["name"][$i] . " is not an image.";
        }

        if ($images["size"][$i] > 5000000) {
            $uploadOk = 0;
            echo "Sorry, your file " . $images["name"][$i] . " is too large.";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for file " . $images["name"][$i] . ".";
        }

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

    $imagePathsString = implode(',', $imagePaths);
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, images, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $imagePathsString, $category_id]);

    header('Location: index.php');
    exit();
}

$stmt = $pdo->query("SELECT products.*, categories.name as category_name FROM products JOIN categories ON products.category_id = categories.id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1>Manage Products</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">
        Add Product
    </button>

    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category:</label>
                            <select name="category_id" id="category" class="form-select" required>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM categories");
                                while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=\"" . htmlspecialchars($category['id']) . "\">" . htmlspecialchars($category['name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Images:</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2>Existing Products</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">Price: <?php echo htmlspecialchars($product['price']); ?></p>
                        <p class="card-text">Category: <?php echo htmlspecialchars($product['category_name']); ?></p>
                        <?php $imagePaths = explode(',', $product['images']); ?>
                        <?php foreach ($imagePaths as $imagePath): ?>
                            <img src="../assets/img/product/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid mb-2">
                        <?php endforeach; ?>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">
                            Edit
                        </button>
                        <form action="delete_product.php" method="get" class="d-inline">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="edit_product.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel<?php echo $product['id']; ?>">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea name="description" id="description" class="form-control" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price:</label>
                                    <input type="number" name="price" id="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category:</label>
                                    <select name="category_id" id="category" class="form-select" required>
                                        <?php
                                        $stmt = $pdo->query("SELECT * FROM categories");
                                        while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = $category['id'] == $product['category_id'] ? 'selected' : '';
                                            echo "<option value=\"" . htmlspecialchars($category['id']) . "\" $selected>" . htmlspecialchars($category['name']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Images:</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../themes/admin/footer.php'; ?>
