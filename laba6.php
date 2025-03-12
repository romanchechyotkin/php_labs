<?php
class Product {
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotalCost() {
        return $this->price * $this->quantity;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $errors = [];

    if ($name === '') {
        $errors[] = "Наименование товара не может быть пустым.";
    }
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Цена должна быть положительным числом.";
    }
    if (!is_numeric($quantity) || $quantity <= 0) {
        $errors[] = "Количество должно быть положительным числом.";
    }

    if (empty($errors)) {
        $product = new Product($name, $price, $quantity);
        echo "Общая стоимость товара: " . $product->getTotalCost();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>

<form action="" method="POST">
    <label for="name">Наименование товара:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="price">Цена:</label><br>
    <input type="number" id="price" name="price"  required><br>
    <label for="quantity">Количество:</label><br>
    <input type="number" id="quantity" name="quantity"  required><br><br>
    <input type="submit" value="Рассчитать общую стоимость">
</form>
