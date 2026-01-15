<?php 
// Arquivo: admin_criar_editar.php
require_once 'config.php';

// 1. CHECAGEM DE ADMIN (Segurança)
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["is_admin"] != 1) {
    header("location: index.php");
    exit;
}

$ia_detalhes = [
    'id' => null,
    'id_categoria' => 1, // Default para 1
    'nome_ia' => '',
    'link_ia' => '',
    'descricao' => '',
    'imagem_url' => ''
];
$categorias_db = [];
$erro = $mensagem = "";
$modo = 'Criar'; // Define se estamos criando ou editando

try {
    // Carrega a lista de categorias para o formulário
    $stmt_cat = $pdo->query("SELECT id, nome_categoria FROM categorias ORDER BY nome_categoria");
    $categorias_db = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

    // LÓGICA DE EDIÇÃO (Se houver um 'id' na URL)
    if (isset($_GET['id'])) {
        $modo = 'Editar';
        $id_editar = (int)$_GET['id'];
        
        $stmt_ia = $pdo->prepare("SELECT * FROM inteligencias_artificiais WHERE id = ?");
        $stmt_ia->execute([$id_editar]);
        $ia_detalhes = $stmt_ia->fetch(PDO::FETCH_ASSOC);

        if (!$ia_detalhes) {
            $erro = "IA não encontrada para edição.";
            $modo = 'Criar'; 
        }
    }

    // LÓGICA DE SALVAR/ATUALIZAR (POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ia = $_POST['id_ia'] ?? null;
        $id_categoria = (int)$_POST['id_categoria'];
        $nome_ia = trim($_POST['nome_ia']);
        $link_ia = trim($_POST['link_ia']);
        $descricao = trim($_POST['descricao']);
        $imagem_url = trim($_POST['imagem_url']);

        if (empty($nome_ia) || empty($link_ia) || empty($descricao)) {
            $erro = "Por favor, preencha os campos obrigatórios (Nome, Link e Descrição).";
        } else {

            if ($id_ia) { // É uma EDIÇÃO (UPDATE)
                $sql = "UPDATE inteligencias_artificiais SET id_categoria = ?, nome_ia = ?, link_ia = ?, descricao = ?, imagem_url = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id_categoria, $nome_ia, $link_ia, $descricao, $imagem_url, $id_ia]);
                $mensagem = "IA **{$nome_ia}** atualizada com sucesso!";
            } else { // É uma CRIAÇÃO (INSERT)
                $sql = "INSERT INTO inteligencias_artificiais (id_categoria, nome_ia, link_ia, descricao, imagem_url) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id_categoria, $nome_ia, $link_ia, $descricao, $imagem_url]);
                $mensagem = "Nova IA **{$nome_ia}** criada com sucesso!";
            }
            
            // Depois de salvar/atualizar, recarrega os detalhes para mostrar o estado atual
            if ($id_ia) {
                // Se era uma edição, recarrega os detalhes atualizados
                $stmt_ia->execute([$id_ia]);
                $ia_detalhes = $stmt_ia->fetch(PDO::FETCH_ASSOC);
            } else {
                // Se era uma criação, redireciona para a tela de edição
                header("Location: admin.php?msg=" . urlencode("Nova IA criada!")); 
                exit();
            }
        }
    }

} catch (PDOException $e) {
    $erro = "Erro de banco de dados: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $modo; ?> IA - PAINEL ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <script>function goBack() { window.history.back(); }</script>
</head>
<body>

    <header>
        <h1>Painel de Administração - <?php echo $modo; ?> IA</h1>
    </header>

<div class="menu-box">
    <div class="menu">
        <?php include('menu.php'); ?>
    </div>
</div>
    
    <main>
        <button onclick="goBack()" class="btn-submit" style="margin-bottom: 20px; background-color: #007bff;">&#9664; Voltar</button>

        <?php if ($erro): ?><p style="color:red; font-weight: bold;"><?php echo $erro; ?></p><?php endif; ?>
        <?php if ($mensagem): ?><p style="color:green; font-weight: bold;"><?php echo $mensagem; ?></p><?php endif; ?>

        <div class="quadro-auth" style="max-width: 700px; margin: 0 auto; padding: 20px;">
            <h2><?php echo $modo; ?> Informações da IA</h2>
            
            <form class="form-auth" action="" method="POST">
                
                <!-- ID da IA (escondido para atualização) -->
                <input type="hidden" name="id_ia" value="<?php echo htmlspecialchars($ia_detalhes['id'] ?? ''); ?>">

                <!-- Categoria -->
                <label for="id_categoria">Categoria:</label>
                <select id="id_categoria" name="id_categoria" required>
                    <?php 
                    $selected_cat = $ia_detalhes['id_categoria'] ?? 1;
                    foreach ($categorias_db as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $selected_cat) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['nome_categoria']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Nome da IA -->
                <label for="nome_ia">Nome da IA:</label>
                <input type="text" id="nome_ia" name="nome_ia" value="<?php echo htmlspecialchars($ia_detalhes['nome_ia']); ?>" required>
                
                <!-- Link (URL) da IA -->
                <label for="link_ia">Link de Acesso da IA:</label>
                <input type="url" id="link_ia" name="link_ia" value="<?php echo htmlspecialchars($ia_detalhes['link_ia']); ?>" required>

                <!-- Descrição -->
                <label for="descricao">Descrição (O que ela faz):</label>
                <textarea id="descricao" name="descricao" rows="5" required><?php echo htmlspecialchars($ia_detalhes['descricao']); ?></textarea>
                
                <!-- Imagem (Usando URL) -->
                <label for="imagem_url">URL da Imagem de Destaque:</label>
                <input type="url" id="imagem_url" name="imagem_url" value="<?php echo htmlspecialchars($ia_detalhes['imagem_url']); ?>">
                
                <button type="submit" class="btn-submit"><?php echo $modo; ?> IA</button>
            </form>
        </div>

    </main>
</body>
</html>