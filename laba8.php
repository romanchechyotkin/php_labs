<?php
trait UppercaseText {
    public function toUpperCase($text) {
        return strtoupper($text);
    }
}

trait UniqueID {
    public function generateID() {
        return uniqid();
    }
}

trait PositiveNumberCheck {
    public function isPositive($number) {
        return is_numeric($number) && $number > 0;
    }
}

namespace User;

class Validator {
    public function isString($input) {
        return is_string($input);
    }
}

namespace;

trait FileHandler {
    public function writeToFile($filename, $data) {
        file_put_contents($filename, $data);
    }

    public function readFromFile($filename) {
        return file_exists($filename) ? file_get_contents($filename) : null;
    }
}

trait DateFormatter {
    public function formatCurrentDate($format = "Y-m-d H:i:s") {
        return date($format);
    }
}

class Utility {
    use UppercaseText, UniqueID, PositiveNumberCheck, FileHandler, DateFormatter;
}

$util = new Utility();

echo "Верхний регистр: " . $util->toUpperCase("hello world") . "<br>";
echo "Уникальный ID: " . $util->generateID() . "<br>";
echo "Число 10 положительное? " . ($util->isPositive(10) ? "Да" : "Нет") . "<br>";

$filename = "example.txt";
$util->writeToFile($filename, "Привет, мир!");
echo "Прочитано из файла: " . $util->readFromFile($filename) . "<br>";

echo "Текущая дата: " . $util->formatCurrentDate() . "<br>";

// Проверка метода в пространстве имен User
$userValidator = new \User\Validator();
echo "Строка 'Hello' является строкой? " . ($userValidator->isString("Hello") ? "Да" : "Нет") . "<br>";
?>
