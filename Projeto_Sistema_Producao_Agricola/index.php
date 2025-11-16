<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SCA | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --cor-verde-campo: #4CAF50; 
            --cor-terra: #6D4C41; 
            --cor-fundo: #F8F9FA; 
        }
        body {
            background-color: var(--cor-fundo);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-card {
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            color: var(--cor-terra);
            font-weight: 300; 
            margin-bottom: 25px;
        }
        .logo-icon {
            color: var(--cor-verde-campo);
            margin-right: 10px;
        }
        .btn-primary {
            background-color: var(--cor-verde-campo);
            border-color: var(--cor-verde-campo);
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .form-control:focus {
            border-color: var(--cor-verde-campo);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }
    </style>
</head>

<body>
    <div class="login-card">

        <?php
        // --- Mensagens de Feedback do Cadastro (GET) ---
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'cadastro_ok') {
                echo "<p class='text-success text-center'>✅ Cadastro realizado com sucesso! Faça login.</p>";
            } elseif ($status == 'erro_cadastro') {
                echo "<p class='text-danger text-center'>❌ Erro ao realizar o cadastro!</p>";
            }
        }
        
        // --- Lógica de Autenticação (POST) ---
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            require('conexao.php'); 
            
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            try{
                $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
                $stmt->execute([$email]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if($usuario && password_verify($senha, $usuario['senha'])){
                    session_start();
                    $_SESSION['acesso'] = true;
                    $_SESSION['nome'] = $usuario['nome'];
                    header('location: principal.php');
                    exit(); 
                } else {
                    echo "<p class='text-danger text-center mt-3'>Credenciais inválidas! Tente novamente.</p>";
                }
            } catch(\Exception $e){
                echo "<p class='text-danger text-center mt-3'>Erro no servidor: ".$e->getMessage()."</p>";
            }
        }
        ?>

        <h2 class="text-center login-header">
            <i class="fas fa-seedling logo-icon"></i> Sistema de Controle Agrícola
        </h2>
        <p class="text-center text-secondary mb-4">Acesso exclusivo para gerenciamento de produção.</p>
        
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="emailLogin" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailLogin" name="email" placeholder="nome@fazenda.com" required />
            </div>
            <div class="mb-4">
                <label for="senhaLogin" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senhaLogin" name="senha" placeholder="********" required />
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>
        
        <p class="mt-4 text-center">
            Ainda não tem acesso?
            <a href="cadastro.php" class="text-success" style="font-weight: 500;">Cadastre-se aqui</a>
        </p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>