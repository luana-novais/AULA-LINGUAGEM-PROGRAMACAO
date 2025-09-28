<?php include("../cabecalho.php"); ?>

<h2>Exercicio 9 </h2>
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
        $circulo = (3.14 * $raio **2);
        echo"A área do círculo é: $circulo";
    }
?>    

<?php include("../rodape.php"); ?>