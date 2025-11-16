<?php
require("conexao.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id']; 
    try{
        $stmt = $pdo->prepare("DELETE FROM insumos WHERE id = ?");
        if($stmt->execute([$id])){
            header('location: insumos.php?excluir=true');
        } else {
            header('location: insumos.php?excluir=false');
        }
    }catch(\Exception $e){
        echo "Erro ao excluir insumo: ".$e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id'])) {
        header('location: insumos.php');
        exit();
    }
    try{
        $stmt = $pdo->prepare("SELECT id, nome, tipo, quantidade from insumos WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $insumo = $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (Exception $e){
        echo "Erro ao consultar insumo: ".$e->getMessage();
    }
}

require("cabecalho.php"); 
?>

<h1 class="mb-4">🔍 Consultar e Excluir Insumo</h1>

<form method="post" action="consultar_insumo.php">
    
    <input type="hidden" name="id" value="<?= $insumo['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Comercial / Componente:</label>
        <input 
            disabled 
            value="<?= htmlspecialchars($insumo['nome'] ?? '') ?>"
            type="text" 
            id="nome" 
            name="nome" 
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
            name="tipo" 
            class="form-control"
        >
    </div>
    
    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade em Estoque:</label>
        <input 
            disabled 
            value="<?= htmlspecialchars($insumo['quantidade'] ?? '') ?>"
            type="text" 
            id="quantidade" 
            name="quantidade" 
            class="form-control"
        >
    </div>
    
    <p class="mt-4 text-danger">⚠️ **ATENÇÃO:** Deseja realmente excluir este registro de Insumo?</p>

    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash-alt me-1"></i> Excluir
    </button>
    
    <button onclick="history.back();" type="button" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Voltar
    </button>
    
</form>

<?php
require("rodape.php");
?>