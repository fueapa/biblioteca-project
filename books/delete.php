<?php
include '../config.php';
include '../header.php';
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if($id){
    $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
    $stmt->execute([$id]);
}

header("Location: list.php");
exit();
?>
