<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Arquivo: processar_login.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $senha_input = $_POST['senha'];
    
    $sql = "SELECT id, nome, senha_hash, is_admin FROM usuarios WHERE email = :email";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($senha_input, $row['senha_hash'])) {
                    
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['is_admin'] = $row['is_admin'];
                    
                    header("location: categorias.php"); // Redireciona para categorias
                    exit;
                    
                } else {
                    $_SESSION['login_erro'] = "E-mail ou senha inválidos.";
                }
            } else {
                 $_SESSION['login_erro'] = "E-mail ou senha inválidos.";
            }
        } else {
            $_SESSION['login_erro'] = "Algo deu errado.";
        }
    }
}

header("location: login_cadastro.php");
exit;
?>