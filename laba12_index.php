<?php
require 'laba10.php';

$products = $pdo->query("SELECT * FROM products")->fetchAll();
?>

<a href="laba12_create.php">Добавить новый продукт</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= $product['price'] ?></td>
            <td>
                <a href="laba12_update.php?id=<?= $product['id'] ?>">Редактировать</a>
                <a href="laba12_delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Удалить?');">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
