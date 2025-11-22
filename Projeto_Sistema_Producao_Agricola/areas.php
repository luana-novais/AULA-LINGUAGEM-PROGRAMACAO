<?php
require("conexao.php");

try{
    $stmt = $pdo->query("SELECT * FROM areas ORDER BY nome_talhao");
    $dados = $stmt->fetchAll();
} catch(\Exception $e){
    $erro = "Erro ao carregar os dados das áreas.";
    error_log($e->getMessage()); 
    $dados = []; 
}

require("cabecalho.php");
?>

<div class="container mt-4">
    
    <?php if (isset($erro)): ?>
        <p class='alert alert-danger'><?= $erro ?></p>
    <?php endif; ?>

    <?php
    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'){
        echo "<p class='text-success'>✅ Área cadastrada com sucesso!</p>";
    } else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao cadastrar a área!</p>";
    }

    if (isset($_GET['editar']) && $_GET['editar'] == 'true'){
        echo "<p class='text-success'>✏️ Área editada com sucesso!</p>";
    } else if (isset($_GET['editar']) && $_GET['editar'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao editar a área!</p>";
    }

    if (isset($_GET['excluir']) && $_GET['excluir'] == 'true'){
        echo "<p class='text-success'>🗑️ Área excluída!</p>";
    } else if (isset($_GET['excluir']) && $_GET['excluir'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao excluir a área!</p>";
    }
    ?>
    
    <h2 class="mb-3">🗺️ Áreas de Plantio (Talhões)</h2>
    
    <a href="nova_area.php" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle me-1"></i> Nova Área
    </a>
    
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Talhão</th>
                <th>Tamanho (ha)</th>
                <th>Tipo de Solo</th>
                <th>Coordenadas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $d): ?>
            <tr>
                <td><?= $d['id_area'] ?></td>
                <td><?= htmlspecialchars($d['nome_talhao']) ?></td>
                <td><?= number_format($d['tamanho_hectares'], 2, ',', '.') ?> ha</td>
                <td><?= htmlspecialchars($d['tipo_solo']) ?></td>
                <td><?= htmlspecialchars($d['coordenadas']) ?></td>

                <td class="d-flex gap-2">
                    <a href="editar_area.php?id=<?= $d['id_area'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="consultar_area.php?id=<?= $d['id_area'] ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-search"></i> Consultar
                    </a>
                    <a href="excluir_area.php?id=<?= $d['id_area'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Tem certeza que deseja excluir a área: <?= htmlspecialchars($d['nome_talhao']) ?>?')">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (count($dados) == 0): ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhuma área cadastrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php
require("rodape.php");
?>