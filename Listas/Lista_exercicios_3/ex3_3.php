<?php include("../cabecalho.php"); ?>

<h2>Exercicio 3</h2>

<form method="post">
    <div class="mb-3">
        <label for="frase" class="form-label">Digite uma frase:</label>
        <input type="text" id="frase" name="frase" class="form-control" required="">
        <label for="palavra" class="form-label">Digite uma palavra:</label>
        <input type="text" id="palavra" name="palavra" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php

function contemPalavra($frase, $palavra) {
    return strpos($frase, $palavra) !== false; 
}
if(isset($_POST['frase']) && isset($_POST['palavra'])) {
    $frase = $_POST['frase'];
    $palavra = $_POST['palavra'];
    if(contemPalavra($frase, $palavra)) {
        echo "A palavra '$palavra' está contida em '$frase'.";
    } else {
        echo "A palavra '$palavra' NÃO está contida em '$frase'.";
    }
}
include("../rodape.php");
?>

