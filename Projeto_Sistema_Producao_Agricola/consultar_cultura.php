<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: culturas.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT * FROM culturas WHERE id_cultura = ?");
        $stmt->execute([$_GET['id']]);
        $cultura = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$cultura) {
            header('location: culturas.php');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar cultura: ".$e->getMessage();
    }
} else {
    header('location: culturas.php');
    exit();
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4">🔍 Consultar Detalhes da Cultura</h1>

    <form> <input type="hidden" name="id_cultura" value="<?= $cultura['id_cultura'] ?? '' ?>">
        
        <div class="mb-3">
            <label class="form-label">ID da Cultura:</label>
            <input disabled value="<?= htmlspecialchars($cultura['id_cultura'] ?? '') ?>" type="text" class="form-control">
        </div>

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
            <label class="form-label">Tipo de Cultura:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($cultura['tipo_cultivo'] ?? '') ?>"
                type="text" 
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Ciclo de Vida (Dias):</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($cultura['ciclo_dias'] ?? '') ?>"
                type="text" 
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição / Notas:</label>
            <textarea 
                disabled 
                class="form-control"
                rows="3"
            ><?= htmlspecialchars($cultura['descricao'] ?? '') ?></textarea>
        </div>
        
        <a href="editar_cultura.php?id=<?= $cultura['id_cultura'] ?? '' ?>" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Editar
        </a>
        <a href="excluir_cultura.php?id=<?= $cultura['id_cultura'] ?? '' ?>" class="btn btn-danger">
            <i class="fas fa-trash-alt me-1"></i> Excluir
        </a>
        <a href="culturas.php" class="btn btn-secondary">
            <i class="fas fa-undo me-1"></i> Voltar 
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>