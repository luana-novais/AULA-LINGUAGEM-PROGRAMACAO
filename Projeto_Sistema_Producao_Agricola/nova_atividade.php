<?php
require("conexao.php");

// --- CARREGAR DADOS AUXILIARES (CULTURAS, ÁREAS, INSUMOS) ---
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
    // Se a carga de dados auxiliares falhar, registra o erro mas permite continuar (o formulário ficará vazio)
    error_log("Erro ao carregar dados auxiliares: " . $e->getMessage());
    $culturas = []; $areas = []; $insumos = [];
}
// ----------------------------------

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    // Coleta e sanitização dos dados
    $data_hora = $_POST['data_hora'];
    $tipo_atividade = $_POST['tipo_atividade'];
    // Tratamento de campos opcionais (seta para NULL se estiverem vazios)
    $quantidade_aplicada = empty($_POST['quantidade_aplicada']) ? NULL : $_POST['quantidade_aplicada'];
    $observacoes = $_POST['observacoes'];
    
    $id_cultura = $_POST['id_cultura'];
    $id_area = $_POST['id_area'];
    $id_insumo = empty($_POST['id_insumo']) ? NULL : $_POST['id_insumo'];
    
    try{
        // 1. INICIA A TRANSAÇÃO: Garante que ou os dois comandos SQL funcionam, ou nenhum funciona
        $pdo->beginTransaction(); 
        
        // 2. INSERIR A ATIVIDADE
        $stmt = 
            $pdo->prepare("INSERT INTO atividades (data_hora, tipo_atividade, quantidade_aplicada, observacoes, id_cultura, id_area, id_insumo) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
            
        if($stmt->execute([$data_hora, $tipo_atividade, $quantidade_aplicada, $observacoes, $id_cultura, $id_area, $id_insumo])){
            
            // 3. VERIFICAR E DIMINUIR O ESTOQUE
            if ($id_insumo !== NULL && $quantidade_aplicada !== NULL && $quantidade_aplicada > 0) {
                
                // SQL para subtrair a quantidade aplicada do estoque atual
                $stmt_estoque = $pdo->prepare("UPDATE insumos 
                                               SET estoque_atual = estoque_atual - ? 
                                               WHERE id_insumo = ?");
                
                if(!$stmt_estoque->execute([$quantidade_aplicada, $id_insumo])){
                    // Se a diminuição do estoque falhar, cancela a transação e o registro da atividade
                    $pdo->rollBack();
                    header('location: atividades.php?cadastro=false&motivo=estoque');
                    exit();
                }
            }
            
            // 4. SE TUDO FUNCIONOU (INSERÇÃO + AJUSTE DE ESTOQUE), CONFIRMA A TRANSAÇÃO
            $pdo->commit();
            header('location: atividades.php?cadastro=true');
            exit();
            
        } else {
            // Se a inserção da atividade falhar
            $pdo->rollBack();
            header('location: atividades.php?cadastro=false');
            exit();
        }
    }catch(\Exception $e){
        // Em caso de erro, desfaz qualquer operação pendente
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log("Erro durante o cadastro de atividade: " . $e->getMessage());
        header('location: atividades.php?cadastro=false&motivo=excecao');
        exit();
    }
}
require("cabecalho.php");
?>

<h1 class="mb-4">Adicionar Nova Atividade</h1>

<form method="post" action="nova_atividade.php">
    
    <div class="mb-3">
        <label for="data_hora" class="form-label">Data e Hora da Atividade:</label>
        <input 
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
            <option value="">Selecione o tipo</option>
            <option value="Plantio">Plantio</option>
            <option value="Colheita">Colheita</option>
            <option value="Pulverização">Pulverização</option>
            <option value="Fertilização">Fertilização</option>
            <option option value="Irrigação">Irrigação</option>
            <option value="Outro">Outro</option>
        </select>
    </div>
    
    <h3>Vínculos (Obrigatórios)</h3>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="id_cultura" class="form-label">Cultura:</label>
            <select id="id_cultura" name="id_cultura" class="form-select" required>
                <option value="">Selecione a Cultura</option>
                <?php foreach ($culturas as $cultura): ?>
                    <option value="<?= $cultura['id_cultura'] ?>"><?= htmlspecialchars($cultura['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="id_area" class="form-label">Área/Talhão:</label>
            <select id="id_area" name="id_area" class="form-select" required>
                <option value="">Selecione a Área</option>
                <?php foreach ($areas as $area): ?>
                    <option value="<?= $area['id_area'] ?>"><?= htmlspecialchars($area['nome_talhao']) ?></option>
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
                <?php foreach ($insumos as $insumo): ?>
                    <option value="<?= $insumo['id_insumo'] ?>"><?= htmlspecialchars($insumo['nome']) ?> (<?= htmlspecialchars($insumo['unidade_medida']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="quantidade_aplicada" class="form-label">Quantidade Aplicada (Se aplicável):</label>
            <input 
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
        ></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Registrar Atividade
    </button>
    <a href="atividades.php" class="btn btn-secondary">
        <i class="fas fa-undo me-1"></i> Voltar
    </a>
</form>

<?php
require("rodape.php");
?>