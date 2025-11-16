<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro | SCA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style> 
        :root { --cor-verde-campo: #4CAF50; }
        body { background-color: #F8F9FA; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .cadastro-card { background-color: #FFFFFF; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); max-width: 450px; width: 100%; }
        .btn-success { background-color: var(--cor-verde-campo); border-color: var(--cor-verde-campo); }
        .btn-success:hover { background-color: #45a049; border-color: #45a049; }
    </style>
</head>

<body>
    <div class="cadastro-card">
        <h2 class="text-center" style="color: #6D4C41;"><i class="fas fa-user-plus me-2" style="color: var(--cor-verde-campo);"></i> Novo Usuário</h2>
        <p class="text-center text-secondary mb-4">Preencha os dados para realizar o cadastro.</p>
        <form action="cadastro.php" method="POST">
            <div class="mb-3"><label for="nomeCadastro" class="form-label">Nome Completo</label><input type="text" class="form-control" id="nomeCadastro" name="nome" required /></div>
            <div class="mb-3"><label for="emailCadastro" class="form-label">Email</label><input type="email" class="form-control" id="emailCadastro" name="email" required /></div>
            <div class="mb-4"><label for="senhaCadastro" class="form-label">Senha</label><input type="password" class="form-control" id="senhaCadastro" name="senha" required /></div>
            <button type="submit" class="btn btn-success w-100"><i class="fas fa-check-circle me-1"></i> Cadastrar</button>
        </form>
        <p class="mt-4 text-center">Já tem uma conta? <a href="index.php" class="text-success" style="font-weight: 500;">Faça login aqui</a></p>
    </div>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    require("conexao.php"); 
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    
    try{
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        if($stmt->execute([$nome, $email, $senha])){
            header("location: index.php?status=cadastro_ok"); 
            exit(); 
        } else{
            header("location: index.php?status=erro_cadastro"); 
            exit();
        }
    } catch(Exception $e){
        header("location: index.php?status=erro_cadastro&msg=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
</body>
</html>