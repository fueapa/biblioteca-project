<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM books WHERE id=?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];

    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, publisher=?, year=? WHERE id=?");
    $stmt->execute([$title, $author, $publisher, $year, $id]);

    header("Location: list.php");
    exit();
}
?>

<h2>Editar Libro</h2>
<form method="POST">
    <input type="text" name="title" value="<?= $book['title']; ?>" required>
    <input type="text" name="author" value="<?= $book['author']; ?>" required>
    <input type="text" name="publisher" value="<?= $book['publisher']; ?>" required>
    <input type="number" name="year" value="<?= $book['year']; ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../footer.php'; ?>
