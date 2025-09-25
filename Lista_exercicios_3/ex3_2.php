<?php
include("../Lista_exercicios_2/cabecalho.php");
?>
<h2>Exercicio 2</h2>
<form method="post">
    <input type="text" name="palavra" placeholder="Digite uma palavra" required>
    <button type="submit">Enviar</button>
</form>
<?php
function maiusculoMinusculo($palavra) {
    return [
        'maiusculo' => strtoupper($palavra), 
        'minusculo' => strtolower($palavra)  
    ];
}

if(isset($_POST['palavra'])) {
    $palavra = $_POST['palavra'];
    $resultado = maiusculoMinusculo($palavra);
    echo "Maiúsculo: " . $resultado['maiusculo'] . "<br>";
    echo "Minúsculo: " . $resultado['minusculo'];
}
?>
