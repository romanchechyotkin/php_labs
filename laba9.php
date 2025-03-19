<?php
session_start();

class Book {
    public string $title;
    public string $author;
    public int $year;

    public function __construct(string $title, string $author, int $year) {
        if ($year <= 0) {
            throw new Exception("Год выпуска должен быть положительным числом.");
        }
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }
}

class BookCollection implements Iterator {
    private array $books = [];
    private int $index = 0;

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function getBooks(): array {
        return $this->books;
    }

    public function current(): mixed {
        return $this->books[$this->index];
    }

    public function key(): mixed {
        return $this->index;
    }

    public function next(): void {
        $this->index++;
    }

    public function rewind(): void {
        $this->index = 0;
    }

    public function valid(): bool {
        return isset($this->books[$this->index]);
    }


}

if (!isset($_SESSION['book_collection'])) {
    $_SESSION['book_collection'] = serialize(new BookCollection());
}
$bookCollection = unserialize($_SESSION['book_collection']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $year = intval($_POST['year']);

        $newBook = new Book($title, $author, $year);
        $bookCollection->addBook($newBook);

        $_SESSION['book_collection'] = serialize($bookCollection);
    } catch (Exception $e) {
        echo "<p style='color:red;'>Ошибка: " . $e->getMessage() . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Коллекция книг</title>
</head>
<body>

<h2>Добавить книгу</h2>
<form method="post">
    <label>Название: <input type="text" name="title" required></label><br><br>
    <label>Автор: <input type="text" name="author" required></label><br><br>
    <label>Год выпуска: <input type="number" name="year" required></label><br><br>
    <button type="submit">Добавить</button>
</form>

<h2>Список книг</h2>
<ul>
    <?php foreach ($bookCollection as $book): ?>
        <li>
            <strong><?= htmlspecialchars($book->title) ?></strong> - 
            <?= htmlspecialchars($book->author) ?> (<?= $book->year ?>)
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
