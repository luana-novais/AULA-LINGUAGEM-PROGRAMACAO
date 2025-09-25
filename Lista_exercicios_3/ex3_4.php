<?php
include("../Lista_exercicios_2/cabecalho.php");
?>
<h2>Exercicio 4</h2>
<form method="post">
    <input type="number" name="dia" placeholder="Dia" required>
    <input type="number" name="mes" placeholder="Mês" required>
    <input type="number" name="ano" placeholder="Ano" required>
    <button type="submit">Enviar</button>
</form>
<?php
function dataValida($dia, $mes, $ano) {
    if(checkdate($mes, $dia, $ano)) { 
        return "$dia/$mes/$ano";
    } else {
        return false;
    }
}

if(isset($_POST['dia'], $_POST['mes'], $_POST['ano'])) {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $resultado = dataValida($dia, $mes, $ano);
    if($resultado) {
        echo "Data válida: $resultado";
    } else {
        echo "Data inválida!";
    }
}
?>

