<?php include("../cabecalho.php"); ?>

<h2>Exercicio 6</h2>
<form method="post">
<div class="mb-3">
              <label for="temperatura" class="form-label">Informe a temperatura em graus Celsius</label>
              <input type="number" id="temperatura" name="temperatura" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $temperatura = $_POST['temperatura'];
        $fahrenheit = ($temperatura * 9/5) + 32;
        echo"$temperatura °C equivalem a $fahrenheit °F";
    }
?>

<?php include("../rodape.php"); ?>