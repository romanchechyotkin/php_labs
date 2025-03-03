<?php
function generateRandomNumber($min, $max) {
    return rand($min, $max);
}

$result = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $min = isset($_POST["min"]) ? (int)$_POST["min"] : 1;
    $max = isset($_POST["max"]) ? (int)$_POST["max"] : 100;
    
    if ($min <= $max) {
        $result = "Случайное число: " . generateRandomNumber($min, $max);
    } else {
        $result = "Ошибка: Минимальное значение должно быть меньше или равно максимальному.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор случайных чисел</title>
</head>
<body>
    <h2>Введите диапазон для случайного числа</h2>
    <form method="POST">
        <label for="min">Минимум:</label>
        <input type="number" name="min" required>
        <label for="max">Максимум:</label>
        <input type="number" name="max" required>
        <button type="submit">Сгенерировать</button>
    </form>
    <h3><?php echo $result; ?></h3>
</body>
</html>
