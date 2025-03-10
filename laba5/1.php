<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product'])) {
    $product = htmlspecialchars($_POST['product']);
    $_SESSION['cart'][] = $product;
}

if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина товаров</title>
</head>
<body>
    <h2>Добавить товар в корзину</h2>
    <form method="POST">
        <input type="text" name="product" placeholder="Введите название товара" required>
        <button type="submit">Добавить</button>
    </form>

    <h2>Содержимое корзины:</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>

    <form method="POST">
        <button type="submit" name="clear">Очистить корзину</button>
    </form>
</body>
</html>
