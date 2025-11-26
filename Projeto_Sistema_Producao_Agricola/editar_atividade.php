<?php
require("conexao.php");

// --- CARREGAR DADOS AUXILIARES ---
try {
    // Culturas
    $stmtCulturas = $pdo->query("SELECT id_cultura, nome FROM culturas ORDER BY nome");
    $culturas = $stmtCulturas->fetchAll(PDO::FETCH_ASSOC);

    // Áreas
    $stmtAreas = $pdo->query("SELECT id_area, nome_talhao FROM areas ORDER BY nome_talhao");
    $areas = $stmtAreas->fetchAll(PDO::FETCH_ASSOC);

    // Insumos (Opcional)
    $stmtInsumos = $pdo->query("SELECT id_insumo, nome, unidade_medida FROM insumos ORDER BY nome");
    $insumos = $stmtInsumos->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro ao carregar dados auxiliares: " . $e->getMessage();
    $culturas = []; $areas = []; $insumos = [];
}
// ----------------------------------


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: atividades.php?editar=false');
        exit();
    }
    
    try{
        // SELECT para buscar os dados da atividade
        $stmt = $pdo->prepare("SELECT * FROM atividades WHERE id_atividade = ?");
        $stmt->execute([$_GET['id']]);
        $atividade = $stmt->fetch(PDO::FETCH_ASSOC); 

        if (!$atividade) {
            header('location: atividades.php?editar=false');
            exit();
        }
    } catch (Exception $e){
        echo "Erro ao consultar atividade: ".$e->getMessage();
    }
require("cabecalho.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $data_hora = $_POST['data_hora'];
    $tipo_atividade = $_POST['tipo_atividade'];
    $quantidade_aplicada = empty($_POST['quantidade_aplicada']) ? NULL : $_POST['quantidade_aplicada'];
    $observacoes = $_POST['observacoes'];
    
    $id_cultura = $_POST['id_cultura'];
    $id_area = $_POST['id_area'];
    $id_insumo = empty($_POST['id_insumo']) ? NULL : $_POST['id_insumo'];
    $id = $_POST['id_atividade']; 
    
    try{
        $stmt = $pdo->prepare("UPDATE atividades 
                               SET data_hora = ?, 
                                   tipo_atividade = ?, 
                                   quantidade_aplicada = ?,
                                   observacoes = ?,
                                   id_cultura = ?,
                                   id_area = ?,
                                   id_insumo = ?
                               WHERE id_atividade = ?");
        
        if($stmt->execute([$data_hora, $tipo_atividade, $quantidade_aplicada, $observacoes, $id_cultura, $id_area, $id_insumo, $id])){
            header('location: atividades.php?editar=true');
            exit();
        } else {
            header('location: atividades.php?editar=false');
            exit();
        }
    }catch(\Exception $e){
        echo "Erro ao editar atividade: ".$e->getMessage();
    }
}
// Se for POST, a execução é interrompida pelo header/exit. Se for GET, o formulário é exibido.
?>

<h1 class="mb-4">✏️ Editar Atividade</h1>

<form method="post" action="editar_atividade.php">
    
    <input type="hidden" name="id_atividade" value="<?= $atividade['id_atividade'] ?? '' ?>">
    
    <div class="mb-3">
        <label for="data_hora" class="form-label">Data e Hora da Atividade:</label>
        <input 
            value="<?= htmlspecialchars($atividade['data_hora'] ?? '') ?>"
            type="datetime-local" 
            id="data_hora" 
            name="data_hora" 
            class="form-control" 
            required
        >
    </div>

    <div class="mb-3">
        <label for="tipo_atividade" class="form-label">Tipo de Atividade:</label>
        <select id="tipo_atividade" name="tipo_atividade" class="form-select" required>
            <?php $currentType = $atividade['tipo_atividade'] ?? ''; ?>
            <option value="">Selecione o tipo</option>
            <option value="Plantio" <?= $currentType == 'Plantio' ? 'selected' : '' ?>>Plantio</option>
            <option value="Colheita" <?= $currentType == 'Colheita' ? 'selected' : '' ?>>Colheita</option>
            <option value="Pulverização" <?= $currentType == 'Pulverização' ? 'selected' : '' ?>>Pulverização</option>
            <option value="Fertilização" <?= $currentType == 'Fertilização' ? 'selected' : '' ?>>Fertilização</option>
            <option value="Irrigação" <?= $currentType == 'Irrigação' ? 'selected' : '' ?>>Irrigação</option>
            <option value="Outro" <?= $currentType == 'Outro' ? 'selected' : '' ?>>Outro</option>
        </select>
    </div>
    
    <h3>Vínculos (Obrigatórios)</h3>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="id_cultura" class="form-label">Cultura:</label>
            <select id="id_cultura" name="id_cultura" class="form-select" required>
                <option value="">Selecione a Cultura</option>
                <?php $currentCulturaId = $atividade['id_cultura'] ?? ''; ?>
                <?php foreach ($culturas as $cultura): ?>
                    <option value="<?= $cultura['id_cultura'] ?>" <?= $currentCulturaId == $cultura['id_cultura'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cultura['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="id_area" class="form-label">Área/Talhão:</label>
            <select id="id_area" name="id_area" class="form-select" required>
                <option value="">Selecione a Área</option>
                <?php $currentAreaId = $atividade['id_area'] ?? ''; ?>
                <?php foreach ($areas as $area): ?>
                    <option value="<?= $area['id_area'] ?>" <?= $currentAreaId == $area['id_area'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($area['nome_talhao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <h3>Detalhes (Opcionais)</h3>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="id_insumo" class="form-label">Insumo Utilizado:</label>
            <select id="id_insumo" name="id_insumo" class="form-select">
                <option value="">Nenhum insumo (Opcional)</option>
                <?php $currentInsumoId = $atividade['id_insumo'] ?? ''; ?>
                <?php foreach ($insumos as $insumo): ?>
                    <option value="<?= $insumo['id_insumo'] ?>" <?= $currentInsumoId == $insumo['id_insumo'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($insumo['nome']) ?> (<?= htmlspecialchars($insumo['unidade_medida']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="quantidade_aplicada" class="form-label">Quantidade Aplicada (Se aplicável):</label>
            <input 
                value="<?= htmlspecialchars($atividade['quantidade_aplicada'] ?? '') ?>"
                type="number" 
                step="0.01" 
                id="quantidade_aplicada" 
                name="quantidade_aplicada" 
                class="form-control" 
                placeholder="Ex: 50.00"
            >
        </div>
    </div>

    <div class="mb-3">
        <label for="observacoes" class="form-label">Observações / Notas:</label>
        <textarea 
            id="observacoes" 
            name="observacoes" 
            class="form-control" 
            rows="3"
        ><?= htmlspecialchars($atividade['observacoes'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Salvar Edição
    </button>
    <a href="atividades.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Cancelar
    </a>
</form>

<?php
require("rodape.php");
?>