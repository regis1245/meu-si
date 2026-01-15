<?php 
// Arquivo: admin.php
require_once 'config.php';

// 1. CHECAGEM DE ADMIN (Segurança CRUCIAL)
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["is_admin"] != 1) {
    header("location: index.php");
    exit;
}

$mensagem = $erro = "";
$sugestoes = [];
$todas_ias = [];
$categorias_db = [];

// Funções de CRUD (Create, Read, Update, Delete)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
    
    try {
        if ($_GET['action'] == 'aprovar' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            
            // 1. Traz a sugestão
            $stmt_sug = $pdo->prepare("SELECT * FROM sugestoes_ia WHERE id = ?");
            $stmt_sug->execute([$id]);
            $sug = $stmt_sug->fetch(PDO::FETCH_ASSOC);

            if ($sug) {
                // 2. Insere na tabela oficial de IAs
                $sql_ins = "INSERT INTO inteligencias_artificiais (id_categoria, nome_ia, link_ia, descricao, imagem_url) 
                            VALUES (1, ?, ?, ?, ?)"; // NOTE: Categoria 1 é padrão; deve ser mudada na edição!
                $stmt_ins = $pdo->prepare($sql_ins);
                $stmt_ins->execute([$sug['nome_ia'], $sug['link_ia'], $sug['descricao'], $sug['imagem_url']]);

                // 3. Marca a sugestão como aprovada
                $pdo->prepare("UPDATE sugestoes_ia SET admin_aprovado = 1 WHERE id = ?")->execute([$id]);

                $mensagem = "Sugestão **" . htmlspecialchars($sug['nome_ia']) . "** aprovada e adicionada à lista oficial!";
            }
        }
        
        if ($_GET['action'] == 'deletar' && isset($_GET['tabela']) && isset($_GET['id'])) {
            $tabela = ($_GET['tabela'] == 'sugestao') ? 'sugestoes_ia' : 'inteligencias_artificiais';
            $id = (int)$_GET['id'];
            $pdo->prepare("DELETE FROM {$tabela} WHERE id = ?")->execute([$id]);
            $mensagem = "Item deletado com sucesso da tabela **{$tabela}**.";
        }
        
    } catch (PDOException $e) {
        $erro = "Erro durante a operação no banco de dados: " . $e->getMessage();
    }
}

// 2. REQUISITAR DADOS ATUAIS
try {
    // Sugestões pendentes (admin_aprovado = 0 ou NULL)
    $stmt_sugestoes = $pdo->query("SELECT * FROM sugestoes_ia WHERE admin_aprovado IS NULL OR admin_aprovado = 0 ORDER BY data_sugestao DESC");
    $sugestoes = $stmt_sugestoes->fetchAll(PDO::FETCH_ASSOC);
    
    // Todas as IAs (oficiais) e suas categorias
    $sql_ias = "SELECT ia.*, cat.nome_categoria FROM inteligencias_artificiais ia
                LEFT JOIN categorias cat ON ia.id_categoria = cat.id ORDER BY ia.id DESC";
    $stmt_ias = $pdo->query($sql_ias);
    $todas_ias = $stmt_ias->fetchAll(PDO::FETCH_ASSOC);
    
    // Lista de Categorias
    $stmt_cat = $pdo->query("SELECT * FROM categorias ORDER BY nome_categoria");
    $categorias_db = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro ao carregar os dados: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL DE ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <!-- Adicionando uma função simples para o botão de Voltar -->
    <script>function goBack() { window.history.back(); }</script>
</head>
<body>

    <header>
        <h1>Painel de Administração</h1>
    </header>

<div class="menu-box">
    <div class="menu">
        <?php include('menu.php'); ?>
    </div>
</div>

    <main>
        <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>.</h3>

         <!-- NOVO BOTÃO DE CRIAÇÃO -->
    <a href="admin_criar_editar.php" class="btn-submit" style="margin-bottom: 20px; background-color: #28a745;">&#x2795; Criar Nova IA Manualmente</a>
        
        <button onclick="goBack()" class="btn-submit" style="margin-bottom: 20px; background-color: #007bff;">&#9664; Voltar</button>

        <?php if ($erro): ?><p style="color:red; font-weight: bold;"><?php echo $erro; ?></p><?php endif; ?>
        <?php if ($mensagem): ?><p style="color:green; font-weight: bold;"><?php echo $mensagem; ?></p><?php endif; ?>

        <!-- Seção 1: Sugestões Pendentes (Em Vermelho) -->
        <h2 style="color: #cc0000; margin-top: 40px;">1. Sugestões Pendentes (<?php echo count($sugestoes); ?>)</h2>
        <?php if (empty($sugestoes)): ?>
            <p style="padding: 15px; border: 1px dashed green;">Nenhuma sugestão nova para analisar!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome/Link</th>
                        <th>Descrição</th>
                        <th>Comentários Sugestão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sugestoes as $sug): ?>
                        <tr class="status-pendente">
                            <td><?php echo $sug['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($sug['nome_ia']); ?></strong><br>
                                <a href="<?php echo htmlspecialchars($sug['link_ia']); ?>" target="_blank"><?php echo htmlspecialchars($sug['link_ia']); ?></a>
                                <?php if($sug['imagem_url']): ?>
                                    <br><img src="<?php echo htmlspecialchars($sug['imagem_url']); ?>" alt="Imagem Sugerida" style="max-width: 100px; height: auto;">
                                <?php endif; ?>

                            </td>
                            <td><?php echo nl2br(htmlspecialchars($sug['descricao'])); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($sug['comentarios'])); ?></td>
                            <td>
                                <a href="?action=aprovar&id=<?php echo $sug['id']; ?>" class="btn-small btn-approve" onclick="return confirm('Deseja realmente APROVAR esta IA? Ela será adicionada à lista oficial.')">Aprovar</a>
                                <a href="?action=deletar&tabela=sugestao&id=<?php echo $sug['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Tem certeza que deseja DELETAR esta sugestão?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>


        <!-- Seção 2: IAs Oficiais (em PRODUÇÃO) -->
        <h2 style="margin-top: 60px;">2. Gerenciar IAs Oficiais (Adicionar/Editar/Deletar)</h2>
        
        <?php if (empty($todas_ias)): ?>
             <p style="padding: 15px; border: 1px dashed #aaa;">Nenhuma IA ainda na lista oficial.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome/Categoria</th>
                        <th>Link</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todas_ias as $ia): ?>
                       <tr>
                            <td><?php echo htmlspecialchars($ia['id']); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($ia['nome_ia']); ?></strong><br>
                                <span style="font-size: 0.9em; color: #888;">(Cat: <?php echo htmlspecialchars($ia['nome_categoria']); ?>)</span>
                            </td>
                            <td><a href="<?php echo htmlspecialchars($ia['link_ia']); ?>" target="_blank">Acessar</a></td>
                            <td>
                                <!-- MUDANÇA CRÍTICA: O link de EDITAR -->
                                <a href="admin_criar_editar.php?id=<?php echo $ia['id']; ?>" class="btn-small btn-edit">Editar</a> 
                                
                                <a href="?action=deletar&tabela=inteligencias_artificiais&id=<?php echo $ia['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Tem certeza que deseja DELETAR esta IA permanentemente?')">Deletar</a>
                            </td>
                        </tr>  
                        
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <!-- Fim do Painel Admin -->
    </main>
</body>
</html>
