<?php include("../cabecalho.php"); ?>

<h2>Exercicio 2</h2>
<form method="post">
<div class="mb-3">
    <label for="valor1" class="form-label">Informe o primeiro valor</label>
    <input type="number" id="valor1" name="valor1" class="form-control" required="">
</div><div class="mb-3">
    <label for="valor2" class="form-label">Informe o segundo valor</label>
    <input type="number" id="valor2" name="valor2" class="form-control" required="">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valor1 = $_POST["valor1"];
        $valor2 = $_POST["valor2"];
        $soma = $valor2 - $valor1;
        echo"<p>A subtração do segundo valor menos o primeiro é: $soma</p>";
    }
?>

<?php include("../rodape.php"); ?>