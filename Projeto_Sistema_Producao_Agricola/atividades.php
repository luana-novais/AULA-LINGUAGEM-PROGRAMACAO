<?php
require("conexao.php");

try{
    $stmt = $pdo->query("SELECT 
                            a.id_atividade,
                            a.data_hora,
                            a.tipo_atividade,
                            a.quantidade_aplicada,
                            c.nome AS nome_cultura,
                            ar.nome_talhao AS nome_area,
                            i.nome AS nome_insumo
                         FROM atividades a
                         JOIN culturas c ON a.id_cultura = c.id_cultura
                         JOIN areas ar ON a.id_area = ar.id_area
                         LEFT JOIN insumos i ON a.id_insumo = i.id_insumo
                         ORDER BY a.data_hora DESC");
    $dados = $stmt->fetchAll();
} catch(\Exception $e){
    $erro = "Erro ao carregar os dados das atividades.";
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
        echo "<p class='text-success'>✅ Atividade cadastrada com sucesso!</p>";
    } else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao cadastrar a atividade!</p>";
    }

    if (isset($_GET['editar']) && $_GET['editar'] == 'true'){
        echo "<p class='text-success'>✏️ Atividade editada com sucesso!</p>";
    } else if (isset($_GET['editar']) && $_GET['editar'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao editar a atividade!</p>";
    }

    if (isset($_GET['excluir']) && $_GET['excluir'] == 'true'){
        echo "<p class='text-success'>🗑️ Atividade excluída!</p>";
    } else if (isset($_GET['excluir']) && $_GET['excluir'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao excluir a atividade!</p>";
    }
    ?>
    
    <h2 class="mb-3">🗓️ Registro de Atividades</h2>
    
    <a href="nova_atividade.php" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle me-1"></i> Nova Atividade
    </a>
    
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Data e Hora</th>
                <th>Tipo</th>
                <th>Cultura</th>
                <th>Área (Talhão)</th>
                <th>Insumo</th>
                <th style="width: 250px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $d): 
                $data_formatada = (new DateTime($d['data_hora']))->format('d/m/Y H:i');
            ?>
            <tr>
                <td><?= htmlspecialchars($data_formatada) ?></td>
                <td><?= htmlspecialchars($d['tipo_atividade']) ?></td>
                <td><?= htmlspecialchars($d['nome_cultura']) ?></td>
                <td><?= htmlspecialchars($d['nome_area']) ?></td>
                <td><?= htmlspecialchars($d['nome_insumo'] ?? 'Nenhum') ?></td>

                <td class="d-flex gap-2">
                    <a href="editar_atividade.php?id=<?= $d['id_atividade'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="consultar_atividade.php?id=<?= $d['id_atividade'] ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-search"></i> Consultar
                    </a>
                    <a href="#" class="btn btn-sm btn-danger"
                       onclick="confirmarExclusao(<?= $d['id_atividade'] ?>, 'Atividade em <?= $d['nome_area'] ?>', 'excluir_atividade.php'); return false;">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (count($dados) == 0): ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhuma atividade registrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php
if (!function_exists('confirmarExclusao')):
?>
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
<?php endif; ?>

<?php
require("rodape.php");
?>