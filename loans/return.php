<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

// Registrar devolución
if(isset($_GET['loan_id'])){
    $loan_id = $_GET['loan_id'];
    $stmt = $conn->prepare("UPDATE loans SET returned=1, return_date=NOW() WHERE id=?");
    $stmt->execute([$loan_id]);
    echo "<p class='success'>Devolución registrada correctamente</p>";
}

// Listar préstamos activos
$stmt = $conn->query("SELECT l.id, b.title, u.username, l.loan_date
                      FROM loans l
                      JOIN books b ON l.book_id = b.id
                      JOIN users u ON l.user_id = u.id
                      WHERE l.returned = 0");
$loans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Registrar Devolución</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Usuario</th>
        <th>Fecha de préstamo</th>
        <th>Acción</th>
    </tr>
    <?php foreach($loans as $loan): ?>
    <tr>
        <td><?= $loan['id']; ?></td>
        <td><?= $loan['title']; ?></td>
        <td><?= $loan['username']; ?></td>
        <td><?= $loan['loan_date']; ?></td>
        <td>
            <a class="btn" href="return.php?loan_id=<?= $loan['id']; ?>" onclick="return confirm('¿Registrar devolución?');">Devolver</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include '../footer.php'; ?>
