<?php include("../cabecalho.php"); ?>

<h2>Exercicio 10</h2>
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
    $perimetro = 2 * ($altura * $largura);
    echo"O perimetro do triangulo é: $perimetro";
    }
?>
<?php include("../rodape.php"); ?>