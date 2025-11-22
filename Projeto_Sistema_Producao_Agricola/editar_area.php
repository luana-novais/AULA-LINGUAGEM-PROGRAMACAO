<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: areas.php?editar=false');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT 
                                id_area, 
                                nome_talhao, 
                                tamanho_hectares, 
                                coordenadas, 
                                tipo_solo 
                               FROM areas WHERE id_area = ?");
        $stmt->execute([$_GET['id']]);
        $area = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$area) {
            header('location: areas.php?editar=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar área: ".$e->getMessage();
    }
require("cabecalho.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome_talhao = $_POST['nome_talhao'];
    $tamanho_hectares = $_POST['tamanho_hectares']; 
    $coordenadas = $_POST['coordenadas'];
    $tipo_solo = $_POST['tipo_solo'];
    $id = $_POST['id_area']; 
    
    try{
        $stmt = $pdo->prepare("UPDATE areas 
                               SET nome_talhao = ?, 
                                   tamanho_hectares = ?,
                                   coordenadas = ?,
                                   tipo_solo = ?
                               WHERE id_area = ?");
        
        if($stmt->execute([$nome_talhao, $tamanho_hectares, $coordenadas, $tipo_solo, $id])){
            header('location: areas.php?editar=true');
            exit();
        } else {
            header('location: areas.php?editar=false');
            exit();
        }
    }catch(\Exception $e){
        echo "Erro ao editar área: ".$e->getMessage();
    }
}
?>

<h1 class="mb-4">✏️ Editar Área (Talhão)</h1>

<form method="post" action="editar_area.php">
    
    <input type="hidden" name="id_area" value="<?= $area['id_area'] ?? '' ?>">
    
    <div class="mb-3">
        <label for="nome_talhao" class="form-label">Nome do Talhão:</label>
        <input 
            value="<?= htmlspecialchars($area['nome_talhao'] ?? '') ?>"
            type="text" 
            id="nome_talhao" 
            name="nome_talhao" 
            class="form-control" 
            required
        >
    </div>
    
    <div class="mb-3">
        <label for="tamanho_hectares" class="form-label">Tamanho (Hectares):</label>
        <input 
            value="<?= htmlspecialchars($area['tamanho_hectares'] ?? '') ?>"
            type="number" 
            step="0.01" 
            id="tamanho_hectares" 
            name="tamanho_hectares" 
            class="form-control" 
            required
        >
    </div>

    <div class="mb-3">
        <label for="coordenadas" class="form-label">Coordenadas (GPS):</label>
        <input 
            value="<?= htmlspecialchars($area['coordenadas'] ?? '') ?>"
            type="text" 
            id="coordenadas" 
            name="coordenadas" 
            class="form-control" 
            placeholder="Ex: -22.12345, -51.67890"
        >
    </div>
    
    <div class="mb-3">
        <label for="tipo_solo" class="form-label">Tipo de Solo:</label>
        <select id="tipo_solo" name="tipo_solo" class="form-select">
            <?php $currentSolo = $area['tipo_solo'] ?? ''; ?>
            <option value="">Selecione o Tipo (Opcional)</option>
            <option value="Argiloso" <?= $currentSolo == 'Argiloso' ? 'selected' : '' ?>>Argiloso</option>
            <option value="Arenoso" <?= $currentSolo == 'Arenoso' ? 'selected' : '' ?>>Arenoso</option>
            <option value="Misto" <?= $currentSolo == 'Misto' ? 'selected' : '' ?>>Misto</option>
            <option value="Latossolo" <?= $currentSolo == 'Latossolo' ? 'selected' : '' ?>>Latossolo</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Salvar Edição
    </button>
    <a href="areas.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Cancelar
    </a>
</form>

<?php
require("rodape.php");
?>