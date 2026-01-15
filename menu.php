<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$logado = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
$is_admin = isset($_SESSION["is_admin"]) && (int)$_SESSION["is_admin"] === 1; 
?>

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="categorias.php">Categorias</a></li>
    
    <?php if ($logado): ?>
        <li><a href="logout.php">Sair (<?= htmlspecialchars($_SESSION['nome']); ?>)</a></li>
    <?php else: ?>
        <li><a href="login_cadastro.php">Login/Cadastro</a></li>
    <?php endif; ?>
    
    <li><a href="sugerir_ia.php">Sugerir uma IA</a></li>

    <?php if ($is_admin): ?>
        <li><a href="admin.php">Admin</a></li>
    <?php endif; ?>
</ul>
