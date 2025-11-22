<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome_insumo'];
    $tipo = $_POST['tipo'];
    $estoque_atual = $_POST['estoque_atual'];       
    $unidade_medida = $_POST['unidade_medida'];    
    $valor_unitario = $_POST['valor_unitario'];    
    
    try{
        $stmt = 
            $pdo->prepare("INSERT INTO insumos (nome, tipo, estoque_atual, unidade_medida, valor_unitario) 
                           VALUES (?, ?, ?, ?, ?)");

        if($stmt->execute([$nome, $tipo, $estoque_atual, $unidade_medida, $valor_unitario])){
            header('location: insumos.php?cadastro=true');
            exit();
        } else {
            header('location: insumos.php?cadastro=false');
            exit();
        }
    }catch(\Exception $e){
        echo "<p class='text-danger'>❌ Erro: ".$e->getMessage()."</p>";
    }
}
require("cabecalho.php");
?>

<h1 class="mb-4">Adicionar Novo Insumo</h1>

<form method="post" action="novo_insumo.php">
    
    <div class="mb-3">
        <label for="nome_insumo" class="form-label">Nome Comercial / Componente:</label>
        <input 
            type="text" 
            id="nome_insumo" 
            name="nome_insumo" 
            class="form-control" 
            placeholder="Ex: Ureia, Semente de Milho, Fungicida X" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Insumo:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value="">Selecione o tipo</option>
            <option value="Semente">Semente</option>
            <option value="Fertilizante">Fertilizante</option>
            <option value="Defensivo">Defensivo</option>
            <option value="Outro">Outro (Combustível, etc.)</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="unidade_medida" class="form-label">Unidade de Medida:</label>
        <input 
            type="text" 
            id="unidade_medida" 
            name="unidade_medida" 
            class="form-control" 
            placeholder="Ex: Kg, Litros, Sacos"
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="estoque_atual" class="class="form-label"">Quantidade Inicial em Estoque:</label>
        <input 
            type="number" 
            step="0.01" 
            id="estoque_atual" 
            name="estoque_atual" 
            class="form-control" 
            placeholder="Ex: 500.50" 
            required
        >
    </div>

    <div class="mb-3">
        <label for="valor_unitario" class="form-label">Valor Unitário (R$):</label>
        <input 
            type="number" 
            step="0.01" 
            id="valor_unitario" 
            name="valor_unitario" 
            class="form-control" 
            placeholder="Ex: 150.99"
            required
        >
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Cadastrar Insumo
    </button>
    <a href="insumos.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Voltar
    </a>
</form>
<?php
require("rodape.php");
?>