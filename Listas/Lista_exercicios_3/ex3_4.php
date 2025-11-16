<?php include("../cabecalho.php"); ?>

<h2>Exercicio 4</h2>
<form method="post">
    <div class="mb-3">
        <label for="dia" class="form-label">Dia</label>
        <input type="number" id="dia" name="dia" class="form-control" min="1" max="31" required>
    </div>
    <div class="mb-3">
        <label for="mes" class="form-label">Mês</label>
        <input type="number" id="mes" name="mes" class="form-control" min="1" max="12" required>
    </div>
    <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" id="ano" name="ano" class="form-control" min="1900" max="2100" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
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
include("../rodape.php");
?>

