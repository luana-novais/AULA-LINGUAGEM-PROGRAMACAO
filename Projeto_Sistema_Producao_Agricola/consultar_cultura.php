<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id']; 
    try{
        $stmt = $pdo->prepare("DELETE FROM culturas WHERE id = ?");
        if($stmt->execute([$id])){
            header('location: culturas.php?excluir=true');
        } else {
            header('location: culturas.php?excluir=false');
        }
    }catch(\Exception $e){
        echo "Erro ao excluir cultura: ".$e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id'])) {
        header('location: culturas.php');
        exit();
    }
    try{
        $stmt = $pdo->prepare("SELECT id, nome, tipo FROM culturas WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $cultura = $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (Exception $e){
        echo "Erro ao consultar cultura: ".$e->getMessage();
    }
}

require("cabecalho.php"); 
?>

<h1 class="mb-4">🔍 Consultar e Excluir Cultura</h1>

<form method="post" action="consultar_cultura.php">
    
    <input type="hidden" name="id" value="<?= $cultura['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label class="form-label">Nome da Cultura:</label>
        <input 
            disabled 
            value="<?= htmlspecialchars($cultura['nome'] ?? '') ?>"
            type="text" 
            class="form-control"
        >
    </div>
    
    <div class="mb-3">
        <label class="form-label">Tipo da Cultura:</label>
        <input 
            disabled 
            value="<?= htmlspecialchars($cultura['tipo'] ?? '') ?>"
            type="text" 
            class="form-control"
        >
    </div>
    
    <p class="mt-4 text-danger">⚠️ <strong>ATENÇÃO:</strong> Deseja realmente excluir esta cultura?</p>

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
