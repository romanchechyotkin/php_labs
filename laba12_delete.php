<?php
require 'laba10.php';

$id = $_GET['id'];
if (!$id) {
    die("Некорректный ID!");
}

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: laba12_index.php");
exit();
?>
