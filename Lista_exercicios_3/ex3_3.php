<?php
include("../Lista_exercicios_2/cabecalho.php");
?>
<h2>Exercicio 3</h2>

<form method="post">
    <input type="text" name="frase" placeholder="Digite a frase" required><br>
    <input type="text" name="palavra" placeholder="Digite a palavra" required><br>
    <button type="submit">Enviar</button>
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
?>

