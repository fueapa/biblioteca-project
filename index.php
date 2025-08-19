<?php
include 'config.php';
include 'header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// prestamos activos
$stmt = $conn->query("SELECT COUNT(*) as total FROM loans WHERE returned=0");
$totalLoans = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// top 5 libros
$stmt = $conn->query("SELECT b.title, COUNT(*) as count 
                      FROM loans l 
                      JOIN books b ON l.book_id=b.id 
                      GROUP BY b.id 
                      ORDER BY count DESC 
                      LIMIT 5");
$topBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="dashboard">
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>

    <div class="cards">
        <div class="card">
            <h3>Total de Préstamos Activos</h3>
            <p class="number"><?php echo $totalLoans; ?></p>
        </div>

        <div class="card">
            <h3>Top 5 Libros mas Prestados</h3>
            <ul>
                <?php foreach($topBooks as $book): ?>
                    <li><?php echo $book['title'] . " - " . $book['count']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="actions">
        <a class="btn" href="books/list.php">Gestionar Libros</a>
        <a class="btn" href="loans/borrow.php">Préstamos</a>
    </div>
</div>

<?php include 'footer.php'; ?>
