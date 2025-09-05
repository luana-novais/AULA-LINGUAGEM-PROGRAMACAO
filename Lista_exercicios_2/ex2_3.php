<?php
    include("cabecalho.php");
?>

<h1>Exercicio 3</h1>
<form method="post">
<div class="mb-3">
              <label for="ValorA" class="form-label">Informe o primeiro valor</label>
              <input type="number" id="valorA" name="valorA" class="form-control" required="">
            </div><div class="mb-3">
              <label for="valorB" class="form-label">Informe o segundo valor</label>
              <input type="number" id="valorB" name="valorB" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        $valorA = $_POST['valorA'];
        $valorB = $_POST['valorB'];
        if ($valorA == $valorB){
            echo "<p>Os números são iguais: $valorA </p>";
        }elseif ($valorA < $valorB){
            echo "Ordem crescente dos números é: $valorA $valorB";
        }else {
            echo "Ordem crescente dos números é: $valorB $valorA";
        }
}

include("rodape.php");
?>
