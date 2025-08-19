<?php
include '../header.php';
include '../config.php';

// Traer todos los libros disponibles
$stmt = $conn->query("SELECT * FROM books WHERE available=1");
$availableBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traer todos los usuarios (solo para admin, opcional)
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Registrar préstamo
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id']; // usuario actual
    $start_date = date('Y-m-d');
    $return_date = $_POST['return_date'];

    // Insertar préstamo
    $stmt = $conn->prepare("INSERT INTO loans (user_id, book_id, start_date, return_date, returned) VALUES (?, ?, ?, ?, 0)");
    $stmt->execute([$user_id, $book_id, $start_date, $return_date]);

    // Cambiar libro a no disponible
    $conn->prepare("UPDATE books SET available=0 WHERE id=?")->execute([$book_id]);

    echo "<p class='success'>Préstamo registrado con éxito</p>";
}

// Traer préstamos actuales
$stmt = $conn->query("SELECT l.id, b.title, u.username, l.start_date, l.return_date 
                      FROM loans l 
                      JOIN books b ON l.book_id=b.id 
                      JOIN users u ON l.user_id=u.id
                      WHERE l.returned=0");
$loans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Registrar Préstamo</h2>
<form method="POST" class="loan-form">
    <label for="book_id">Libro:</label>
    <select name="book_id" required>
        <option value="">Selecciona un libro</option>
        <?php foreach($availableBooks as $book): ?>
            <option value="<?= $book['id']; ?>"><?= htmlspecialchars($book['title']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="return_date">Fecha de devolución:</label>
    <input type="date" name="return_date" required>

    <button type="submit">Registrar Préstamo</button>
</form>

<h2>Préstamos Activos</h2>
<div class="loans-container">
    <?php foreach($loans as $loan): ?>
        <div class="loan-card">
            <h3><?= htmlspecialchars($loan['title']); ?></h3>
            <p><strong>Usuario:</strong> <?= htmlspecialchars($loan['username']); ?></p>
            <p><strong>Fecha inicio:</strong> <?= $loan['start_date']; ?></p>
            <p><strong>Fecha devolución:</strong> <?= $loan['return_date']; ?></p>
            <a href="return.php?id=<?= $loan['id']; ?>" class="btn">Registrar Devolución</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../footer.php'; ?>
