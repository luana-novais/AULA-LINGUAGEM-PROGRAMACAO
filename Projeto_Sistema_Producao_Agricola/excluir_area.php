<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $id = $_POST['id_area']; 
    
    try{
        $stmt = $pdo->prepare("DELETE FROM areas WHERE id_area = ?");
        
        if($stmt->execute([$id])){
            header('location: areas.php?excluir=true');
        } else {
            header('location: areas.php?excluir=false');
        }
        exit(); 
        
    }catch(\PDOException $e){
        echo "Erro ao excluir área: ".$e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: areas.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT id_area, nome, tamanho_hectares FROM areas WHERE id_area = ?");
        $stmt->execute([$_GET['id']]);
        $area = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$area) {
            header('location: areas.php?excluir=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar área para exclusão: ".$e->getMessage();
    }
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4 text-danger">🗑️ Confirmar Exclusão de Área</h1>

    <form method="post" action="excluir_area.php">
        
        <input type="hidden" name="id_area" value="<?= $area['id_area'] ?? '' ?>">
        
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Atenção!</h4>
            <p>Você está prestes a excluir a área **<?= htmlspecialchars($area['nome'] ?? 'Registro') ?>**.</p>
            <p>Esta ação não pode ser desfeita. Confirme a exclusão abaixo.</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nome da Área:</label>
            <input disabled value="<?= htmlspecialchars($area['nome'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tamanho:</label>
            <input disabled value="<?= number_format($area['tamanho_hectares'] ?? 0, 2, ',', '.') ?> ha" type="text" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-danger mt-3">
            <i class="fas fa-trash-alt me-1"></i> **EXCLUIR PERMANENTEMENTE**
        </button>
        
        <a href="areas.php" class="btn btn-secondary mt-3">
            <i class="fas fa-undo me-1"></i> Cancelar e Voltar
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>