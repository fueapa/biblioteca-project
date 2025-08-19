<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Gestión de Libros</h2>
<a href="add.php"> Agregar libro</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Año</th>
        <th>Acciones</th>
    </tr>
    <?php foreach($books as $book): ?>
    <tr>
        <td><?= $book['id']; ?></td>
        <td><?= $book['title']; ?></td>
        <td><?= $book['author']; ?></td>
        <td><?= $book['year']; ?></td>
        <td>
            <a href="edit.php?id=<?= $book['id']; ?>">✏️ Editar</a> | 
            <a href="delete.php?id=<?= $book['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">🗑 Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include '../footer.php'; ?>
