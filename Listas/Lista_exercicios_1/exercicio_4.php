<?php include("../cabecalho.php"); ?>

<h2>Exercicio 4</h2>
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
        if($valor2 == 0){
            echo"<p>Valor inserido é invalido, não existe divisão por zero!</p>";
        }
        else{
            $soma = $valor1 / $valor2;
            echo"<p>O resultado da divisão dos valores é: </p>" .number_format($soma, 2, ',','');;
        }
    }
?>

<?php include("../rodape.php"); ?>