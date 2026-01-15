<?php
// Arquivo: processar_cadastro.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['cadastro_erro'] = "Preencha todos os campos.";
        header("location: login_cadastro.php"); exit;
    }

    $sql_check = "SELECT id FROM usuarios WHERE email = :email";
    if ($stmt_check = $pdo->prepare($sql_check)) {
        $stmt_check->bindParam(":email", $email, PDO::PARAM_STR);
        if ($stmt_check->execute() && $stmt_check->rowCount() > 0) {
            $_SESSION['cadastro_erro'] = "Este e-mail já está cadastrado.";
            header("location: login_cadastro.php"); exit;
        }
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql_insert = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)";
    
    if ($stmt_insert = $pdo->prepare($sql_insert)) {
        $stmt_insert->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt_insert->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt_insert->bindParam(":senha_hash", $senha_hash, PDO::PARAM_STR);
        
        if ($stmt_insert->execute()) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $pdo->lastInsertId();
            $_SESSION['nome'] = $nome;
            $_SESSION['is_admin'] = false;

            header("location: categorias.php"); // Redireciona para categorias
        } else {
            $_SESSION['cadastro_erro'] = "Ocorreu um erro ao tentar cadastrar o usuário.";
            header("location: login_cadastro.php");
        }
    }
} else {
    header("location: login_cadastro.php");
}
exit;
?>