<?php include("../cabecalho.php"); ?>
<h2>Exercicio 14</h2>
<form method="post">
<div class="mb-3">
              <label for="distancia" class="form-label">Informe a distancia em Km</label>
              <input type="number" id="distancia" name="distancia" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $distancia = $_POST['distancia'];
        $conversao = $distancia * 0.621371;
        echo "A distancia em milhas é: $conversao ";
    }
?>
<?php include("../rodape.php"); ?>