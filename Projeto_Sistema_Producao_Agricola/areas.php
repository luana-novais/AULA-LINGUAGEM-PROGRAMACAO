<?php
require("conexao.php");

try{
    $stmt = $pdo->query("SELECT 
                            id_area, 
                            nome_talhao, 
                            tamanho_hectares, 
                            coordenadas, 
                            tipo_solo
                         FROM areas 
                         ORDER BY nome_talhao");
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
    // Mensagens de feedback
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
                <th>Nome do Talhão</th>
                <th>Tamanho (ha)</th>
                <th>Tipo de Solo</th>
                <th>Coordenadas</th>
                <th style="width: 250px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $d): ?>
            <tr>
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
                    <a href="#" class="btn btn-sm btn-danger"
                       onclick="confirmarExclusao(<?= $d['id_area'] ?>, '<?= addslashes(htmlspecialchars($d['nome_talhao'])) ?>', 'excluir_area.php'); return false;">
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

<script>
    function confirmarExclusao(id, nome, scriptDestino) {
        Swal.fire({
            title: 'Tem certeza?',
            html: `Você irá excluir: <strong>${nome}</strong>. Esta ação não pode ser desfeita!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, Excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = scriptDestino + '?id=' + id;
            }
        })
    }
</script>

<?php
require("rodape.php");
?>