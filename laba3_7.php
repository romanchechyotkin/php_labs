<?php
# Создайте массив строк, представляющих даты в формате "ГГГГ-ММ-ДД".
# Напишите функцию, которая преобразует даты в формат "ДД.ММ.ГГГГ".

$dates = array("2025-03-02", "2025-03-01", "2025-12-31",);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $len = isset($_POST["min"]) ? (int)$_POST["min"] : 1;
    $result = random_pass($len);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор случайных паролей</title>
</head>
<body>
    <h2>даты</h2>
    <ul><?php  
        foreach($dates as $k => $v) {
            echo "<li>" . $v . "</li>";
        }
    ?></ul>
    <h2>отформатированные даты</h2>
    <ul><?php  
        foreach($dates as $k => $v) {
          $timestamp = strtotime($v);
          echo "<li>" . date('d-m-Y', $timestamp) . "</li>";
        }
    ?></ul>
</body>
</html>
