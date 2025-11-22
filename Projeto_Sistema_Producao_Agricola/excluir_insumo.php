<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $id = $_POST['id_insumo']; 
    
    try{
        $stmt = $pdo->prepare("DELETE FROM insumos WHERE id_insumo = ?");
        
        if($stmt->execute([$id])){
            header('location: insumos.php?excluir=true');
        } else {
            header('location: insumos.php?excluir=false');
        }
        exit(); 
        
    }catch(\PDOException $e){
        echo "Erro ao excluir insumo: ".$e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: insumos.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT 
                                id_insumo, 
                                nome, 
                                tipo, 
                                unidade_medida, 
                                estoque_atual 
                               FROM insumos 
                               WHERE id_insumo = ?");
        $stmt->execute([$_GET['id']]);
        $insumo = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$insumo) {
            header('location: insumos.php?excluir=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar insumo para exclusão: ".$e->getMessage();
    }
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4 text-danger">🗑️ Confirmar Exclusão de Insumo</h1>

    <form method="post" action="excluir_insumo.php">
        
        <input type="hidden" name="id_insumo" value="<?= $insumo['id_insumo'] ?? '' ?>">
        
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Atenção!</h4>
            <p>Você está prestes a excluir o insumo **<?= htmlspecialchars($insumo['nome'] ?? 'Registro') ?>**.</p>
            <p>Esta ação não pode ser desfeita. Confirme a exclusão abaixo.</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nome do Insumo:</label>
            <input disabled value="<?= htmlspecialchars($insumo['nome'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tipo:</label>
            <input disabled value="<?= htmlspecialchars($insumo['tipo'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Estoque Atual:</label>
            <input disabled value="<?= number_format($insumo['estoque_atual'] ?? 0, 2, ',', '.') ?> <?= htmlspecialchars($insumo['unidade_medida'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-danger mt-3">
            <i class="fas fa-trash-alt me-1"></i> **EXCLUIR PERMANENTEMENTE**
        </button>
        
        <a href="insumos.php" class="btn btn-secondary mt-3">
            <i class="fas fa-undo me-1"></i> Cancelar e Voltar
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>