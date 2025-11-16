<?php include("../cabecalho.php"); ?>

<h2>Exercicio 8 </h2>
<form method="post">
<div class="mb-3">
              <label for="altura" class="form-label">Informe a altura do retangulo</label>
              <input type="number" id="altura" name="altura" class="form-control" required="">
            </div><div class="mb-3">
              <label for="largura" class="form-label">Informe a largura do retangulo</label>
              <input type="number" id="largura" name="largura" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $altura = $_POST['altura'];
    $largura = $_POST['largura'];
    $area = $altura * $largura;
    echo"A área do triangulo é: $area";
    }
?>

<?php include("../rodape.php"); ?>