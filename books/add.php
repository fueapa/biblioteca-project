<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
    $stmt->execute([$title, $author, $year]);

    header("Location: list.php");
    exit();
}
?>

<h2>Agregar Libro</h2>
<form method="POST">
    <label>Título:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Autor:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Año:</label><br>
    <input type="number" name="year"><br><br>

    <button type="submit">Guardar</button>
</form>

<?php include '../footer.php'; ?>
