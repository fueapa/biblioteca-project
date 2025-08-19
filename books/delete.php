<?php
include '../config.php';

if(!isset($_GET['id'])){
    header("Location: list.php");
    exit();
}

$book_id = $_GET['id'];

// Verificar si el libro tiene préstamos
$stmt = $conn->prepare("SELECT COUNT(*) FROM loans WHERE book_id = ?");
$stmt->execute([$book_id]);
$count = $stmt->fetchColumn();

if($count > 0){
    echo "<p style='color:red;'>No se puede eliminar este libro, tiene préstamos asociados.</p>";
} else {
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$book_id]);
    header("Location: list.php");
    exit();
}
?>
