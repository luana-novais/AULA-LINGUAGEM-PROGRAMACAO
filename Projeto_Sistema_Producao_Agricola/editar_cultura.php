<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    try{
        $stmt = $pdo->prepare("SELECT * FROM culturas WHERE id_cultura = ?");
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
    $tipo_cultivo = $_POST['tipo_cultivo']; 
    $ciclo_dias = $_POST['ciclo_dias'];     
    $descricao = $_POST['descricao'];      
    $id = $_POST['id_cultura'];       
    
    try{
        $stmt = $pdo->prepare("UPDATE culturas 
                               SET nome = ?, 
                                   tipo_cultivo = ?, 
                                   ciclo_dias = ?,
                                   descricao = ?
                               WHERE id_cultura = ?");
        
        if($stmt->execute([$nome, $tipo_cultivo, $ciclo_dias, $descricao, $id])){
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
    
    <input type="hidden" name="id_cultura" value="<?= $cultura['id_cultura'] ?? '' ?>">
    
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
        <label for="tipo_cultivo" class="form-label">Tipo de Cultura:</label>
        <select id="tipo_cultivo" name="tipo_cultivo" class="form-select" required>
            <?php $currentType = $cultura['tipo_cultivo'] ?? ''; ?>
            <option value="">Selecione o tipo</option>
            <option value="Grão" <?= $currentType == 'Grão' ? 'selected' : '' ?>>Grão</option>
            <option value="Fruta" <?= $currentType == 'Fruta' ? 'selected' : '' ?>>Fruta</option>
            <option value="Hortaliça" <?= $currentType == 'Hortaliça' ? 'selected' : '' ?>>Hortaliça</option>
            <option value="Outros" <?= $currentType == 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="ciclo_dias" class="form-label">Ciclo de Vida (Dias):</label>
        <input 
            value="<?= htmlspecialchars($cultura['ciclo_dias'] ?? '') ?>"
            type="number" 
            step="1" 
            id="ciclo_dias" 
            name="ciclo_dias" 
            class="form-control" 
            placeholder="Ex: 120"
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição / Notas:</label>
        <textarea 
            id="descricao" 
            name="descricao" 
            class="form-control" 
            rows="3"
        ><?= htmlspecialchars($cultura['descricao'] ?? '') ?></textarea>
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