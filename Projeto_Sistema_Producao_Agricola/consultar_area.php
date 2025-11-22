<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: areas.php');
        exit();
    }
    
    try{
        $stmt = $pdo->prepare("SELECT 
                                id_area, 
                                nome_talhao, 
                                tamanho_hectares, 
                                coordenadas, 
                                tipo_solo,
                                data_cadastro
                               FROM areas 
                               WHERE id_area = ?");
        $stmt->execute([$_GET['id']]);
        $area = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$area) {
            header('location: areas.php');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar área: ".$e->getMessage();
    }
} else {
    header('location: areas.php');
    exit();
}

require("cabecalho.php"); 
?>

<div class="container mt-4">

    <h1 class="mb-4">🔍 Consultar Detalhes da Área</h1>

    <form>
        
        <div class="mb-3">
            <label class="form-label">ID da Área:</label>
            <input disabled value="<?= htmlspecialchars($area['id_area'] ?? '') ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nome do Talhão:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($area['nome_talhao'] ?? '') ?>"
                type="text" 
                class="form-control"
            >
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tamanho (Hectares):</label>
            <input 
                disabled 
                value="<?= number_format($area['tamanho_hectares'] ?? 0, 2, ',', '.') ?> ha"
                type="text" 
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Coordenadas (GPS):</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($area['coordenadas'] ?? 'N/A') ?>"
                type="text" 
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Solo:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($area['tipo_solo'] ?? 'N/A') ?>"
                type="text" 
                class="form-control"
            >
        </div>
        
        <div class="mb-3">
            <label class="form-label">Data de Cadastro:</label>
            <input 
                disabled 
                value="<?= htmlspecialchars($area['data_cadastro'] ?? '') ?>"
                type="text" 
                class="form-control"
            >
        </div>
        
        <a href="editar_area.php?id=<?= $area['id_area'] ?? '' ?>" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Editar
        </a>
        <a href="excluir_area.php?id=<?= $area['id_area'] ?? '' ?>" class="btn btn-danger">
            <i class="fas fa-trash-alt me-1"></i> Excluir
        </a>
        <a href="areas.php" class="btn btn-secondary">
            <i class="fas fa-undo me-1"></i> Voltar para a Lista
        </a>

    </form>
</div>

<?php
require("rodape.php");
?>