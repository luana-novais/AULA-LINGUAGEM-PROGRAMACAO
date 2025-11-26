<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: atividades.php');
        exit();
    }
    
    try{
        // SELECT com JOINs para buscar todos os detalhes por nome
        $stmt = $pdo->prepare("SELECT 
                                a.*,
                                c.nome AS nome_cultura,
                                ar.nome_talhao AS nome_area,
                                i.nome AS nome_insumo,
                                i.unidade_medida
                               FROM atividades a
                               JOIN culturas c ON a.id_cultura = c.id_cultura
                               JOIN areas ar ON a.id_area = ar.id_area
                               LEFT JOIN insumos i ON a.id_insumo = i.id_insumo
                               WHERE a.id_atividade = ?");
        $stmt->execute([$_GET['id']]);
        $atividade = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$atividade) {
            header('location: atividades.php');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar atividade: ".$e->getMessage();
    }
} else {
    header('location: atividades.php');
    exit();
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4">🔍 Detalhes da Atividade</h1>

    <form>
        
        <div class="mb-3">
            <label class="form-label">ID da Atividade:</label>
            <input disabled value="<?= htmlspecialchars($atividade['id_atividade'] ?? '') ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Data e Hora:</label>
            <?php $data_formatada = (new DateTime($atividade['data_hora'] ?? ''))->format('d/m/Y H:i:s'); ?>
            <input disabled value="<?= htmlspecialchars($data_formatada) ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Atividade:</label>
            <input disabled value="<?= htmlspecialchars($atividade['tipo_atividade'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <hr>
        <h3>Vínculos</h3>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Cultura:</label>
                <input disabled value="<?= htmlspecialchars($atividade['nome_cultura'] ?? '') ?>" type="text" class="form-control">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Área (Talhão):</label>
                <input disabled value="<?= htmlspecialchars($atividade['nome_area'] ?? '') ?>" type="text" class="form-control">
            </div>
        </div>

        <hr>
        <h3>Uso de Insumo</h3>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Insumo Utilizado:</label>
                <input disabled value="<?= htmlspecialchars($atividade['nome_insumo'] ?? 'Nenhum') ?>" type="text" class="form-control">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Quantidade Aplicada:</label>
                <?php 
                    $qtd = $atividade['quantidade_aplicada'] ?? 0;
                    $unidade = $atividade['unidade_medida'] ?? '';
                    $texto_qtd = $qtd > 0 ? number_format($qtd, 2, ',', '.') . ' ' . $unidade : 'N/A';
                ?>
                <input disabled value="<?= htmlspecialchars($texto_qtd) ?>" type="text" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observações:</label>
            <textarea disabled class="form-control" rows="3"><?= htmlspecialchars($atividade['observacoes'] ?? '') ?></textarea>
        </div>
        
        <a href="editar_atividade.php?id=<?= $atividade['id_atividade'] ?? '' ?>" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Editar
        </a>
        <a href="excluir_atividade.php?id=<?= $atividade['id_atividade'] ?? '' ?>" class="btn btn-danger">
            <i class="fas fa-trash-alt me-1"></i> Excluir
        </a>
        <a href="atividades.php" class="btn btn-secondary">
            <i class="fas fa-undo me-1"></i> Voltar para a Lista
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>