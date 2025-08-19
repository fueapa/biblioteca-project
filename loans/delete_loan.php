<?php
include '../config.php';
include '../header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['id'])){
    $loan_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM loans WHERE id = ?");
    $stmt->execute([$loan_id]);

    header("Location: list.php");
    exit();
} else {
    header("Location: list.php");
    exit();
}
