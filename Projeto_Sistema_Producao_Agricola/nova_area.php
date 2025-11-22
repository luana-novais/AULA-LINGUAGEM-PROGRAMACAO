<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $nome_talhao = $_POST['nome_talhao'];
    $tamanho_hectares = $_POST['tamanho_hectares'];
    $coordenadas = $_POST['coordenadas'];
    $tipo_solo = $_POST['tipo_solo'];
    
    try{
        $stmt = 
            $pdo->prepare("INSERT INTO areas (nome_talhao, tamanho_hectares, coordenadas, tipo_solo) 
                           VALUES (?, ?, ?, ?)");
    
        if($stmt->execute([$nome_talhao, $tamanho_hectares, $coordenadas, $tipo_solo])){
            header('location: areas.php?cadastro=true');
            exit();
        } else {
            header('location: areas.php?cadastro=false');
            exit();
        }
    }catch(\Exception $e){
        echo "<p class='text-danger'>❌ Erro: ".$e->getMessage()."</p>";
    }
}
require("cabecalho.php");
?>

<h1 class="mb-4">Adicionar Nova Área (Talhão)</h1>

<form method="post" action="nova_area.php">
    
    <div class="mb-3">
        <label for="nome_talhao" class="form-label">Nome do Talhão:</label>
        <input 
            type="text" 
            id="nome_talhao" 
            name="nome_talhao" 
            class="form-control" 
            placeholder="Ex: Talhão 1, Pasto Sul" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tamanho_hectares" class="form-label">Tamanho (Hectares):</label>
        <input 
            type="number" 
            step="0.01" 
            id="tamanho_hectares" 
            name="tamanho_hectares" 
            class="form-control" 
            placeholder="Ex: 15.75" 
            required
        >
    </div>

    <div class="mb-3">
        <label for="coordenadas" class="form-label">Coordenadas (GPS):</label>
        <input 
            type="text" 
            id="coordenadas" 
            name="coordenadas" 
            class="form-control" 
            placeholder="Ex: -22.12345, -51.67890 (Opcional)"
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo_solo" class="form-label">Tipo de Solo:</label>
        <select id="tipo_solo" name="tipo_solo" class="form-select">
            <option value="">Selecione o Tipo (Opcional)</option>
            <option value="Argiloso">Argiloso</option>
            <option value="Arenoso">Arenoso</option>
            <option value="Misto">Misto</option>
            <option value="Latossolo">Latossolo</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Cadastrar Área
    </button>
    <a href="areas.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Voltar
    </a>
</form>

<?php
require("rodape.php");
?>