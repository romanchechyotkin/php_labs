<?php

function random_pass($length) {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i < $length) {
        $num = rand() % 60;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

$result = "";
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
    <h2>Введите длину пароля</h2>
    <form method="POST">
        <label for="min">длина:</label>
        <input type="number" name="min" required>
        <button type="submit">Сгенерировать</button>
    </form>
    <h3><?php echo $result; ?></h3>
</body>
</html>
