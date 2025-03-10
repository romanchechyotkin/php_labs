<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выход</title>
</head>
<body>
    <h2>Выход из системы</h2>
    <form method="POST">
        <button type="submit" name="logout">Выйти</button>
    </form>
</body>
</html>
