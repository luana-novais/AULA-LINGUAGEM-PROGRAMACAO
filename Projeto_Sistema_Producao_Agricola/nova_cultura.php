<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    
    try{
        $stmt = 
            $pdo->prepare("INSERT INTO culturas (nome, tipo) VALUES (?, ?)");
            
        if($stmt->execute([$nome, $tipo])){
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

<form method="post" action="novo_cultura.php">
    
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
        <label for="tipo" class="form-label">Tipo da Cultura:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value="">Selecione o tipo</option>
            <option value="Grão">Grão</option>
            <option value="Fruta">Fruta</option>
            <option value="Legume">Legume</option>
            <option value="Verdura">Verdura</option>
            <option value="Outros">Outros</option>
        </select>
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
