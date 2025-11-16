<?php include("../cabecalho.php"); ?>
<h2>Exercicio 13</h2>
<form method="post">
<div class="mb-3">
              <label for="medida" class="form-label">Informe a medida em metros</label>
              <input type="number" id="medida" name="medida" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $medida = $_POST['medida'];
        $conversao = $medida * 100;
        echo "A medida em cemtimetros é: $conversao cm";
    }
?>
<?php include("../rodape.php"); ?>