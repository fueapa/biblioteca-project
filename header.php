<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}


define('BASE_URL', '/biblioteca/'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>style.css"> 
</head>
<body>
<nav class="navbar">
    <div class="logo">📚 Biblioteca</div>
    <ul class="nav-links">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="<?= BASE_URL; ?>index.php">Dashboard</a></li>
            <li><a href="<?= BASE_URL; ?>books/list.php">Libros</a></li>
            <li><a href="<?= BASE_URL; ?>loans/borrow.php">Préstamos</a></li>
            <li><a href="<?= BASE_URL; ?>logout.php">Cerrar sesión</a></li>
        <?php else: ?>
            <li><a href="<?= BASE_URL; ?>login.php">Login</a></li>
            <li><a href="<?= BASE_URL; ?>register.php">Registro</a></li>
        <?php endif; ?>
    </ul>
</nav>


<div class="main-content">
