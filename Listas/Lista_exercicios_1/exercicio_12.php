<?php include("../cabecalho.php"); ?>

<h2>Exercicio 12 </h2>
<form method="post">
<div class="mb-3">
              <label for="base" class="form-label">Insira a base</label>
              <input type="number" id="base" name="base" class="form-control" required="">
            </div><div class="mb-3">
              <label for="expoente" class="form-label">Insira o expoente</label>
              <input type="number" id="expoente" name="expoente" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $base = $_POST['base'];
        $expoente = $_POST['expoente'];
        $calculo = $base ** $expoente;
        echo "O resultado é: $calculo";
    }

?>
<?php include("../rodape.php"); ?>