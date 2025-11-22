<?php

require("conexao.php");

try{

    $stmt = $pdo->query("SELECT * FROM insumos ORDER BY nome");
    $dados = $stmt->fetchAll();
} catch(\Exception $e){
    $erro = "Erro ao carregar os dados dos insumos.";
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
        echo "<p class='text-success'>✅ Insumo cadastrado com sucesso!</p>";
    } else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao cadastrar o insumo!</p>";
    }

    if (isset($_GET['editar']) && $_GET['editar'] == 'true'){
        echo "<p class='text-success'>✏️ Insumo editado com sucesso!</p>";
    } else if (isset($_GET['editar']) && $_GET['editar'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao editar o insumo!</p>";
    }

    if (isset($_GET['excluir']) && $_GET['excluir'] == 'true'){
        echo "<p class='text-success'>🗑️ Insumo excluído!</p>";
    } else if (isset($_GET['excluir']) && $_GET['excluir'] == 'false'){
        echo "<p class='text-danger'>❌ Erro ao excluir o insumo!</p>";
    }
    ?>
    
    <h2 class="mb-3">🧪 Insumos Cadastrados</h2>
    
    <a href="novo_insumo.php" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle me-1"></i> Novo Insumo
    </a>
    
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Insumo</th>
                <th>Tipo</th>
                <th>Estoque</th>
                <th>Unidade</th>
                <th>Valor Unitário</th>
                <th style="width: 250px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($dados as $d):
            ?>
            <tr>
                <td><?= $d['id_insumo'] ?></td>
                <td><?= htmlspecialchars($d['nome']) ?></td>
                <td><?= htmlspecialchars($d['tipo']) ?></td>
                <td><?= number_format($d['estoque_atual'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($d['unidade_medida']) ?></td>
                <td>R$ <?= number_format($d['valor_unitario'], 2, ',', '.') ?></td>

                <td class="d-flex gap-2">
                    <a href="editar_insumo.php?id=<?= $d['id_insumo'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="consultar_insumo.php?id=<?= $d['id_insumo'] ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-search"></i> Consultar
                    </a>
                    <a href="excluir_insumo.php?id=<?= $d['id_insumo'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Tem certeza que deseja excluir o insumo: <?= htmlspecialchars($d['nome']) ?>?')">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </a>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
            <?php if (count($dados) == 0): ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhum insumo cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php
require("rodape.php");
?>