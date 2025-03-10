<?php
$cookie_name = "visit_time";
$visit_time = date("Y-m-d H:i:s");

// Установка cookie на 24 часа
setcookie($cookie_name, $visit_time, time() + 86400, "/");

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Последнее посещение</title>
</head>
<body>
    <h2>Добро пожаловать!</h2>
    <?php
    if (isset($_COOKIE[$cookie_name])) {
        echo "<p>Ваше последнее посещение: " . $_COOKIE[$cookie_name] . "</p>";
    } else {
        echo "<p>Это ваш первый визит!</p>";
    }
    ?>
</body>
</html>
