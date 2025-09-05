<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 16</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 16</h1>
<form method="post">
<div class="mb-3">
              <label for="valor" class="form-label">Informe o valor do produto</label>
              <input type="number" id="valor" name="valor" class="form-control" required="">
            </div><div class="mb-3">
              <label for="desconto" class="form-label">Informe o desconto </label>
              <input type="text" id="desconto" name="desconto" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valor = $_POST['valor'];
        $desconto = $_POST['desconto'];
        $valor_desconto = $valor * ($desconto/100);
        $preco_final = $valor - $valor_desconto;

        echo "Preço original: R$ " . number_format($valor, 2, ',', '.') . "<br>";
        echo "Desconto: $desconto%<br>";
        echo "Preço com desconto: R$ " . number_format($preco_final, 2, ',', '.');
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>