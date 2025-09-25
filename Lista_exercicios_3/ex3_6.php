<?php
include("../Lista_exercicios_2/cabecalho.php");
?>
<h2>Exercicio 6</h2>
<form method="post">
    <input type="number" step="any" name="numero" placeholder="Digite um número" required>
    <button type="submit">Enviar</button>
</form>

<?php
function arredondarNumero($numero) {
    return round($numero); 
}

if(isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    $resultado = arredondarNumero($numero);
    echo "O número $numero arredondado é $resultado";
}
?>
