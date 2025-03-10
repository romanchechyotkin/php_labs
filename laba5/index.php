<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product"])) {
    $_SESSION['cart'][] = $_POST["product"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $_POST["username"];
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
}

setcookie("visit_time", date("Y-m-d H:i:s"), time() + 24 * 3600);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
</head>
<body>

<h1>Добро пожаловать в наш онлайн магазин!</h1>

<?php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    echo '<p>Здравствуйте, ' . $_SESSION['username'] . '! <form method="post" action=""><input type="submit" name="logout" value="Выход"></form></p>';
} else {
    echo '
    <form method="post" action="">
        <label for="username">Имя пользователя:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Войти">
    </form>
    ';
}


echo '
<h2>Добавление товара в корзину:</h2>
<form method="post" action="">
    <label for="product">Введите название товара:</label><br>
    <input type="text" id="product" name="product"><br>
    <input type="submit" value="Добавить в корзину">
</form>
';


echo '<h2>Корзина покупок:</h2>';
echo '<ul>';
if(isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        echo '<li>' . $item . '</li>';
    }
}
echo '</ul>';

if (isset($_COOKIE["visit_time"])) {
    echo "<p>Время последнего посещения: " . $_COOKIE["visit_time"] . "</p>";
} else {
    echo "<p>Это ваш первый визит на сайт!</p>";
}
?>

</body>
</html>
