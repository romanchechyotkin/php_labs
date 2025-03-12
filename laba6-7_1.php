<?php
session_start();

class Vehicle {
    public $brand;
    public $model;
    public $year;

    public function __construct($brand, $model, $year) {
        if (!is_numeric($year) || $year <= 0) {
            throw new Exception("Год выпуска должен быть положительным числом.");
        }

        $this->brand = htmlspecialchars($brand);
        $this->model = htmlspecialchars($model);
        $this->year = (int)$year;
    }

    public function displayVehicle() {
        return "<p><strong>Марка:</strong> $this->brand <br>
                <strong>Модель:</strong> $this->model <br>
                <strong>Год выпуска:</strong> $this->year</p>";
    }
}

$vehicleList = $_SESSION['vehicles'] ?? [];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['brand'], $_POST['model'], $_POST['year'])) {
    try {
        $vehicle = new Vehicle($_POST['brand'], $_POST['model'], $_POST['year']);
        $_SESSION['vehicles'][] = $vehicle;
        $vehicleList = $_SESSION['vehicles'];
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить транспортное средство</title>
</head>
<body>
    <h2>Добавить транспортное средство</h2>
    <form method="POST">
        <label>Марка:</label>
        <input type="text" name="brand" required><br><br>

        <label>Модель:</label>
        <input type="text" name="model" required><br><br>

        <label>Год выпуска:</label>
        <input type="number" name="year" required><br><br>

        <button type="submit">Добавить</button>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><strong>Ошибка:</strong> <?= $error ?></p>
    <?php endif; ?>

    <h2>Список транспортных средств:</h2>
    <?php 
    if (!empty($vehicleList)) {
        foreach ($vehicleList as $vehicle) {
            echo $vehicle->displayVehicle();
        }
    } else {
        echo "<p>Транспортные средства отсутствуют.</p>";
    }
    ?>
</body>
</html>
