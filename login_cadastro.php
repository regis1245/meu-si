<?php
session_start();
require_once 'config.php';

$login_erro = "";
$cadastro_erro = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login e Cadastro</title>
    <link rel="stylesheet" href="style.css">

    <script>
    function showForm(formId) {
        document.getElementById('form-login').style.display = 'none';
        document.getElementById('form-cadastro').style.display = 'none';
        document.getElementById(formId).style.display = 'block';
    }
    </script>

</head>
<body>

<div class="auth-container">

<div class="form-card1">
<div class="form-card2">

<div class="toggle-box">
    <button onclick="showForm('form-login')" class="active">Login</button>
    <button onclick="showForm('form-cadastro')">Cadastro</button>
</div>

<!-- LOGIN -->
<form id="form-login" class="form" method="POST" action="processar_login.php">
    <p class="form-heading">Entrar</p>

    <div class="form-field">
        <input type="email" name="email" placeholder="E-mail" required>
    </div>

    <div class="form-field">
        <input type="password" name="senha" placeholder="Senha" required>
    </div>

    <button class="sendMessage-btn">Acessar</button>
</form>

<!-- CADASTRO -->
<form id="form-cadastro" class="form" method="POST" action="processar_cadastro.php" style="display:none;">
    <p class="form-heading">Criar Conta</p>

    <div class="form-field">
        <input type="text" name="nome" placeholder="Nome Completo" required>
    </div>

    <div class="form-field">
        <input type="email" name="email" placeholder="E-mail" required>
    </div>

    <div class="form-field">
        <input type="password" name="senha" placeholder="Senha" required>
    </div>

    <button class="sendMessage-btn">Cadastrar</button>
</form>

</div>
</div>

</div>

</body>
</html>
