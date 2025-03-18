<?php
require 'laba10.php';

$id = $_GET['id'];
$product = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$product->execute([$id]);
$product = $product->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($name) || empty($price) || !is_numeric($price) || $price <= 0) {
        die("Некорректные данные!");
    }

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([
        htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
        $price,
        $id
    ]);

    header("Location: laba12_index.php");
    exit();
}
?>

<form method="post">
    Название: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
    Описание: <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>
    Цена: <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" required><br>
    <button type="submit">Сохранить</button>
</form>
