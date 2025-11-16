<?php
include("../cabecalho.php");
?>
<h1>Exercicio 6</h1>
<form method="post">
<div class="mb-3">
              <label for="numero" class="form-label">Informe um número</label>
              <input type="number" id="numero" name="numero" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $numero = $_POST['numero'];
    for ($i = 1; $i <= $numero; $i++) 
      {
        echo $i . "<br>";
      }
    }
  include("../rodape.php");
?>