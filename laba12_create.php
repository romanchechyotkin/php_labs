<?php
require 'laba10.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($name) || empty($price)) {
        die("Название и цена обязательны!");
    }
    if (!is_numeric($price) || $price <= 0) {
        die("Некорректная цена!");
    }

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
    $stmt->execute([
        ':name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
        ':description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
        ':price' => $price
    ]);

    header("Location: laba12_index.php");
    exit();
}
?>

<form method="post">
    Название: <input type="text" name="name" required><br>
    Описание: <textarea name="description"></textarea><br>
    Цена: <input type="number" name="price" step="0.01" required><br>
    <button type="submit">Добавить</button>
</form>
