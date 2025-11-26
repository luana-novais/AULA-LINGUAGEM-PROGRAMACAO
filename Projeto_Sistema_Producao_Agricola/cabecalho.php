<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] !== true) {
    header('location: index.php');
    exit();
}
$nome_usuario = $_SESSION['nome'] ;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $page_title ?? 'SCA | Dashboard'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --cor-verde-campo: #4CAF50;
            --cor-barra: #FFFFFF;
            --cor-fundo: #F8F9FA;
            --cor-texto-nav: #343a40;
            --cor-sombra: rgba(0, 0, 0, 0.05);
        }
        body { background-color: var(--cor-fundo); }
        .navbar {
            box-shadow: 0 2px 4px var(--cor-sombra);
            background-color: var(--cor-barra);
        }
        .nav-link:hover { color: var(--cor-verde-campo) !important; }
        .footer {
            background-color: #e9ecef;
            color: #6c757d;
            padding: 20px 0;
            text-align: center;
        }
        
        @media print {
            .no-print{
                display: none !important;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg no-print">
        <div class="container-fluid container">
            
            <a class="navbar-brand" href="principal.php">
                <i class="fas fa-leaf logo-icon me-2" style="color: var(--cor-verde-campo);"></i> 
                SCA
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="principal.php"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownCadastros" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-list-ul me-1"></i> Cadastros & Gestão
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownCadastros">
                            <li><a class="dropdown-item" href="culturas.php"><i class="fas fa-seedling me-1"></i> Culturas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="areas.php"><i class="fas fa-map-marker-alt me-1"></i> Áreas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="insumos.php"><i class="fas fa-flask me-1"></i> Insumos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="atividades.php"><i class="fas fa-tractor me-1"></i>Registrar Atividade</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> Olá, <?php echo htmlspecialchars($nome_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container py-3">