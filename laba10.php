<?php
$host = '127.0.0.1';
$dbname = 'software_store';
$user = 'user';
$pass = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    echo "Успешное подключение к базе данных!";
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>
