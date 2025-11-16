<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    try{
        $stmt = $pdo->prepare("SELECT id, nome, tipo, data_criacao FROM culturas WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $cultura = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$cultura) {
            header('location: culturas.php?editar=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar cultura: ".$e->getMessage();
    }
require("cabecalho.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $id = $_POST['id']; 

    try{
        $stmt = $pdo->prepare("UPDATE culturas SET nome = ?, tipo = ? WHERE id = ?");
        if($stmt->execute([$nome, $tipo, $id])){
            header('location: culturas.php?editar=true');
            exit();
        } else {
            header('location: culturas.php?editar=false');
            exit();
        }
    }catch(\Exception $e){
        echo "Erro ao editar cultura: ".$e->getMessage();
    }
}
?>

<h1 class="mb-4">✏️ Editar Cultura</h1>

<form method="post" action="editar_cultura.php">
    
    <input type="hidden" name="id" value="<?= $cultura['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Cultura:</label>
        <input 
            value="<?= htmlspecialchars($cultura['nome'] ?? '') ?>"
            type="text" 
            id="nome" 
            name="nome" 
            class="form-control" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Cultura:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <?php $currentType = $cultura['tipo'] ?? ''; ?>
            <option value="">Selecione o tipo</option>
            <option value="Grão" <?= $currentType == 'Grão' ? 'selected' : '' ?>>Grão</option>
            <option value="Fruta" <?= $currentType == 'Fruta' ? 'selected' : '' ?>>Fruta</option>
            <option value="Hortaliça" <?= $currentType == 'Hortaliça' ? 'selected' : '' ?>>Hortaliça</option>
            <option value="Outros" <?= $currentType == 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Salvar Edição
    </button>
    <a href="culturas.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Cancelar
    </a>
</form>

<?php
require("rodape.php");
?>
