<?php include("../cabecalho.php"); ?>

<h2>Exercicio 11 </h2>
<form method="post">
<div class="mb-3">
              <label for="raio" class="form-label">Insira o raio do circulo</label>
              <input type="number" id="raio" name="raio" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $raio = $_POST['raio'];
    $perimetro = 2 * (3.14 * $raio);
    echo "O perimetro do círculo é: $perimetro";
    }
?>
<?php include("../rodape.php"); ?>