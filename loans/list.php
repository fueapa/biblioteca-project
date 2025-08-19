<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

// Listar todos los préstamos
$stmt = $conn->query("SELECT l.id, b.title, u.username, l.loan_date, l.returned, l.return_date
                      FROM loans l
                      JOIN books b ON l.book_id = b.id
                      JOIN users u ON l.user_id = u.id
                      ORDER BY l.loan_date DESC");
$loans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Historial de Préstamos</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Usuario</th>
        <th>Fecha de préstamo</th>
        <th>Devuelto</th>
        <th>Fecha de devolución</th>
    </tr>
    <?php foreach($loans as $loan): ?>
    <tr>
        <td><?= $loan['id']; ?></td>
        <td><?= $loan['title']; ?></td>
        <td><?= $loan['username']; ?></td>
        <td><?= $loan['loan_date']; ?></td>
        <td><?= $loan['returned'] ? 'Sí' : 'No'; ?></td>
        <td><?= $loan['return_date'] ?? '-'; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include '../footer.php'; ?>
