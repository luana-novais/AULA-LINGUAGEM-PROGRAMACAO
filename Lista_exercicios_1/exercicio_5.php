<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio - Média das notas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Exercicio - Média das notas</h1>
<form method="post">
<div class="mb-3">
    <label for="nota1" class="form-label">Insira a primeira nota</label>
    <input type="number" id="nota1" name="nota1" class="form-control" required="">
</div><div class="mb-3">
    <label for="nota2" class="form-label">Insira a segunda nota</label>
    <input type="number" id="nota2" name="nota2" class="form-control" required="">
</div><div class="mb-3">
    <label for="nota3" class="form-label">Insira a terceira nota</label>
    <input type="text" id="nota3" name="nota3" class="form-control" required="">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];
        $soma = $nota1 + $nota2 + $nota3;
        $media = $soma / 3;
        echo"<p>A média das notas é: $media </p>";
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>