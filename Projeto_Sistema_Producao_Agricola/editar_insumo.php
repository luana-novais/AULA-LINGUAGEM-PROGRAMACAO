<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    try{
        $stmt = $pdo->prepare("SELECT id, nome, tipo, quantidade from insumos WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $insumo = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$insumo) {
            header('location: insumos.php?editar=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar insumo: ".$e->getMessage();
    }
require("cabecalho.php");
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];
    $id = $_POST['id']; 
    try{
        $stmt = 
            $pdo->prepare("UPDATE insumos SET nome = ?, tipo = ?, quantidade = ? WHERE id = ?");
        if($stmt->execute([$nome, $tipo, $quantidade, $id])){
            header('location: insumos.php?editar=true');
            exit();
        } else {
            header('location: insumos.php?editar=false');
            exit();
        }
    }catch(\Exception $e){
        echo "Erro ao editar insumo: ".$e->getMessage();
    }
}
?>

<h1 class="mb-4">✏️ Editar Insumo</h1>

<form method="post" action="editar_insumo.php">
    
    <input type="hidden" name="id" value="<?= $insumo['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Comercial / Componente:</label>
        <input 
            value="<?= htmlspecialchars($insumo['nome'] ?? '') ?>"
            type="text" 
            id="nome" 
            name="nome" 
            class="form-control" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Insumo:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <?php $currentType = $insumo['tipo'] ?? ''; ?>
            <option value="">Selecione o tipo</option>
            <option value="Semente" <?= $currentType == 'Semente' ? 'selected' : '' ?>>Semente</option>
            <option value="Fertilizante" <?= $currentType == 'Fertilizante' ? 'selected' : '' ?>>Fertilizante</option>
            <option value="Defensivo" <?= $currentType == 'Defensivo' ? 'selected' : '' ?>>Defensivo</option>
            <option value="Outro" <?= $currentType == 'Outro' ? 'selected' : '' ?>>Outro (Combustível, etc.)</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade em Estoque:</label>
        <input 
            value="<?= htmlspecialchars($insumo['quantidade'] ?? '') ?>"
            type="number" 
            step="0.01" 
            id="quantidade" 
            name="quantidade" 
            class="form-control" 
            required
        >
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Salvar Edição
    </button>
    <a href="insumos.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Cancelar
    </a>
</form>

<?php
require("rodape.php");
?>