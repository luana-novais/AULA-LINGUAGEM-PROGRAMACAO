<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $tipo_cultivo = $_POST['tipo_cultivo']; 
    $ciclo_dias = $_POST['ciclo_dias'];     
    $descricao = $_POST['descricao'];       
    
    try{
        $stmt = 
            $pdo->prepare("INSERT INTO culturas (nome, tipo_cultivo, ciclo_dias, descricao) 
                           VALUES (?, ?, ?, ?)");
  
        if($stmt->execute([$nome, $tipo_cultivo, $ciclo_dias, $descricao])){
            header('location: culturas.php?cadastro=true');
            exit();
        } else {
            header('location: culturas.php?cadastro=false');
            exit();
        }
    }catch(\Exception $e){
        echo "<p class='text-danger'>❌ Erro: ".$e->getMessage()."</p>";
    }
}

require("cabecalho.php");
?>

<h1 class="mb-4">Adicionar Nova Cultura</h1>

<form method="post" action="nova_cultura.php">
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Cultura:</label>
        <input 
            type="text" 
            id="nome" 
            name="nome" 
            class="form-control" 
            placeholder="Ex: Milho, Soja, Trigo" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo_cultivo" class="form-label">Tipo de Cultura:</label>
        <select id="tipo_cultivo" name="tipo_cultivo" class="form-select" required>
            <option value="">Selecione o tipo</option>
            <option value="Grão">Grão</option>
            <option value="Fruta">Fruta</option>
            <option value="Legume">Legume</option>
            <option value="Verdura">Verdura</option>
            <option value="Outros">Outros</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="ciclo_dias" class="form-label">Ciclo de Vida (Dias):</label>
        <input 
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
            placeholder="Detalhes importantes sobre a variedade ou o cultivo."
        ></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Cadastrar Cultura
    </button>
    <a href="culturas.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Voltar
    </a>
</form>

<?php
require("rodape.php");
?>