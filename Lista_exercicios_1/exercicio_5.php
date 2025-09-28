<?php include("../cabecalho.php"); ?>

<h2>Exercicio 5 </h2>
<form method="post">
<div class="mb-3">
    <label for="nota1" class="form-label">Insira a primeira nota</label>
    <input type="number" id="nota1" name="nota1" class="form-control" required="">
</div><div class="mb-3">
    <label for="nota2" class="form-label">Insira a segunda nota</label>
    <input type="number" id="nota2" name="nota2" class="form-control" required="">
</div><div class="mb-3">
    <label for="nota3" class="form-label">Insira a terceira nota</label>
    <input type="text" id="nota3" name="nota3" class="form-control" required="">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];
        $soma = $nota1 + $nota2 + $nota3;
        $media = $soma / 3;
        echo"<p>A média das notas é: </p>" .number_format($media, 2, ',','');
    }

?>

<?php include("../rodape.php"); ?>