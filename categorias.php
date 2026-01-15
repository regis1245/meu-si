<?php
require_once 'config.php';

// 🔐 PROTEÇÃO DE LOGIN (CORRETA PARA SEU SISTEMA)
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login_cadastro.php");
    exit;
}


// pega todas as categorias
$sqlCat = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
$resCat = $pdo->query($sqlCat);

// pega categoria selecionada
$categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;

// pega IA da categoria
$listaIa = [];
if ($categoriaSelecionada) {
    $sqlIa = "SELECT * FROM inteligencias_artificiais WHERE id_categoria = ?";
    $stmtIa = $pdo->prepare($sqlIa);
    $stmtIa->execute([$categoriaSelecionada]);
    $listaIa = $stmtIa->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Categorias</title>
</head>

<body>

<div class="menu-box">
    <div class="menu">
        <?php include('menu.php'); ?>
    </div>
</div>


<div class="categoria-wrapper">

<h1 class="categoria-titulo-pagina">Categorias de IA</h1>
<p class="categoria-subtitulo-pagina">Explore ferramentas organizadas por categoria</p>

<div class="categoria-grid">

<?php while($cat = $resCat->fetch(PDO::FETCH_ASSOC)): ?>
    
    <a href="categorias.php?categoria=<?= $cat['id']; ?>" 
       class="categoria-box <?= $categoriaSelecionada == $cat['id'] ? 'ativo' : '' ?>">

        <h3><?= $cat['nome_categoria']; ?></h3>
        <p><?= $cat['descricao']; ?></p>

    </a>

<?php endwhile; ?>

</div>

<?php if ($categoriaSelecionada): ?>

    <?php 
        $sqlNome = "SELECT nome_categoria FROM categorias WHERE id=?";
        $stmtNome = $pdo->prepare($sqlNome);
        $stmtNome->execute([$categoriaSelecionada]);
        $nomeCategoria = $stmtNome->fetchColumn();
    ?>

    <h2 class="titulo-lista">Ferramentas de <?= $nomeCategoria; ?></h2>

    <?php if (count($listaIa) == 0): ?>

    <div class="msg-sem-resultados">
        Nenhuma ferramenta nesta categoria ainda. <br>
        O admin pode adicionar ferramentas no painel.
    </div>

    <?php else: ?>

    <div class="grid-ferramentas">

        <?php foreach ($listaIa as $ia): ?>

        <div class="card-ferramenta">
            <img src="<?= $ia['imagem_url']; ?>" class="card-img">
            <h3><?= $ia['nome_ia']; ?></h3>
            <p><?= $ia['descricao']; ?></p>
            <a href="<?= $ia['link_ia']; ?>" target="_blank" class="btn-ferramenta">
                Acessar IA
            </a>
        </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>

<?php endif; ?>

</div>

</body>
</html>
