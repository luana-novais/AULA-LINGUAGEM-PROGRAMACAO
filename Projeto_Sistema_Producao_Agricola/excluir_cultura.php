<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id_cultura']; 
    
    try{
        $stmt = $pdo->prepare("DELETE FROM culturas WHERE id_cultura = ?");
        
        if($stmt->execute([$id])){
            header('location: culturas.php?excluir=true');
        } else {
            header('location: culturas.php?excluir=false');
        }
        exit(); 
        
    }catch(\PDOException $e){
        echo "Erro ao excluir cultura: ".$e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: culturas.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT 
                                id_cultura, 
                                nome, 
                                tipo_cultivo
                               FROM culturas 
                               WHERE id_cultura = ?");
        $stmt->execute([$_GET['id']]);
        $cultura = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$cultura) {
            header('location: culturas.php?excluir=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar cultura para exclusão: ".$e->getMessage();
    }
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4 text-danger">🗑️ Confirmar Exclusão de Cultura</h1>

    <form method="post" action="excluir_cultura.php">
        
        <input type="hidden" name="id_cultura" value="<?= $cultura['id_cultura'] ?? '' ?>">
        
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Atenção!</h4>
            <p>Você está prestes a excluir a cultura **<?= htmlspecialchars($cultura['nome'] ?? 'Registro') ?>**.</p>
            <p>Esta ação não pode ser desfeita. Confirme a exclusão abaixo.</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nome da Cultura:</label>
            <input disabled value="<?= htmlspecialchars($cultura['nome'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tipo de Cultura:</label>
            <input disabled value="<?= htmlspecialchars($cultura['tipo_cultivo'] ?? '') ?>" type="text" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-danger mt-3">
            <i class="fas fa-trash-alt me-1"></i> **EXCLUIR PERMANENTEMENTE**
        </button>
        
        <a href="culturas.php" class="btn btn-secondary mt-3">
            <i class="fas fa-undo me-1"></i> Cancelar e Voltar
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>