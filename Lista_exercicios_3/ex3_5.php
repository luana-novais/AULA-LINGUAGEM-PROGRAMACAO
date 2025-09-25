<?php
include("../Lista_exercicios_2/cabecalho.php");
?>

<h2>Exercicio 5</h2>
<form method="post">
    <input type="number" step="any" name="numero" placeholder="Digite um número" required>
    <button type="submit">Enviar</button>
</form>

<?php
function raizQuadrada($numero) {
    return sqrt($numero); 
}

if(isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $resultado = raizQuadrada($numero);
    echo "A raiz quadrada de $numero é $resultado";
}
?>

