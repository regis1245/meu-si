<?php 
// Arquivo: index.php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal das IAs - Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="glass-bg">

    <!-- MENU BOX -->
    <nav class="menu-box">
        <nav class="menu">
            <?php include 'menu.php'; ?>
        </nav>
    </nav>

    <!-- HERO SECTION COM FUNDO PRETO + IMAGEM -->
    <section class="hero-wrapper">
        <div class="hero-section">
            
            <div class="hero-tag">
                ✨ Descubra o futuro da inteligência artificial
            </div>

            <h1 class="hero-title">
                IA para o seu dia a dia
            </h1>

            <p class="hero-text">
                Descubra as ferramentas de inteligência artificial que estão moldando o futuro. 
                Aumente sua produtividade, criatividade e eficiência.
            </p>

            <div class="hero-buttons">
                <a href="categorias.php" class="btn-primary">Explorar Ferramentas</a>
                <a href="categorias.php" class="btn-secondary">Ver Categorias</a>
            </div>

        </div>
    </section>

    <!-- FERRAMENTAS MAIS USADAS -->
    <section class="ferramentas-container">
        <h2 class="titulo-ferramentas">Ferramentas Mais Usadas</h2>
        <p class="subtitulo-ferramentas">As Mais populares e escolhidas pela nossa comunidade</p>

        <div class="ferramentas-grid">

            <!-- CARD 1 -->
            <div class="card">
                <img src="https://wing.com.br/Loja/Imagens/chatgptassistente4520239400656.jpg" class="card-img">
                <h3>ChatGPT</h3>
                <span class="badge prod">Produtividade</span>
                <button class="login_cadastro.php" onclick="usarFerramenta(1)">Usar Ferramenta</button>
            </div>

            <!-- CARD 2 -->
            <div class="card">
                <img src="https://image.piax.org/images/agent-icon/deepsite.webp" class="card-img">
                <h3>Meio da Jornada</h3>
                <span class="badge cri">Criatividade</span>
                <button class="btn-usar" onclick="usarFerramenta(2)">Usar Ferramenta</button>
            </div>

            <!-- CARD 3 -->
            <div class="card">
                <img src="https://play-lh.googleusercontent.com/Rw0Uqb3WY1Twe2ZxxmUfIajHj_4XL0wx23jB7iTNe_yKu6eZGHxofiRmqHQbxv679ks=s94" class="card-img">
                <h3>Google Gemini</h3>
                <span class="badge prod">Produtividade</span>
               
            </div>

            <!-- CARD 4 -->
            <div class="card">
                <img src="https://tse4.mm.bing.net/th/id/OIP.8wehT0jxOmO-fy4LLSkxMQAAAA?cb=ucfimg2&ucfimg=1&w=280&h=280&rs=1&pid=ImgDetMain&o=7&rm=3" class="card-img">
                <h3>GitHub Copilot</h3>
                <span class="badge dev">Desenvolvimento</span>
                <button class="btn-usar" onclick="usarFerramenta(4)">Usar Ferramenta</button>
            </div>

        </div>
    </section>


<script>
function usarFerramenta(id) {
    <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true): ?>
        alert("Você precisa fazer login para usar esta ferramenta!");
        window.location.href = "login.php";
    <?php else: ?>
        window.location.href = "ferramenta"+id+".php";
    <?php endif; ?>
}
</script>

<script>
const fundos = [
    "assets/img/bg/bg1.jpg",
    "assets/img/bg/bg2.jpg",
    "assets/img/bg/bg3.jpg",
    "assets/img/bg/bg4.jpg"
];

let atual = 0;
const hero = document.querySelector(".hero-wrapper");

function trocarFundo() {
    hero.style.backgroundImage = `url('${fundos[atual]}')`;
    atual = (atual + 1) % fundos.length;
}

// fundo inicial
trocarFundo();

// troca a cada 30 segundos
setInterval(trocarFundo, 30000);
</script>


</body>
</html>
