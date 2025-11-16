<?php include("../cabecalho.php"); ?> 

<h2>Exercicio 7 </h2>
<form method="post">
<div class="mb-3">
              <label for="temperatura" class="form-label">Informe a temperatura em Fahrenheit</label>
              <input type="number" id="temperatura" name="temperatura" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $temperatura = $_POST['temperatura'];
        $celcius= ($temperatura - 32) * 5/9;
        echo"$temperatura °F equivalem a $celcius °C";
    }
?>

<?php include("../rodape.php"); ?>