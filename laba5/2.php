<?php
session_start();

$users = ['admin' => 'password123', 'user' => '12345'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username] == $password) {
        $_SESSION['user'] = $username;
    } else {
        $error = "Неверные учетные данные!";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Аутентификация</title>
</head>
<body>
    <?php if (!isset($_SESSION['user'])): ?>
        <h2>Вход</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php else: ?>
        <h2>Привет, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
        <form method="POST">
            <button type="submit" name="logout">Выход</button>
        </form>
    <?php endif; ?>
</body>
</html>
