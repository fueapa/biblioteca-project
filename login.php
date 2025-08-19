<?php
include 'config.php';
include 'header.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>

<div class="login-container">
    <div class="login-card">
        <h2>Biblioteca Digital</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            <?php if($error != ''): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <p class="note">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
