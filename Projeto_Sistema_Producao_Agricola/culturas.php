<?php
require("conexao.php");

try{
    $stmt = $pdo->query("SELECT 
                            id_cultura, 
                            nome, 
                            tipo_cultivo, 
                            ciclo_dias, 
                            descricao, 
                            data_criacao 
                         FROM culturas 
                         ORDER BY nome");
    $dados = $stmt->fetchAll();
} catch(\Exception $e){
    echo "Erro: ".$e->getMessage();
    $dados = []; 
}

require("cabecalho.php");

// Mensagens de feedback
if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'){
    echo "<p class='text-success'>✅ Cultura cadastrada com sucesso!</p>";
} else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'){
    echo "<p class='text-danger'>❌ Erro ao cadastrar a cultura!</p>";
}

if (isset($_GET['editar']) && $_GET['editar'] == 'true'){
    echo "<p class='text-success'>✏️ Cultura editada com sucesso!</p>";
} else if (isset($_GET['editar']) && $_GET['editar'] == 'false'){
    echo "<p class='text-danger'>❌ Erro ao editar a cultura!</p>";
}

if (isset($_GET['excluir']) && $_GET['excluir'] == 'true'){
    echo "<p class='text-success'>🗑️ Cultura excluída!</p>";
} else if (isset($_GET['excluir']) && $_GET['excluir'] == 'false'){
    echo "<p class='text-danger'>❌ Erro ao excluir a cultura!</p>";
}
?>

<h2 class="mb-3">🌱 Culturas Cadastradas</h2>

<a href="nova_cultura.php" class="btn btn-success mb-3">
    <i class="fas fa-plus-circle me-1"></i> Nova Cultura
</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo de Cultivo</th>
            <th>Ciclo (Dias)</th>
            <th>Data de Criação</th>
            <th style="width: 250px;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td><?= $d['id_cultura'] ?></td>
            <td><?= htmlspecialchars($d['nome']) ?></td>
            <td><?= htmlspecialchars($d['tipo_cultivo']) ?></td>
            <td><?= htmlspecialchars($d['ciclo_dias']) ?></td>
            <td><?= htmlspecialchars($d['data_criacao']) ?></td>
            <td class="d-flex gap-2">
                <a href="editar_cultura.php?id=<?= $d['id_cultura'] ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="consultar_cultura.php?id=<?= $d['id_cultura'] ?>" class="btn btn-sm btn-info">
                    <i class="fas fa-search"></i> Consultar
                </a>
                <a href="#" class="btn btn-sm btn-danger"
                   onclick="confirmarExclusao(<?= $d['id_cultura'] ?>, '<?= addslashes(htmlspecialchars($d['nome'])) ?>', 'excluir_cultura.php'); return false;">
                    <i class="fas fa-trash-alt"></i> Excluir
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php if (count($dados) == 0): ?>
            <tr>
                <td colspan="6" class="text-center">Nenhuma cultura cadastrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

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