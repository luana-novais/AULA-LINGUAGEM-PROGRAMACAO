<?php

require("cabecalho.php");
require("conexao.php"); 


try {
    $stmt_estoque = $pdo->query("SELECT 
                                    tipo, 
                                    SUM(estoque_atual) AS estoque_total
                                 FROM insumos
                                 GROUP BY tipo
                                 ORDER BY estoque_total DESC");
    $dados_estoque = $stmt_estoque->fetchAll(PDO::FETCH_ASSOC);

    $tipos = [];
    $totais_estoque = [];
    foreach ($dados_estoque as $d) {
        $tipos[] = $d['tipo'];
        $totais_estoque[] = (float)$d['estoque_total']; 
    }

} catch (\Exception $e) {
    error_log("Erro ao carregar dados do gráfico de estoque: " . $e->getMessage());
    $tipos = ['Erro Estoque'];
    $totais_estoque = [0];
}

try {
    $stmt_atividades = $pdo->query("SELECT 
                                        tipo_atividade, 
                                        COUNT(id_atividade) AS total_atividades
                                    FROM atividades
                                    GROUP BY tipo_atividade
                                    ORDER BY total_atividades DESC");
    $dados_atividades = $stmt_atividades->fetchAll(PDO::FETCH_ASSOC);

    $nomes_atividades = [];
    $totais_atividades = [];
    foreach ($dados_atividades as $d) {
        $nomes_atividades[] = $d['tipo_atividade'];
        $totais_atividades[] = (int)$d['total_atividades']; 
    }

} catch (\Exception $e) {
    error_log("Erro ao carregar dados do gráfico de atividades: " . $e->getMessage());
    $nomes_atividades = ['Erro Atividades'];
    $totais_atividades = [0];
}

?>

<div class="container mt-5"> <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-success">
                <i class="fas fa-chart-bar me-2"></i> Dashboard Agrícola
            </h1>
            <p class="text-secondary mb-0">Visão geral e métricas principais da fazenda.</p>
        </div>
        <div class="text-end">
             <span class="text-muted small d-block">Olá, **<?= htmlspecialchars($nome_usuario) ?>**</span>
             <a href="logout.php" class="btn btn-sm btn-outline-danger mt-1">
                 <i class="fas fa-sign-out-alt"></i> Sair
             </a>
        </div>
    </div>
    
    <hr>
    
    <div class="row mt-4">
        
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-dark-green text-white fw-bold"> 
                    <i class="fas fa-flask me-2"></i> Estoque de Insumos por Tipo
                </div>
                <div class="card-body">
                    <canvas id="graficoEstoque"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-primary-blue text-white fw-bold">
                    <i class="fas fa-calendar-check me-2"></i> Frequência de Atividades
                </div>
                <div class="card-body">
                    <canvas id="graficoAtividades"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    const cores_vibrantes = [
        '#38761d', // Verde Floresta
        '#3c78d8', // Azul Profundo
        '#e06666', // Vermelho Coral
        '#f1c232', // Amarelo Dourado
        '#8e7cc3', // Roxo Sutil
        '#a2c4c9'  // Ciano Claro
    ];
    
 
    const tipos = <?= json_encode($tipos); ?>;
    const totais_estoque = <?= json_encode($totais_estoque); ?>;
    
    new Chart(
        document.getElementById('graficoEstoque'),
        {
            type: 'bar', 
            data: {
                labels: tipos,
                datasets: [{
                    label: 'Estoque Total (Unidades, Peso, Volume)',
                    data: totais_estoque,
                    backgroundColor: cores_vibrantes.slice(0, tipos.length).map(c => c + 'AA'), 
                    borderColor: cores_vibrantes.slice(0, tipos.length),
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantidade Total'
                        }
                    }
                },
                layout: {
                    padding: 10 
                }
            }
        }
    );

    const nomes_atividades = <?= json_encode($nomes_atividades); ?>;
    const totais_atividades = <?= json_encode($totais_atividades); ?>;

    new Chart(
        document.getElementById('graficoAtividades'),
        {
            type: 'doughnut', 
            data: {
                labels: nomes_atividades,
                datasets: [{
                    label: 'Contagem de Atividades',
                    data: totais_atividades,
                    backgroundColor: cores_vibrantes.slice(0, nomes_atividades.length),
                    hoverOffset: 10 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribuição de Tipos de Atividade'
                    }
                },
                layout: {
                    padding: 10
                }
            }
        }
    );
</script>

<?php
require("rodape.php");
?>