<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 15</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 15</h1>
<form method="post">
  <div class="mb-3">
    <label for="altura" class="form-label">Informe sua altura (em m)</label>
    <input type="number" id="altura" name="altura" class="form-control" step="0.01" required>
  </div>
  <div class="mb-3">
    <label for="peso" class="form-label">Informe seu peso (em kg)</label>
    <input type="number" id="peso" name="peso" class="form-control" step="0.1" required>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $altura = (float) $_POST['altura'];
    $peso = (float) $_POST['peso'];

    if ($altura > 0) {
        $imc = $peso / ($altura ** 2);
        echo "<p>O seu IMC é: " . number_format($imc, 2, ',', '.') . "</p>";
    } else {
        echo "<p style='color:red;'>Altura inválida!</p>";
    }
}
?>    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</div>
</body>
</html>
