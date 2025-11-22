<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: insumos.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT * FROM insumos WHERE id_insumo = ?");
        // O ID vem da URL como 'id'
        $stmt->execute([$_GET['id']]);
        $insumo = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        if (!$insumo) {
            header('location: insumos.php');
            exit();
        }

    } catch (Exception $e){
        echo "Erro ao consultar insumo: ".$e->getMessage();
    }
} else {
    header('location: insumos.php');
    exit();
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4">🔍 Consultar Detalhes do Insumo</h1>

    <form> 
        
        <input type="hidden" name="id_insumo" value="<?= $insumo['id_insumo'] ?? '' ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Comercial / Componente:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($insumo['nome'] ?? '') ?>"
                type="text" 
                id="nome" 
                class="form-control"
            >
        </div>
        
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Insumo:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($insumo['tipo'] ?? '') ?>"
                type="text" 
                id="tipo" 
                class="form-control"
            >
        </div>
        
        <div class="mb-3">
            <label for="unidade_medida" class="form-label">Unidade de Medida:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($insumo['unidade_medida'] ?? '') ?>"
                type="text" 
                id="unidade_medida" 
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label for="estoque_atual" class="form-label">Quantidade em Estoque:</label>
            <input 
                disabled 
                value="<?= number_format($insumo['estoque_atual'] ?? 0, 2, ',', '.') ?>"
                type="text" 
                id="estoque_atual" 
                class="form-control"
            >
        </div>
        
        <div class="mb-3">
            <label for="valor_unitario" class="form-label">Valor Unitário (R$):</label>
            <input 
                disabled 
                value="R$ <?= number_format($insumo['valor_unitario'] ?? 0, 2, ',', '.') ?>"
                type="text" 
                id="valor_unitario" 
                class="form-control"
            >
        </div>
        
        <a href="insumos.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar 
        </a>
        
        <a href="editar_insumo.php?id=<?= $insumo['id_insumo'] ?? '' ?>" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Editar Insumo
        </a>
        
    </form>

</div>

<?php
require("rodape.php");
?>