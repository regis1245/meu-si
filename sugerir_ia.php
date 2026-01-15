<?php 
// Arquivo: sugerir_ia.php
require_once 'config.php';

$feedback = $erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_ia = trim($_POST['nome_ia']);
    $link_ia = trim($_POST['link_ia']);
    $descricao = trim($_POST['descricao']);
    $comentarios = trim($_POST['comentarios']);
    $imagem_url = trim($_POST['imagem_url']); // Usaremos URL em vez de upload/geração complexa
    
    // Validação básica
    if (empty($nome_ia) || empty($link_ia) || empty($descricao)) {
        $erro = "Por favor, preencha os campos obrigatórios (Nome, Link e Descrição).";
    } else {
        try {
            $sql = "INSERT INTO sugestoes_ia (nome_ia, link_ia, descricao, comentarios, imagem_url) 
                    VALUES (:nome_ia, :link_ia, :descricao, :comentarios, :imagem_url)";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome_ia', $nome_ia);
            $stmt->bindParam(':link_ia', $link_ia);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':comentarios', $comentarios);
            $stmt->bindParam(':imagem_url', $imagem_url);

            if ($stmt->execute()) {
                $feedback = "Obrigado! Sua sugestão foi enviada para análise do administrador.";
            } else {
                $erro = "Erro ao salvar a sugestão no banco de dados.";
            }

        } catch (PDOException $e) {
            $erro = "Erro de banco de dados: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugerir uma IA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="menu-box">
    <div class="menu">
        <?php include('menu.php'); ?>
    </div>
</div>

<main>
    <div class="form-container" style="margin: 20px auto;">
        <h2 style="text-align:center;">Sugerir uma Nova IA</h2>

        <?php if ($erro): ?>
            <p style="color:red; text-align:center;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <?php if ($feedback): ?>
            <p style="color:limegreen; text-align:center; font-weight:bold;"><?php echo $feedback; ?></p>
        <?php endif; ?>

        <form class="form" action="" method="POST">

            <div class="form-group">
                <label for="nome_ia">Nome da IA:</label>
                <input type="text" id="nome_ia" name="nome_ia" required>
            </div>

            <div class="form-group">
                <label for="link_ia">Link de Acesso da IA:</label>
                <input type="url" id="link_ia" name="link_ia" placeholder="Ex: https://openai.com/chatgpt" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição (O que ela faz):</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>

            <div class="form-group">
                <label for="imagem_url">URL da Imagem de Destaque:</label>
                <input type="url" id="imagem_url" name="imagem_url" placeholder="Ex: https://meuservidor.com/imagem-ia.png">
            </div>

            <div class="form-group">
                <label for="comentarios">Seu Comentário:</label>
                <textarea id="comentarios" name="comentarios"></textarea>
            </div>

            <button type="submit" class="form-submit-btn">Enviar Sugestão</button>

        </form>
    </div>
</main>
