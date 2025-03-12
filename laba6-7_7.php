<?php
session_start();

class Book {
    public $title;
    public $author;
    public $year;

    public function __construct($title, $author, $year) {
        if (!is_numeric($year) || $year <= 0) {
            throw new Exception("Год выпуска должен быть положительным числом.");
        }

        $this->title = htmlspecialchars($title);
        $this->author = htmlspecialchars($author);
        $this->year = (int)$year;
    }

    public function displayBook() {
        return "<p><strong>Название:</strong> $this->title <br>
                <strong>Автор:</strong> $this->author <br>
                <strong>Год выпуска:</strong> $this->year</p>";
    }
}

$bookList = $_SESSION['books'] ?? [];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'], $_POST['author'], $_POST['year'])) {
    try {
        $book = new Book($_POST['title'], $_POST['author'], $_POST['year']);
        $_SESSION['books'][] = $book;
        $bookList = $_SESSION['books'];
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
</head>
<body>
    <h2>Добавить книгу</h2>
    <form method="POST">
        <label>Название книги:</label>
        <input type="text" name="title" required><br><br>

        <label>Автор:</label>
        <input type="text" name="author" required><br><br>

        <label>Год выпуска:</label>
        <input type="number" name="year" required><br><br>

        <button type="submit">Добавить</button>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><strong>Ошибка:</strong> <?= $error ?></p>
    <?php endif; ?>

    <h2>Список книг:</h2>
    <?php 
    if (!empty($bookList)) {
        foreach ($bookList as $book) {
            echo $book->displayBook();
        }
    } else {
        echo "<p>Книг пока нет.</p>";
    }
    ?>
</body>
</html>
